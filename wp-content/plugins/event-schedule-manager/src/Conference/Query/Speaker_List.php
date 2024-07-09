<?php
/**
 * The Speaker List Query.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\Query;
 */

namespace TEC\Conference\Query;

use TEC\Conference\Plugin;
use WP_Query;

/**
 * Class Speaker_List
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\Query
 */
class Speaker_List {

	/**
	 * Fetches the relevant sessions and returns an array with speaker IDs and their corresponding tracks.
	 *
	 * @since 1.2.0
	 *
	 * @param array $attr Array of attributes.
	 *
	 * @return array An array containing the speaker IDs and their corresponding tracks.
	 */
	public function get_sessions_data( $attr ) {
		// Fetch all the relevant sessions.
		$session_args = [
			'post_type'      => Plugin::SESSION_POSTTYPE,
			'posts_per_page' => 100,
		];

		/**
		 * Filters the session arguments for the speakers list shortcode.
		 *
		 * @since 1.2.0
		 *
		 * @param array<string|mixed> $session_args The session arguments.
		 * @param array<string|mixed> $attr         The shortcode attributes.
		 */
		$session_args = apply_filters( 'tec_schedule_manager_speakers_list_session_args', $session_args, $attr );

		// phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		if ( ! empty( $attr['track'] ) ) {
			$session_args['tax_query'] = [
				[
					'taxonomy' => Plugin::TRACK_TAXONOMY,
					'field'    => 'slug',
					'terms'    => $attr['track'],
				],
			];
		}
		// phpcs:enable WordPress.DB.SlowDBQuery.slow_db_query_tax_query

		$sessions = get_posts( $session_args );

		// Parse the sessions.
		$speaker_ids     = [];
		$speakers_tracks = [];
		foreach ( $sessions as $session ) {
			// Get the speaker IDs for all the sessions in the requested tracks.
			$session_speaker_ids = (array) get_post_meta( $session->ID, 'tec_session_speakers', true );
			$speaker_ids         = array_merge( $speaker_ids, $session_speaker_ids );

			// Map speaker IDs to their corresponding tracks.
			$session_terms = wp_get_object_terms( $session->ID, Plugin::TRACK_TAXONOMY );
			foreach ( $session_speaker_ids as $speaker_id ) {
				if ( isset( $speakers_tracks[ $speaker_id ] ) ) {
					$speakers_tracks[ $speaker_id ] = array_merge( $speakers_tracks[ $speaker_id ], wp_list_pluck( $session_terms, 'slug' ) );
				} else {
					$speakers_tracks[ $speaker_id ] = wp_list_pluck( $session_terms, 'slug' );
				}
			}
		}

		// Remove duplicate entries.
		$speaker_ids = array_unique( $speaker_ids );
		foreach ( $speakers_tracks as $speaker_id => $tracks ) {
			$speakers_tracks[ $speaker_id ] = array_unique( $tracks );
		}

		return [
			'speaker_ids'     => $speaker_ids,
			'speakers_tracks' => $speakers_tracks,
		];
	}

	/**
	 * Fetches the specified speakers based on the provided attributes.
	 *
	 * @since 1.2.0
	 *
	 * @param array $attr        Array of attributes.
	 * @param array $speaker_ids Array of speaker IDs.
	 *
	 * @return WP_Query The query object containing the specified speakers.
	 */
	public function get_speakers( $attr, $speaker_ids ) {
		// Fetch all specified speakers.
		$speaker_args = [
			'post_type'      => Plugin::SPEAKER_POSTTYPE,
			'posts_per_page' => esc_attr( $attr['posts_per_page'] ),
			'orderby'        => esc_attr( $attr['orderby'] ),
			'order'          => esc_attr( $attr['order'] ),
		];

		if ( ! empty( $attr['track'] ) ) {
			$speaker_args['post__in'] = empty( $speaker_ids ) ? [ 0 ] : $speaker_ids;
		}

		// phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		if ( ! empty( $attr['groups'] ) ) {
			$speaker_args['tax_query'] = [
				[
					'taxonomy' => Plugin::GROUP_TAXONOMY,
					'field'    => 'slug',
					'terms'    => $attr['groups'],
				],
			];
		}

		// phpcs:enable WordPress.DB.SlowDBQuery.slow_db_query_tax_query

		return new \WP_Query( $speaker_args );
	}

	/**
	 * Processes the speaker data and returns an array of formatted speaker information.
	 *
	 * @since 1.2.0
	 *
	 * @param WP_Query $speakers        The query object containing the speakers.
	 * @param array    $args            The arguments used to retrieve the speakers.
	 * @param array    $speakers_tracks The array mapping speaker IDs to their corresponding tracks.
	 *
	 * @return array An array of formatted speaker information.
	 */
	public function process_speaker_data( $speakers, $args, $speakers_tracks ) {
		$returned_speakers = [];

		while ( $speakers->have_posts() ) {
			$speakers->the_post();

			$post_id    = get_the_ID();
			$first_name = get_post_meta( $post_id, 'tec_first_name', true );
			$last_name  = get_post_meta( $post_id, 'tec_last_name', true );
			$full_name  = $first_name . ' ' . $last_name;

			$title              = get_post_meta( $post_id, 'tec_title', true );
			$organization       = get_post_meta( $post_id, 'tec_organization', true );
			$title_organization = array_filter( [ $title, $organization ] );

			$speaker_classes = [ 'tec-speaker', 'tec-speaker-' . sanitize_html_class( $speakers->post->post_name ) ];
			if ( isset( $speakers_tracks[ $post_id ] ) ) {
				foreach ( $speakers_tracks[ $post_id ] as $track ) {
					$speaker_classes[] = sanitize_html_class( 'tec-track-' . $track );
				}
			}

			$returned_speakers[] = [
				'id'                 => $post_id,
				'post_name'          => $speakers->post->post_name,
				'title'              => get_the_title(),
				'link'               => get_permalink(),
				'first_name'         => $first_name,
				'last_name'          => $last_name,
				'full_name'          => $full_name,
				'image_url'          => get_the_post_thumbnail_url( $post_id, [ $args['image_size'], $args['image_size'] ] ),
				'title_organization' => $title_organization,
				'speaker_classes'    => $speaker_classes,
				'content'            => $speakers->post->post_content,
			];
		}

		return $returned_speakers;
	}
}
