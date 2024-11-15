<?php
/**
 * The Event Schedule Manager REST Namespace Trait.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Traits
 */

namespace TEC\Conference\REST\V1\Traits;

/**
 * Abstract REST Endpoint Event Schedule Manager
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Traits
 */
trait REST_Namespace {

	/**
	 * The Events Calendar REST API URL prefix.
	 *
	 * This prefix is appended to the The Events Calendar REST API URL ones.
	 *
	 * @since 1.2.0
	 *
	 * @var string
	 */
	protected $url_prefix = '/esm/v1';

	/**
	 * The REST API endpoint path.
	 *
	 * @since 1.2.0
	 *
	 * @var string
	 */
	protected $namespace = 'tec';

	/**
	 * Returns the namespace of REST APIs.
	 *
	 * @since 1.2.0
	 *
	 * @return string
	 */
	public function get_namespace() {
		return $this->namespace;
	}

	/**
	 * Returns the string indicating the REST API version.
	 *
	 * @since 1.2.0
	 *
	 * @return string
	 */
	public function get_version() {
		return 'v1';
	}

	/**
	 * Returns the ESM REST API namespace string that should be used to register a route.
	 *
	 * @since 1.2.0
	 *
	 * @return string
	 */
	public function get_esm_route_namespace() {
		return $this->get_namespace() . '/esm/' . $this->get_version();
	}

	/**
	 * Returns the REST API URL prefix.
	 *
	 * @since 1.2.0
	 *
	 * @return string The REST API URL prefix.
	 */
	public function get_url_prefix() {
		$use_builtin = $this->use_builtin();

		if ( $use_builtin ) {
			$prefix = rest_get_url_prefix();
		} else {
			$prefix = apply_filters( 'rest_url_prefix', 'wp-json' );
		}

		$default_tec_prefix = $this->namespace . '/' . trim( $this->url_prefix(), '/' );
		$prefix             = rtrim( $prefix, '/' ) . '/' . trim( $default_tec_prefix, '/' );

		/**
		 * Filters the TEC REST API URL prefix
		 *
		 * @since 1.2.0
		 *
		 * @param string $prefix             The complete URL prefix.
		 * @param string $default_tec_prefix The default URL prefix appended to the REST URL by The Events Calendar.
		 */
		return apply_filters( 'tec_event_schedule_manager_rest_url_prefix', $prefix, $default_tec_prefix );
	}

	/**
	 * Retrieves the URL to a TEC REST endpoint on a site.
	 *
	 * Note: The returned URL is NOT escaped.
	 *
	 * @since 1.2.0
	 *
	 * @param string $path    Optional. TEC REST route. Default '/'.
	 * @param string $scheme  Optional. Sanitization scheme. Default 'rest'.
	 * @param int    $blog_id Optional. Blog ID. Default of null returns URL for current blog.
	 *
	 * @return string Full URL to the endpoint.
	 */
	public function get_url( $path = '/', $scheme = 'rest', $blog_id = null ) {
		if ( empty( $path ) ) {
			$path = '/';
		}

		$tec_path = '/' . trim( $this->namespace, '/' ) . $this->url_prefix() . '/' . ltrim( $path, '/' );

		if ( $this->use_builtin() ) {
			$url = get_rest_url( $blog_id, $tec_path, $scheme );
		} else {
			if ( ( is_multisite() && get_blog_option( $blog_id, 'permalink_structure' ) ) || get_option( 'permalink_structure' ) ) {
				global $wp_rewrite;

				if ( $wp_rewrite->using_index_permalinks() ) {
					$url = get_home_url( $blog_id, $wp_rewrite->index . '/' . $this->get_url_prefix(), $scheme );
				} else {
					$url = get_home_url( $blog_id, $this->get_url_prefix(), $scheme );
				}

				$url .= '/' . ltrim( $path, '/' );
			} else {
				$url = get_home_url( $blog_id, 'index.php', $scheme );

				$url = add_query_arg( 'rest_route', $tec_path, $url );
			}

			if ( is_ssl() ) {
				// If the current host is the same as the REST URL host, force the REST URL scheme to HTTPS.
				if ( isset( $_SERVER['SERVER_NAME'] ) && $_SERVER['SERVER_NAME'] === wp_parse_url( get_home_url( $blog_id ), PHP_URL_HOST ) ) {
					$url = set_url_scheme( $url, 'https' );
				}
			}
		}

		/**
		 * Filters Event Schedule Manger REST URL.
		 *
		 * @since 1.2.0
		 *
		 * @param string $url     TEC REST URL.
		 * @param string $path    REST route.
		 * @param int    $blog_id Blog ID.
		 * @param string $scheme  Sanitization scheme.
		 *
		 * @return string The filtered REST URL.
		 */
		return apply_filters( 'tec_event_schedule_manager_rest_url', $url, $path, $blog_id, $scheme );
	}

	/**
	 * Whether built-in WP REST API functions and functionalities should/can be used or not.
	 *
	 * @since 1.2.0
	 *
	 * @return bool
	 */
	protected function use_builtin() {
		/**
		 * Filters whether builtin WordPress REST API functions should be used or not if available.
		 *
		 * @since 1.2.0
		 *
		 * @param bool $use_builtin Whether to use builtin WordPress REST API functions.
		 *
		 * @return bool Whether to use builtin WordPress REST API functions.
		 */
		$use_builtin = apply_filters( 'tec_event_schedule_manager_rest_use_builtin', true );

		return $use_builtin && function_exists( 'get_rest_url' );
	}

	/**
	 * Returns the REST API URL prefix that will be appended to the namespace.
	 *
	 * The prefix should be in the `/some/path` format.
	 *
	 * @since 1.2.0
	 *
	 * @return string
	 */
	protected function url_prefix() {
		return $this->url_prefix;
	}
}
