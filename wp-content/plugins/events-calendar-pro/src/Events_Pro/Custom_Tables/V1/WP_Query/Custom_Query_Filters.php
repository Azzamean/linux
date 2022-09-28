<?php
/**
 * Handles the interaction of the plugin with the Custom Tables Queries
 * set up in The Events Calendar plugin.
 *
 * @since   6.0.0
 *
 * @package TEC\Events_Pro\Custom_Tables\V1\WP_Query
 */

namespace TEC\Events_Pro\Custom_Tables\V1\WP_Query;

use TEC\Events\Custom_Tables\V1\Tables\Occurrences;
use TEC\Events\Custom_Tables\V1\WP_Query\Custom_Tables_Query;
use TEC\Events_Pro\Custom_Tables\V1\Models\Provisional_Post;
use WP_Query;

/**
 * Class Custom_Query_Filters
 *
 * @since   6.0.0
 *
 * @package TEC\Events_Pro\Custom_Tables\V1\WP_Query
 */
class Custom_Query_Filters {

	const POST_IN = 'tec_ct1_post__in';
	const POST_NOT_IN = 'tec_ct1_post__not_in';

	/**
	 * The Provisional Post ID base.
	 *
	 * @since 6.0.0
	 *
	 * @var int
	 */
	private $provisional_id_base;

	/**
	 * A reference to the current provisional post handler.
	 *
	 * @since 6.0.0
	 *
	 * @var Provisional_Post
	 */
	private $provisional_post;

	/**
	 * Custom_Query_Filters constructor.
	 *
	 * @param int              $provisional_id_base The Provisional Post ID base.
	 * @param Provisional_Post $provisional_post    A reference to the current Provisional
	 *                                              Post provider.
	 */
	public function __construct( $provisional_id_base, Provisional_Post $provisional_post ) {
		$this->provisional_id_base = $provisional_id_base;
		$this->provisional_post    = $provisional_post;
	}

	/**
	 * Returns the SQL code required to select the distinct
	 * Occurrences in the context of a Custom Tables Query.
	 *
	 * @since 6.0.0
	 *
	 * @return string The SQL code required to select the distinct
	 *                Occurrences in the context of a Custom Tables Query.
	 */
	public function get_occurrence_field() {
		$occurrences_table            = Occurrences::table_name( true );
		$occurrences_table_uid_column = Occurrences::uid_column();

		$occurrence_id_field = sprintf(
			'(%1$s.%2$s + %3$d) as %2$s',
			$occurrences_table,
			$occurrences_table_uid_column,
			$this->provisional_id_base
		);

		return $occurrence_id_field;
	}

	/**
	 * Will mutate the $query_vars for custom table queries,
	 * used by the custom query object.
	 *
	 * @since 6.0.0
	 *
	 * @param array<string,mixed> $query_vars The Custom Tables Query variables.
	 *
	 * @return array<string,mixed> The filtered query variables.
	 */
	public function filter_query_vars( array $query_vars ) {
		$keys = [
			'post__not_in' => self::POST_NOT_IN,
			'post__in'     => self::POST_IN,
		];

		foreach ( $keys as $query_var => $occurrence_query_var ) {
			if ( ! isset( $query_vars[ $query_var ] ) ) {
				continue;
			}

			// Move the post IDs, provisional or not, over to our query var.
			$query_vars[ $occurrence_query_var ] = (array) $query_vars[ $query_var ];
			unset( $query_vars[ $query_var ] );
		}

		return $query_vars;
	}

	/**
	 * Depending on the custom table specific `post__in` and `post__not_in` query
	 * vars, update the query `WHERE` statement.
	 *
	 * @since 6.0.0
	 *
	 * @param string   $where The `WHERE` statement as produced
	 * @param WP_Query $query A reference to the Query being filtered.
	 *
	 * @return string The filtered `WHERE` statement.
	 */
	public function filter_where( $where, WP_Query $query ) {
		if ( ! $query instanceof Custom_Tables_Query ) {
			return $where;
		}

		$not__in = $query->get( self::POST_NOT_IN );
		if ( ! empty( $not__in ) ) {
			list( $post_ids, $occurrence_provisional_ids ) = $this->divide_ids( $not__in );
			$sql   = $this->build_in_sql_for( 'post__not_in', $post_ids, $occurrence_provisional_ids );
			$where .= " AND ($sql)";
		}

		$in = $query->get( self::POST_IN );
		if ( ! empty( $in ) ) {
			list( $post_ids, $occurrence_provisional_ids ) = $this->divide_ids( $in );
			$sql   = $this->build_in_sql_for( 'post__in', $post_ids, $occurrence_provisional_ids );
			$where .= " AND ($sql)";
		}

		return $where;
	}

	/**
	 * Divides the IDs found in a `post__not_in` or `post__in` query var between
	 * real post IDs and Occurrence Provisional post IDs.
	 *
	 * @param array<int> $not__in List of IDs
	 *
	 * @return array<array<int>> Two arrays, one of real post IDs, the other of
	 *                           Occurrence provisional post IDs.
	 */
	private function divide_ids( array $not__in ): array {
		$post_ids                   = [];
		$occurrence_provisional_ids = [];
		foreach ( $not__in as $id ) {
			if ( $this->provisional_post->is_provisional_post_id( $id ) ) {
				$occurrence_provisional_ids[] = $id;
			} else {
				$post_ids[] = $id;
			}
		}

		return array( $post_ids, $occurrence_provisional_ids );
	}

	/**
	 * Builds the SQL statement that should be added to the `WHERE` to exclude or include
	 * Occurrences depending on required inclusion statement.
	 *
	 * @since 6.0.0
	 * @param string     $operator                   The operator to build for, either `post__in` or `post__not_in`.
	 * @param array<int> $post_ids                   A list of real post IDs to build the SQL statement for.
	 * @param array<int> $occurrence_provisional_ids A list of Occurrence provisional post IDs  to build the
	 *                                               SQL statement for.
	 *
	 * @return string The built SQL statement.
	 */
	private function build_in_sql_for( $operator, array $post_ids, array $occurrence_provisional_ids ) {
		/*
		 * `post__in` should include post IDs `OR` Occurrence IDs.
		 * `post__not_in` should exclude post IDs `AND` Occurrence IDs.
		 */
		if ( $operator === 'post__in' ) {
			$in_operator      = 'IN';
			$implode_operator = 'OR';
		} else {
			$in_operator      = 'NOT IN';
			$implode_operator = 'AND';
		}
		global $wpdb;
		$occurrence_table = Occurrences::table_name();
		$id_statements    = [];
		if ( count( $occurrence_provisional_ids ) ) {
			$interval        = implode( ',', array_map( [
				$this->provisional_post,
				'normalize_provisional_post_id'
			], $occurrence_provisional_ids ) );
			$id_statements[] = "{$occurrence_table}.occurrence_id {$in_operator} ({$interval})";
		}
		if ( count( $post_ids ) ) {
			$interval        = implode( ',', array_map( 'absint', $post_ids ) );
			$id_statements[] = "{$wpdb->posts}.ID {$in_operator} ({$interval})";
		}

		return implode( " {$implode_operator} ", $id_statements );
	}
}
