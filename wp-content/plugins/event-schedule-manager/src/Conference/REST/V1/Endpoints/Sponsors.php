<?php
/**
 * The Sponsors Endpoint.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Endpoints;
 */

namespace TEC\Conference\REST\V1\Endpoints;

use TEC\Conference\Plugin;
use TEC\Conference\REST\V1\Documentation\OpenAPI_Documentation;
use TEC\Conference\Query\Sponsors as Sponsors_Query;
use TEC\Conference\Vendor\StellarWP\Arrays\Arr;
use WP_REST_Server;
use WP_REST_Request;
use WP_REST_Response;

/**
 * Class Sponsors.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Endpoints
 */
class Sponsors extends Abstract_REST_Endpoint {

	// phpcs:disable Squiz.Commenting.VariableComment.MissingVar

	/**
	 * @inheritDoc
	 */
	protected $path = '/sponsors';

	/**
	 * @inheritdoc
	 */
	protected static $endpoint_id = 'sponsors';

	/**
	 * An instance of the Sponsors_Query class.
	 *
	 * @since 1.2.0
	 *
	 * @var Sponsors_Query
	 */
	private $sponsors_query;

	// phpcs:enable Squiz.Commenting.VariableComment.MissingVar

	/**
	 * Sponsors constructor.
	 *
	 * @since 1.2.0
	 *
	 * @param OpenAPI_Documentation $documentation  An instance of the ESM OpenAPI_Documentation handler.
	 * @param Sponsors_Query        $sponsors_query An instance of the Sponsors_Query class.
	 */
	public function __construct( OpenAPI_Documentation $documentation, Sponsors_Query $sponsors_query ) {
		$this->sponsors_query = $sponsors_query;

		parent::__construct( $documentation );
	}

	/**
	 * @inheritDoc
	 */
	public function register() {
		register_rest_route(
			$this->get_esm_route_namespace(),
			$this->get_endpoint_path(),
			[
				'methods'             => WP_REST_Server::READABLE,
				'args'                => $this->READ_args(),
				'callback'            => [ $this, 'get' ],
				'permission_callback' => '__return_true',
			]
		);

		$this->documentation->register_documentation_provider( $this->get_endpoint_path(), $this );
	}

	/**
	 * Handles GET requests on the endpoint.
	 *
	 * @since 1.2.0
	 *
	 * @param WP_REST_Request $request The request object.
	 *
	 * @return WP_Error|WP_REST_Response An array containing the data on success or a WP_Error instance on failure.
	 */
	public function get( WP_REST_Request $request ) {
		$request_params             = $request->get_params();
		$args                       = [];
		$args['posts_per_page']     = Arr::get( $request_params, 'posts_per_page', 100 );
		$args['excerpt_length']     = Arr::get( $request_params, 'excerpt_length', 55 );
		$args['include_unassigned'] = Arr::get( $request_params, 'include_unassigned', true );

		$args = $this->parse_args( $args, $request->get_default_params() );

		$data = [];

		/**
		 * Filter the arguments used to get the sponsors list via REST API.
		 *
		 * @since 1.2.0
		 *
		 * @param array            $args Arguments used to get the events from the archive page.
		 * @param array            $data Array with the data to be returned in the REST response.
		 * @param \WP_REST_Request $request
		 */
		$args = apply_filters( 'tec_event_schedule_manager_sponsors_rest_get_args', $args, $data, $request );

		$terms = $this->sponsors_query->get_sponsor_levels( 'tec_conference_sponsor_level_order', Plugin::SPONSOR_LEVEL_TAXONOMY, $args['include_unassigned'] );
		$data  = $this->sponsors_query->get_sponsors_by_terms( $terms, $args );

		if ( empty( $data ) ) {
			return new WP_REST_Response( $data );
		}

		/**
		 * Filters the data that will be returned for a sponsors list request.
		 *
		 * @since 1.2.0
		 *
		 * @param array           $data    The retrieved data.
		 * @param WP_REST_Request $request The original request.
		 */
		$data = apply_filters( 'tec_event_schedule_manager_rest_sponsors_data', $data, $request );

		return new WP_REST_Response( $data );
	}

	// phpcs:disable StellarWP.Classes.ValidClassName.NotSnakeCase
	// phpcs:disable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
	/**
	 * @inheritDoc
	 */
	public function get_documentation() {
		$POST_defaults = [
			'in'      => 'formData',
			'default' => '',
			'type'    => 'string',
		];
		$post_args     = array_merge( $this->READ_args() );

		return [
			'post' => [
				'consumes'   => [ 'application/x-www-form-urlencoded' ],
				'parameters' => $this->args_to_openapi_schema( $post_args, $POST_defaults ),
				'responses'  => [
					'201' => [
						'description' => esc_html_x( 'Returns successful checking of the new attendee queue.', 'Description for the Sponsors REST endpoint on a successful return.', 'event-schedule-manager' ),
						'schema'      => [
							'$ref' => '#/definitions/ESM',
						],
					],
					'400' => [
						'description' => esc_html_x( 'A required parameter is missing or an input parameter is in the wrong format', 'Description for the Sponsors REST endpoint missing a required parameter.', 'event-schedule-manager' ),
					],
				],
			],
		];
	}
	// phpcs:enable StellarWP.Classes.ValidClassName.NotSnakeCase
	// phpcs:enable WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase

	/**
	 * @inheritDoc
	 */
	public function READ_args() {
		return [
			'posts_per_page'     => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'default'           => 100,
				'description'       => esc_html_x( 'The number of sponsors to return.', 'Description for the posts_per_page argument in the Sponsors REST endpoint.', 'event-schedule-manager' ),
				'type'              => 'integer',
			],
			'excerpt_length'     => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'description'       => esc_html_x( 'The length of the sponsor excerpt.', 'Description for the excerpt_length argument in the Sponsors REST endpoint.', 'event-schedule-manager' ),
				'type'              => 'integer',
			],
			'include_unassigned' => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'description'       => esc_html_x( 'Whether to include unassigned sponsors.', 'Description for the include_unassigned argument in the Sponsors REST endpoint.', 'event-schedule-manager' ),
				'type'              => 'boolean',
			],
		];
	}
}
