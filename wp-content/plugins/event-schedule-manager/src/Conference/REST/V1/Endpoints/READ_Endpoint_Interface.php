<?php
/**
 * Read Endpoint Interface.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Endpoints;
 */

namespace TEC\Conference\REST\V1\Endpoints;

use WP_REST_Request;
use WP_REST_Response;

// phpcs:disable StellarWP.Classes.ValidClassName.NotSnakeCase
// phpcs:disable WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid

/**
 * Read Endpoint Interface.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Endpoints
 */
interface READ_Endpoint_Interface {

	/**
	 * Handles GET requests on the endpoint.
	 *
	 * @since 1.2.0
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_Error|WP_REST_Response An array containing the data on success or a WP_Error instance on failure.
	 */
	public function get( WP_REST_Request $request );

	/**
	 * Returns the content of the `args` array that should be used to register the endpoint
	 * with the `register_rest_route` function.
	 *
	 * @since 1.2.0
	 *
	 * @return array<string|mixed> An array containing the data to register the endpoint.
	 */
	public function READ_args();
	// phpcs:enable StellarWP.Classes.ValidClassName.NotSnakeCase
	// phpcs:enable WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
}
