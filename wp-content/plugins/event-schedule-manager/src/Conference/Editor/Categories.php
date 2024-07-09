<?php
/**
 * Handles Event Schedule Manager Block,
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Editor
 */

namespace TEC\Conference\Editor;

/**
 * Class Block
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Editor
 */
class Categories {

	/**
	 * Registers the Event Schedule Manager block category.
	 *
	 * @since 1.2.0
	 *
	 * @param array<string|mixed> $categories The block categories.
	 *
	 * @return array<string|mixed> $categories The block categories.
	 */
	public function register_category( $categories ) {
		$categories[] = [
			'slug'  => 'event-schedule-manager',
			'title' => esc_html_x( 'Event Schedule Manager', 'The title for Event Schedule Manager block category.', 'event-schedule-manager' ),
		];

		return $categories;
	}
}
