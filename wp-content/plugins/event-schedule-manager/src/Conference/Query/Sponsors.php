<?php
/**
 * The Sponsors Query.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\Query;
 */

namespace TEC\Conference\Query;

use TEC\Conference\Plugin;
use TEC\Conference\Vendor\StellarWP\Arrays\Arr;
use WP_Query;

/**
 * Class Sponsors
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\Query
 */
class Sponsors {

	/**
	 * Retrieves sponsors by terms.
	 *
	 * @since 1.2.0
	 *
	 * @param array $terms An array of term objects.
	 * @param array $attr  Optional. An array of attributes.
	 *
	 * @return array An array of sponsors grouped by terms.
	 */
	public function get_sponsors_by_terms( $terms, $attr = [] ) {
		$sponsors_by_terms = [];

		foreach ( $terms as $term ) {
			$sponsors = $this->get_sponsors_by_term( $term, $attr );
			if ( ! $sponsors->have_posts() ) {
				continue;
			}
			$sponsors_by_terms[ $term->slug ] = [
				'term'     => $term,
				'sponsors' => $this->process_sponsor_data( $sponsors, $term, $attr ),
			];
		}

		return $sponsors_by_terms;
	}

	/**
	 * Retrieves sponsors by a single term.
	 *
	 * @since 1.2.0
	 *
	 * @param object $term The term object.
	 * @param array  $attr Optional. An array of attributes.
	 *
	 * @return WP_Query The sponsors query.
	 */
	public function get_sponsors_by_term( $term, $attr = [] ) {
		$query_args = [
			'post_type'      => Plugin::SPONSOR_POSTTYPE,
			'order'          => 'ASC',
			'orderby'        => 'title',
			'posts_per_page' => esc_attr( Arr::get( $attr, 'posts_per_page', 100 ) ),
		];

		// phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		if ( $term->term_id === 0 ) {
			$query_args['tax_query'] = [
				[
					'taxonomy' => $term->taxonomy,
					'operator' => 'NOT EXISTS',
				],
			];
		} else {
			$query_args['taxonomy'] = $term->taxonomy;
			$query_args['term']     = $term->slug;
		}

		// phpcs:enable WordPress.DB.SlowDBQuery.slow_db_query_tax_query

		/**
		 * Filters the query arguments for retrieving sponsors by term.
		 *
		 * @since 1.2.0
		 *
		 * @param array $query_args The query arguments.
		 * @param object $term      The term object.
		 */
		$query_args = apply_filters( 'tec_event_schedule_manager_sponsors_by_term_query_args', $query_args, $term );

		return new \WP_Query( $query_args );
	}

	/**
	 * Processes sponsor data.
	 *
	 * @since 1.2.0
	 *
	 * @param WP_Query $sponsors The sponsors query.
	 * @param object   $term     The term object.
	 * @param array    $attr     Optional. An array of attributes.
	 *
	 * @return array An array of processed sponsor data.
	 */
	public function process_sponsor_data( $sponsors, $term, $attr = [] ) {
		$returned_sponsors = [];
		$excerpt_length    = $attr['excerpt_length'] ?? 55;

		$logo_height = ( get_term_meta( $term->term_id, 'tec_logo_height', true ) ) ? get_term_meta( $term->term_id, 'tec_logo_height', true ) . 'px' : 'auto';

		/**
		 * Filters the sponsor logo height.
		 *
		 * @since 1.2.0
		 *
		 * @param string $logo_height The logo height value.
		 * @param object $term        The term object.
		 */
		$logo_height = apply_filters( 'tec_event_schedule_manager_sponsor_logo_height', $logo_height, $term );

		/**
		 * Filters the sponsor image size.
		 *
		 * @since 1.2.0
		 *
		 * @param string $image_size The image size. Default is 'large'.
		 * @param object $term       The term object.
		 */
		$image_size = apply_filters( 'tec_event_schedule_manager_sponsor_image_size', 'large', $term );

		while ( $sponsors->have_posts() ) {
			$sponsors->the_post();

			$post_id         = get_the_ID();
			$website         = get_post_meta( get_the_ID(), 'tec_website_url', true );
			$image           = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( $post_id, $image_size ) : null;
			$sponsor_classes = [
				'tec-sponsor',
				'tec-sponsor-' . sanitize_html_class( $sponsors->post->post_name ),
				sanitize_html_class( 'tec-sponsor-level-' . $term->slug ),
			];

			$returned_sponsors[] = [
				'id'              => $post_id,
				'post_name'       => $sponsors->post->post_name,
				'title'           => $sponsors->post->post_title,
				'link'            => get_the_permalink(),
				'website'         => $website,
				'image'           => $image,
				'logo_height'     => $logo_height,
				'sponsor_classes' => $sponsor_classes,
				'content'         => $sponsors->post->post_content,
				'excerpt'         => wpautop(
					wp_trim_words(
						$sponsors->post->post_content,
						absint( $excerpt_length ),
						apply_filters( 'excerpt_more', ' &hellip;' )
					)
				),
			];
		}

		return $returned_sponsors;
	}

	/**
	 * Returns the sponsor level terms in set order.
	 *
	 * @since 1.2.0
	 *
	 * @param string $option            The option key to fetch from the database.
	 * @param string $taxonomy          The taxonomy to fetch terms for.
	 * @param bool   $include_unassigned Optional. Whether to include unassigned sponsors. Default is false.
	 *
	 * @return array Array of term objects.
	 */
	public function get_sponsor_levels( string $option, string $taxonomy, bool $include_unassigned = false ): array {
		$option       = get_option( $option, [] );
		$term_objects = get_terms(
			[
				'taxonomy'   => $taxonomy,
				'hide_empty' => true,
			]
		);
		$terms        = [];

		foreach ( $term_objects as $term ) {
			$terms[ $term->term_id ] = $term;
		}

		if ( $include_unassigned ) {
			$unassigned_term = (object) [
				'term_id'  => 0,
				'name'     => __( 'Unassigned Sponsors', 'event-schedule-manager' ),
				'slug'     => 'unassigned',
				'taxonomy' => $taxonomy,
			];
			$terms[]         = $unassigned_term;
		}

		return $this->order_terms_by_option( $terms, $option );
	}

	/**
	 * Orders the terms by a given option.
	 *
	 * @since 1.2.0
	 *
	 * @param array $terms  The terms to be ordered.
	 * @param array $option The order option.
	 *
	 * @return array The ordered terms.
	 */
	private function order_terms_by_option( array $terms, array $option ): array {
		$ordered_terms = [];

		foreach ( $option as $term_id ) {
			if ( isset( $terms[ $term_id ] ) ) {
				$ordered_terms[] = $terms[ $term_id ];
				unset( $terms[ $term_id ] );
			}
		}

		return array_merge( $ordered_terms, array_values( $terms ) );
	}
}
