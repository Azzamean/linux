<?php
/**
 * The REST Endpoint Interface.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Interfaces
 */

namespace TEC\Conference\REST\V1\Interfaces;

/**
 * REST_Endpoint_Interface
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Interfaces
 */
interface REST_Endpoint_Interface {

	/**
	 * Gets the Endpoint path for this route.
	 *
	 * @since 1.2.0
	 *
	 * @return string
	 */
	public function get_endpoint_path();

	/**
	 * Get the endpoint id.
	 *
	 * @since 1.2.0
	 *
	 * @return string The endpoint details id with prefix and endpoint combined.
	 */
	public function get_id();
}
