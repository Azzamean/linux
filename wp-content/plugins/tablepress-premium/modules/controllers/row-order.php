<?php
/**
 * TablePress Row Order.
 *
 * @package TablePress
 * @subpackage Row Order.
 * @author Tobias Bäthge
 * @since 2.0.0
 */

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

/**
 * Class that contains the logic for the Row Order feature for TablePress.
 *
 * @author Tobias Bäthge
 * @since 2.0.0
 */
class TablePress_Module_Row_Order {
	use TablePress_Module; // Use properties and methods from trait.

	/**
	 * For the "sort" order, column number that shall be sorted on.
	 *
	 * @since 2.0.0
	 * @var int
	 */
	protected static $sort_column;

	/**
	 * Registers necessary plugin filter hooks.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		add_filter( 'tablepress_table_template', array( __CLASS__, 'add_option_to_table_template' ) );
		add_filter( 'tablepress_shortcode_table_default_shortcode_atts', array( __CLASS__, 'add_shortcode_parameters' ) );
		add_filter( 'tablepress_datatables_serverside_processing_render_options', array( __CLASS__, 'add_serverside_processing_render_options' ), 10, 3 );
		add_filter( 'tablepress_table_render_options', array( __CLASS__, 'turn_off_caching' ), 10, 2 );
		add_filter( 'tablepress_table_evaluate_data', array( __CLASS__, 'after_evaluate_processing' ), 10, 3 );
		add_filter( 'tablepress_table_render_data', array( __CLASS__, 'after_render_processing' ), 10, 3 );
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_block_editor_js' ) );
	}

	/**
	 * Adds options related to Row Order to the table template.
	 *
	 * @since 2.0.0
	 *
	 * @param array<string, mixed> $table Current table template.
	 * @return array<string, mixed> Extended table template.
	 */
	public static function add_option_to_table_template( array $table ): array {
		$table['options']['row_order'] = 'default';
		$table['options']['row_order_sort_column'] = '';
		$table['options']['row_order_sort_direction'] = 'asc';
		$table['options']['row_order_manual_order'] = '';
		return $table;
	}

	/**
	 * Adds parameters for the Row Order feature to the [table /] Shortcode.
	 *
	 * By using null as the default value, the table options's value will be used (if set).
	 *
	 * @since 2.0.0
	 *
	 * @param array<string, mixed> $default_atts Default Shortcode attributes.
	 * @return array<string, mixed> Extended Shortcode attributes.
	 */
	public static function add_shortcode_parameters( array $default_atts ): array {
		$default_atts['row_order'] = null;
		$default_atts['row_order_sort_column'] = null;
		$default_atts['row_order_sort_direction'] = null;
		$default_atts['row_order_manual_order'] = null;
		return $default_atts;
	}

	/**
	 * Adds parameters for the Row Order feature to the DataTables Server-side Processing render options.
	 *
	 * @since 2.1.0
	 *
	 * @param array<string, mixed> $render_options_ssp Render Options list for Server-side Processing.
	 * @param string               $table_id           Table ID.
	 * @param array<string, mixed> $render_options     Render Options.
	 * @return string[] Modified Render Options list for Server-side Processing.
	 */
	public static function add_serverside_processing_render_options( array $render_options_ssp, string $table_id, array $render_options ): array {
		$render_options_ssp[] = 'row_order';
		$render_options_ssp[] = 'row_order_sort_column';
		$render_options_ssp[] = 'row_order_sort_direction';
		$render_options_ssp[] = 'row_order_manual_order';
		return $render_options_ssp;
	}

	/**
	 * Registers the module's JS script for the block editor.
	 *
	 * @since 2.0.0
	 */
	public static function enqueue_block_editor_js(): void {
		TablePress_Modules_Helper::enqueue_script( 'row-order-block' );
	}

	/**
	 * Deactivates Table Output caching, if the "random" row order is used.
	 *
	 * @since 2.0.0
	 *
	 * @param array<string, mixed> $render_options Render Options.
	 * @param array<string, mixed> $table          Table.
	 * @return array<string, mixed> Modified Render Options.
	 */
	public static function turn_off_caching( array $render_options, array $table ): array {
		if ( 'random' === $render_options['row_order'] ) {
			$render_options['cache_table_output'] = false;
		}

		return $render_options;
	}

	/**
	 * Sort function for the "sort" row order.
	 *
	 * @since 2.0.0
	 *
	 * @param string[] $a First row for the comparison.
	 * @param string[] $b Second row for the comparison.
	 * @return int Result of the comparison.
	 */
	public static function compare_rows( array $a, array $b ): int {
		return strnatcasecmp( $a[ self::$sort_column ], $b[ self::$sort_column ] );
	}

	/**
	 * Changes the order of the rows, for the "sort" row order.
	 *
	 * @since 2.0.0
	 *
	 * @param array<string, mixed> $table          Table.
	 * @param array<string, mixed> $orig_table     Original table.
	 * @param array<string, mixed> $render_options Render Options.
	 * @return array<string, mixed> Modified table.
	 */
	public static function after_evaluate_processing( array $table, array $orig_table, array $render_options ): array {
		switch ( $render_options['row_order'] ) {
			case 'sort':
				$array_to_sort = &$table['data'];
				if ( $render_options['table_head'] ) {
					$head_row = array_shift( $array_to_sort );
				}
				if ( $render_options['table_foot'] ) {
					$foot_row = array_pop( $array_to_sort );
				}

				// Sort the table body rows on the given column.
				if ( '' !== $render_options['row_order_sort_column'] ) {
					if ( ! is_numeric( $render_options['row_order_sort_column'] ) ) {
						$render_options['row_order_sort_column'] = TablePress::letter_to_number( $render_options['row_order_sort_column'] );
					}
					self::$sort_column = (int) $render_options['row_order_sort_column'] - 1;
					usort( $array_to_sort, array( __CLASS__, 'compare_rows' ) );
					if ( 'desc' === strtolower( $render_options['row_order_sort_direction'] ) ) {
						$array_to_sort = array_reverse( $array_to_sort );
					}
				}

				if ( $render_options['table_head'] ) {
					array_unshift( $array_to_sort, $head_row ); // @phpstan-ignore-line ($head_row is defined in the same if-condition above.)
				}
				if ( $render_options['table_foot'] ) {
					array_push( $array_to_sort, $foot_row ); // @phpstan-ignore-line ($foot_row is defined in the same if-condition above.)
				}
				break;

			default:
				break;
		}

		return $table;
	}

	/**
	 * Change the order of the rows, for "random", "reverse", and "manual" order.
	 *
	 * @since 2.0.0
	 *
	 * @param array<string, mixed> $table          Table.
	 * @param array<string, mixed> $orig_table     Original table.
	 * @param array<string, mixed> $render_options Render Options.
	 * @return array<string, mixed> Modified table.
	 */
	public static function after_render_processing( array $table, array $orig_table, array $render_options ): array {
		if ( 'default' === $render_options['row_order'] ) {
			return $table;
		}

		// Exit early if there's no actual table data (e.g. after using the Row Filter module).
		if ( 0 === count( $table['data'] ) ) {
			return $table;
		}

		switch ( $render_options['row_order'] ) {
			case 'random':
				$array_to_shuffle = &$table['data'];
				if ( $render_options['table_head'] ) {
					$head_row = array_shift( $array_to_shuffle );
				}
				if ( $render_options['table_foot'] ) {
					$foot_row = array_pop( $array_to_shuffle );
				}

				// Bring the table body rows into random order.
				shuffle( $array_to_shuffle );

				if ( $render_options['table_head'] ) {
					array_unshift( $array_to_shuffle, $head_row );
				}
				if ( $render_options['table_foot'] ) {
					array_push( $array_to_shuffle, $foot_row );
				}
				break;

			case 'reverse':
				$array_to_reverse = &$table['data'];
				if ( $render_options['table_head'] ) {
					$head_row = array_shift( $array_to_reverse );
				}
				if ( $render_options['table_foot'] ) {
					$foot_row = array_pop( $array_to_reverse );
				}

				// Reverse the table body rows.
				$array_to_reverse = array_reverse( $array_to_reverse );

				if ( $render_options['table_head'] ) {
					array_unshift( $array_to_reverse, $head_row );
				}
				if ( $render_options['table_foot'] ) {
					array_push( $array_to_reverse, $foot_row );
				}
				break;

			case 'manual':
				$num_rows = (string) count( $table['data'] );
				$original_row_order = $render_options['row_order_manual_order'];

				if ( '' === $original_row_order ) {
					break;
				}

				// We have a list of rows (possibly with ranges in it).
				$original_row_order = explode( ',', $original_row_order );
				$row_order = array();

				foreach ( $original_row_order as $key => $value ) {
					$value = trim( $value );

					// Convert keywords to corresponding row numbers or ranges.
					if ( 'all' === $value ) {
						$value = '1-' . $num_rows;
					} elseif ( 'reverse' === $value ) {
						$value = $num_rows . '-1';
					} elseif ( 'last' === $value ) {
						$value = $num_rows;
					}

					// Possibly expand ranges.
					$range_dash = strpos( $value, '-' );
					if ( false !== $range_dash ) {
						// Range.
						$start = trim( substr( $value, 0, $range_dash ) );
						$end = trim( substr( $value, $range_dash + 1 ) );
						$value = range( $start, $end );
					} else {
						// No range.
						$value = array( $value );
					}

					$row_order = array_merge( $row_order, $value );
				}

				// Build new table.
				$table_data = array();
				foreach ( $row_order as $idx => $row_number ) {
					$row_number = absint( $row_number ) - 1; // Convert numbers to indices.
					if ( isset( $table['data'][ $row_number ] ) ) {
						$table_data[] = $table['data'][ $row_number ];
					}
				}

				if ( ! empty( $table_data ) ) {
					$table['data'] = $table_data;
				}

				break;

			default:
				break;
		}

		return $table;
	}

} // class TablePress_Module_Row_Order
