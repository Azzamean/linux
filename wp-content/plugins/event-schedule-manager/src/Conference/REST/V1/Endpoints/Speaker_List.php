<?php
/**
 * The Speaker List Endpoint.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Endpoints;
 */

namespace TEC\Conference\REST\V1\Endpoints;

use TEC\Conference\REST\V1\Documentation\OpenAPI_Documentation;
use TEC\Conference\Query\Speaker_List as Speaker_Query;
use TEC\Conference\Vendor\StellarWP\Arrays\Arr;
use WP_REST_Server;
use WP_REST_Request;
use WP_REST_Response;

/**
 * Class Speaker_List.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Endpoints
 */
class Speaker_List extends Abstract_REST_Endpoint {

	// phpcs:disable Squiz.Commenting.VariableComment.MissingVar

	/**
	 * @inheritDoc
	 */
	protected $path = '/speaker-list';

	/**
	 * @inheritdoc
	 */
	protected static $endpoint_id = 'speaker_list';

	/**
	 * An instance of the Speaker_Query class.
	 *
	 * @since 1.2.0
	 *
	 * @var Speaker_Query
	 */
	private $speaker_query;

	// phpcs:enable Squiz.Commenting.VariableComment.MissingVar

	/**
	 * Speaker List constructor.
	 *
	 * @since 1.2.0
	 *
	 * @param OpenAPI_Documentation $documentation An instance of the ESM OpenAPI_Documentation handler.
	 * @param Speaker_Query         $speaker_query An instance of the Speaker_Query class.
	 */
	public function __construct( OpenAPI_Documentation $documentation, Speaker_Query $speaker_query ) {
		$this->speaker_query = $speaker_query;

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
		$request_params         = $request->get_params();
		$args                   = [];
		$args['image_size']     = Arr::get( $request_params, 'image_size', 150 );
		$args['posts_per_page'] = Arr::get( $request_params, 'posts_per_page', 100 );
		$args['orderby']        = Arr::get( $request_params, 'orderby', 'date' );
		$args['order']          = Arr::get( $request_params, 'order', 'desc' );
		$args['track']          = array_filter( array_map( 'trim', explode( ',', Arr::get( $request_params, 'track', '' ) ) ) );
		$args['groups']         = array_filter( array_map( 'trim', explode( ',', Arr::get( $request_params, 'groups', '' ) ) ) );

		$args = $this->parse_args( $args, $request->get_default_params() );

		$data = [];

		/**
		 * Filter the arguments used to get the speak list via REST API.
		 *
		 * @since 1.2.0
		 *
		 * @param array            $args Arguments used to get the events from the archive page.
		 * @param array            $data Array with the data to be returned in the REST response.
		 * @param WP_REST_Request $request The original request.
		 */
		$args = apply_filters( 'tec_event_schedule_manager_speaker_list_rest_get_args', $args, $data, $request );

		$sessions_data = $this->speaker_query->get_sessions_data( $args );
		$speaker_ids   = $sessions_data['speaker_ids'];
		$speakers      = $this->speaker_query->get_speakers( $args, $speaker_ids );

		if ( ! $speakers->have_posts() ) {
			return new WP_REST_Response( $data );
		}

		$speakers_tracks = $sessions_data['speakers_tracks'];
		$speakers        = $this->speaker_query->get_speakers( $args, $speaker_ids );

		$data = $this->speaker_query->process_speaker_data( $speakers, $args, $speakers_tracks );

		/**
		 * Filters the data that will be returned for a speaker list request.
		 *
		 * @since 1.2.0
		 *
		 * @param array           $data    The retrieved data.
		 * @param WP_REST_Request $request The original request.
		 */
		$data = apply_filters( 'tec_event_schedule_manager_rest_speaker_list_data', $data, $request );

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
						'description' => _x( 'Returns successful checking of the new attendee queue.', 'Description for the Speaker List REST endpoint on a successful return.', 'event-schedule-manager' ),
						'schema'      => [
							'$ref' => '#/definitions/ESM',
						],
					],
					'400' => [
						'description' => _x( 'A required parameter is missing or an input parameter is in the wrong format', 'Description for the Speaker List REST endpoint missing a required parameter.', 'event-schedule-manager' ),
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
			'image_size'     => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'default'           => 150,
				'description'       => __( 'The image size of the speakers.', 'event-schedule-manager' ),
				'type'              => 'integer',
			],
			'posts_per_page' => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'default'           => 100,
				'description'       => __( 'The number of speakers to return.', 'event-schedule-manager' ),
				'type'              => 'string',
			],
			'order'          => [
				'required'    => false,
				'description' => __( 'Order sort attribute ascending or descending', 'event-schedule-manager' ),
				'type'        => 'string',
			],
			'orderby'        => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'description'       => __( 'Sort collection by term attribute', 'event-schedule-manager' ),
				'type'              => 'string',
			],
			'track'          => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'description'       => __( 'Events should be assigned one of the specified categories slugs or IDs', 'event-schedule-manager' ),
				'openapi_type'      => 'array',
				'items'             => [ 'type' => 'integer' ],
				'collectionFormat'  => 'csv',
			],
			'groups'         => [
				'required'          => false,
				'sanitize_callback' => [ $this, 'sanitize_callback' ],
				'description'       => __( 'Events should be assigned one of the specified tags slugs or IDs', 'event-schedule-manager' ),
				'openapi_type'      => 'array',
				'items'             => [ 'type' => 'integer' ],
				'collectionFormat'  => 'csv',
			],
		];
	}
}
