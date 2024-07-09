<?php
/**
 * Handles the sponsors shortcode.
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Views\Shortcode
 */

namespace TEC\Conference\Views\Shortcode;

use TEC\Conference\Plugin;
use TEC\Conference\Query\Speaker_List as Speaker_Query;
use TEC\Conference\Vendor\StellarWP\Assets\Assets;
use WP_Query;

/**
 * Class Sponsors
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Views\Shortcode
 */
class Speakers {

	/**
	 * An instance of the Speaker_Query class.
	 *
	 * @since 1.2.0
	 *
	 * @var Speaker_Query
	 */
	private $speaker_query;

	/**
	 * Sponsors constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param Speaker_Query $speaker_query An instance of the Speaker_Query class.
	 */
	public function __construct( Speaker_Query $speaker_query ) {
		$this->speaker_query = $speaker_query;
	}

	/**
	 * The [tec_speakers] shortcode handler.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string|mixed> $attr Array of attributes from shortcode.
	 *
	 * @return string The HTML output the shortcode.
	 */
	public function render_shortcode( $attr ) {
		Assets::instance()->enqueue_group( 'event-schedule-manager-views' );
		global $post;

		// Prepare the shortcodes arguments
		$attr = shortcode_atts( [
			'show_image'     => true,
			'image_size'     => 150,
			'show_content'   => false,
			'posts_per_page' => - 1,
			'orderby'        => 'date',
			'order'          => 'desc',
			'speaker_link'   => '',
			'track'          => '',
			'groups'         => '',
			'columns'        => 1,
			'gap'            => 30,
			'align'          => 'left'
		], $attr );

		foreach ( [ 'orderby', 'order', 'speaker_link' ] as $key_for_case_sensitive_value ) {
			$attr[ $key_for_case_sensitive_value ] = strtolower( $attr[ $key_for_case_sensitive_value ] );
		}

		$attr['show_image']   = $this->str_to_bool( $attr['show_image'] );
		$attr['show_content'] = $this->str_to_bool( $attr['show_content'] );
		$attr['orderby']      = in_array( $attr['orderby'], [ 'date', 'title', 'rand' ] ) ? $attr['orderby'] : 'date';
		$attr['order']        = in_array( $attr['order'], [ 'asc', 'desc' ] ) ? $attr['order'] : 'desc';
		$attr['speaker_link'] = $attr['speaker_link'] == 'permalink' ? $attr['speaker_link'] : '';
		$attr['track']        = array_filter( explode( ',', $attr['track'] ) );
		$attr['groups']       = array_filter( explode( ',', $attr['groups'] ) );

		$sessions_data = $this->speaker_query->get_sessions_data( $attr );
		$speaker_ids   = $sessions_data['speaker_ids'];
		$speakers      = $this->speaker_query->get_speakers( $attr, $speaker_ids );

		if ( ! $speakers->have_posts() ) {
			return '';
		}

		$speakers_tracks  = $sessions_data['speakers_tracks'];
		$speakers         = $this->speaker_query->get_speakers( $attr, $speaker_ids );
		$process_speakers = $this->speaker_query->process_speaker_data( $speakers, $attr, $speakers_tracks );

		// Render the HTML for the shortcode
		ob_start();
		?>

		<div class="tec-speakers" style="text-align: <?php echo $attr['align']; ?>; display: grid; grid-template-columns: repeat(<?php echo $attr['columns']; ?>, 1fr); grid-gap: <?php echo $attr['gap']; ?>px;">

			<?php foreach ( $process_speakers as $speaker ) { ?>
				<!-- Organizers note: The id attribute is deprecated and only remains for backwards compatibility, please use the corresponding class to target individual speakers -->
				<div class="tec-speaker" id="tec-speaker-<?php echo sanitize_html_class( $speaker['post_name'] ); ?>" class="<?php echo esc_attr( implode( ' ', $speaker['speaker_classes'] ) ); ?>">

					<?php if ( $speaker['image_url'] && $attr['show_image'] == true ) { ?>
						<img src="<?php echo esc_url( $speaker['image_url'] ); ?>" alt="<?php echo esc_attr( $speaker['full_name'] ); ?>" class="tec-speaker-image" width="<?php echo esc_attr( $attr['image_size'] ); ?>">
					<?php } ?>

					<h2 class="tec-speaker-name">
						<?php if ( 'permalink' === $attr['speaker_link'] ) : ?>
							<a href="<?php echo esc_url( $speaker['link'] ); ?>">
								<?php echo esc_html( $speaker['full_name'] ); ?>
							</a>
						<?php else : ?>
							<?php echo esc_html( $speaker['full_name'] ); ?>
						<?php endif; ?>
					</h2>

					<?php if ( ! empty( $speaker['title_organization'] ) ) { ?>
						<p class="tec-speaker-title-organization">
							<?php echo esc_html( implode( ', ', $speaker['title_organization'] ) ); ?>
						</p>
					<?php } ?>

					<div class="tec-speaker-description">
						<?php if ( $attr['show_content'] == true ) {
							echo wp_kses_post( $speaker['content'] );
						} ?>
					</div>
				</div>
			<?php } ?>

		</div>

		<?php

		wp_reset_postdata();

		return ob_get_clean();
	}

	/**
	 * Convert a string representation of a boolean to an actual boolean
	 *
	 * @param string|bool
	 *
	 * @return bool
	 */
	public function str_to_bool( $value ): bool {
		if ( true === $value ) {
			return true;
		}

		return in_array( strtolower( trim( $value ) ), [ 'yes', 'true', '1' ] );
	}

	/**
	 * Fetches the relevant sessions and returns an array with speaker IDs and their corresponding tracks.
	 *
	 * @since 1.0.0
	 *
	 * @param array $attr Array of attributes from shortcode.
	 *
	 * @return array An array containing the speaker IDs and their corresponding tracks.
	 * @deprecated 1.2.0
	 *
	 */
	public function get_sessions_data( $attr ) {
		_deprecated_function( __METHOD__, '1.2.0', '\TEC\Conference\Query\Speaker_List->get_sessions_data( $attr )' );

		// Fetch all the relevant sessions.
		$session_args = [
			'post_type'      => Plugin::SESSION_POSTTYPE,
			'posts_per_page' => 100,
		];

		/**
		 * Filters the session arguments for the speakers list shortcode.
		 *
		 * @since 1.0.0
		 *
		 * @param array<string|mixed> $session_args The session arguments.
		 * @param array<string|mixed> $attr         The shortcode attributes.
		 */
		$session_args = apply_filters( 'tec_schedule_manager_speakers_list_session_args', $session_args, $attr );

		// phpcs:disable WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		if ( isset( $attr['track'] ) && $attr['track'] !== [] ) {
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
	 * @since 1.0.0
	 *
	 * @param array $attr        Array of attributes from shortcode.
	 * @param array $speaker_ids Array of speaker IDs.
	 *
	 * @return WP_Query The query object containing the specified speakers.
	 * @deprecated 1.2.0
	 *
	 */
	public function get_speakers( $attr, $speaker_ids ) {
		_deprecated_function( __METHOD__, '1.2.0', '\TEC\Conference\Query\Speaker_List->get_speakers( $attr, $speaker_ids )' );

		// Fetch all specified speakers.
		$speaker_args = [
			'post_type'      => Plugin::SPEAKER_POSTTYPE,
			'posts_per_page' => (int) $attr['posts_per_page'],
			'orderby'        => $attr['orderby'],
			'order'          => $attr['order'],
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

		return new WP_Query( $speaker_args );
	}
}
