<?php
/**
 * The ESM OpenAPI Documentation Endpoint.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Documentation
 */

namespace TEC\Conference\REST\V1\Documentation;

use TEC\Conference\REST\V1\Traits\REST_Namespace as ESM_REST_Namespace;

// phpcs:disable StellarWP.Classes.ValidClassName.NotSnakeCase

/**
 * Class OpenAPI_Documentation
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Documentation
 */
class OpenAPI_Documentation extends Abstract_OpenAPI_Documentation {
	// phpcs:enable StellarWP.Classes.ValidClassName.NotSnakeCase

	use ESM_REST_Namespace;

	/**
	 * @inerhitDoc
	 */
	protected function get_api_info() {
		return [
			'title'       => __( 'Event Schedule Manager REST API', 'event-schedule-manager' ),
			'description' => __( 'Event Schedule Manager REST API allows direct connections to different views.', 'event-schedule-manager' ),
			'version'     => $this->rest_api_version,
		];
	}
}
