<?php

/**
 * Provider for Views of the plugin.
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Views
 */

namespace TEC\Conference\Views;

use TEC\Conference\Contracts\Service_Provider;

/**
 * Class Provider
 *
 * Provides the functionality to register and manage views for the plugin.
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Admin
 */
class Provider extends Service_Provider {

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		// Register the SP on the container.
		$this->container->singleton( 'tec.conference.admin.provider', $this );

		$this->add_actions();
		$this->add_filters();
	}

	/**
	 * Adds required actions for views.
	 *
	 * @since 1.0.0
	 */
	protected function add_actions() {
		add_shortcode( 'tec_schedule', [ $this, 'render_schedule_shortcode' ] );
		add_action( 'template_redirect', [ $this, 'register_views_assets' ] );

		add_shortcode( 'tec_speakers', [ $this, 'render_speakers_shortcode' ] );
		add_shortcode( 'tec_sponsors', [ $this, 'render_sponsors_shortcode' ] );

		// Single Session.
		add_action( 'wpsc_single_taxonomies', [ $this, 'single_session_tags' ] );

		add_action( 'get_header', [ $this, 'enqueue_views_posttype_assets' ] );

		add_action( 'save_post_tec_session', [ $this, 'clear_session_dates_cache' ] );
		add_action( 'deleted_post', [ $this, 'clear_session_dates_cache' ] );
		add_action( 'trashed_post', [ $this, 'clear_session_dates_cache' ] );
	}

	/**
	 * Schedule Block and Shortcode Dynamic content Output.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string|mixed> $attr Array of attributes from shortcode.
	 *
	 * @return string The HTML output the shortcode.
	 */
	public function render_schedule_shortcode( $props ) {
		return $this->container->make( Shortcode\Schedule::class )->render_shortcode( $props );
	}

	/**
	 * Registers the view assets.
	 *
	 * @since 1.0.0
	 */
	public function register_views_assets() {
		$this->container->make( Assets::class )->register_views_assets();
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
	public function render_speakers_shortcode( $props ) {
		return $this->container->make( Shortcode\Speakers::class )->render_shortcode( $props );
	}

	/**
	 * The [tec_sponsors] shortcode handler.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string|mixed> $attr Array of attributes from shortcode.
	 *
	 * @return string The HTML output the shortcode.
	 */
	public function render_sponsors_shortcode( $props ) {
		return $this->container->make( Shortcode\Sponsors::class )->render_shortcode( $props );
	}

	/**
	 * Adds single sessions tags.
	 *
	 * @since 1.0.0
	 */
	public function single_session_tags() {
		$this->container->make( Filter_Modifications::class )->single_session_tags();
	}

	/**
	 * Checks for specified custom post types on single post pages and enqueues assets if true.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_views_posttype_assets() {
		$this->container->make( Assets::class )->enqueue_views_posttype_assets();
	}

	/**
	 * Clear the cache for unique session dates.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id The post ID.
	 */
	public function clear_session_dates_cache( $post_id ) {
		$this->container->make( Shortcode\Schedule::class )->clear_session_dates_cache( $post_id );
	}

	/**
	 * Adds required filters for views.
	 *
	 * @since 1.0.0
	 */
	protected function add_filters() {
		// Schedule Shortcode.
		add_filter( 'body_class', [ $this, 'add_body_class_for_tec_schedule' ] );
		add_filter( 'tec_filter_session_speakers', [ $this, 'filter_session_speakers' ], 11, 2 );
		add_filter( 'tec_session_content_header', [ $this, 'session_content_header' ], 11, 1 );
		add_filter( 'tec_session_content_footer', [ $this, 'session_sponsors' ], 11, 1 );

		// Single Session.
		add_filter( 'tec_filter_single_session_speakers', [ $this, 'filter_single_session_speakers' ], 11, 2 );
	}

	/**
	 * Add body class if shortcode or block exists.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string> $classes Classes for the body element.
	 *
	 * @return array<string> Modified body classes.
	 */
	public function add_body_class_for_tec_schedule( $body_classes ) {
		return $this->container->make( Shortcode\Schedule::class )->add_body_class_for_tec_schedule( $body_classes );
	}

	/**
	 * Filters session speakers output based on speaker display type.
	 *
	 * @since 1.0.0
	 *
	 * @param string $speakers_typed Predefined speakers typed.
	 * @param int    $session_id     Session post ID.
	 *
	 * @return string HTML output of session speakers.
	 */
	public function filter_session_speakers( $speakers_typed, $session_id ): string {
		return $this->container->make( Filter_Modifications::class )->filter_session_speakers( $speakers_typed, $session_id );
	}

	/**
	 * Generates session content header based on session tags.
	 *
	 * @since 1.0.0
	 *
	 * @param int $session_id Session post ID.
	 *
	 * @return string HTML output of session content header.
	 */
	public function session_content_header( $session_id ) {
		return $this->container->make( Filter_Modifications::class )->session_content_header( $session_id );
	}

	/**
	 * Outputs session sponsors.
	 *
	 * @since 1.0.0
	 *
	 * @param int $session_id The session ID.
	 *
	 * @return string The HTML of the session sponsors or empty string.
	 */
	public function session_sponsors( $session_id ): string {
		return $this->container->make( Filter_Modifications::class )->session_sponsors( $session_id );
	}

	/**
	 * Filters single session speakers output based on speaker display type.
	 *
	 * @since 1.0.0
	 *
	 * @param string $speakers_typed Predefined speakers typed.
	 * @param int    $session_id     Session post ID.
	 *
	 * @return string HTML output of single session speakers.
	 */
	public function filter_single_session_speakers( $speakers_typed, $session_id ): string {
		return $this->container->make( Filter_Modifications::class )->filter_single_session_speakers( $speakers_typed, $session_id );
	}
}
