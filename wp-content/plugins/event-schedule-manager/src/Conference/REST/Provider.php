<?php
/**
 * Provider for REST Functionality.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST
 */

namespace TEC\Conference\REST;

use TEC\Conference\Contracts\Service_Provider;
use TEC\Conference\REST\V1\Documentation\OpenAPI_Documentation;
use TEC\Conference\REST\V1\Endpoints\Speaker_List;
use TEC\Conference\REST\V1\Endpoints\Sponsors;

/**
 * Class Provider
 *
 * Provides the functionality for REST API.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST
 */
class Provider extends Service_Provider {

	/**
	 * Binds and sets up implementations.
	 *
	 * @since 1.2.0
	 */
	public function register() {
		// Register the SP on the container.
		$this->container->singleton( 'tec.conference.rests.provider', $this );
		$this->container->singleton( OpenAPI_Documentation::class, OpenAPI_Documentation::class );

		$this->add_actions();
		$this->add_filters();
	}

	/**
	 * Adds required actions for REST API.
	 *
	 * @since 1.2.0
	 */
	protected function add_actions() {
		add_action( 'rest_api_init', [ $this, 'register_endpoints' ] );
	}

	/**
	 * Registers the REST API endpoints for ESM.
	 *
	 * @since 1.2.0
	 */
	public function register_endpoints() {
		$this->container->make( OpenAPI_Documentation::class )->register();
		$this->container->make( Speaker_List::class )->register();
		$this->container->make( Sponsors::class )->register();
	}

	/**
	 * Adds required filters for REST API.
	 *
	 * @since 1.2.0
	 */
	protected function add_filters() {}
}
