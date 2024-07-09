<?php
/**
 * Handles Event Schedule Manager Speakers List Block,
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\Editor
 */

namespace TEC\Conference\Editor;

use TEC\Conference\REST\V1\Traits\REST_Namespace;

use TEC\Conference\Plugin;

/**
 * Class sponsors
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\Editor
 */
class Sponsors {

	use REST_Namespace;

	/**
	 * Registers the conference schedule block.
	 *
	 * @since 1.2.0
	 */
	public function register_block() {
		register_block_type( Plugin::get_asset_path() . 'js/app/sponsors' );

		$this->localize_sponsors_data();
	}

	/**
	 * Localizes the sponsors data to the block editor script.
	 *
	 * @since 1.2.0
	 */
	public function localize_sponsors_data() {
		/**
		 * Filters the sponsors block query URL.
		 *
		 * @since 1.2.0
		 *
		 * @param string $sponsors_url The sponsors URL.
		 */
		$sponsors_url = apply_filters( 'tec_event_schedule_manager_sponsors_block_query_url', $this->get_url( 'sponsors' ) );

		wp_localize_script(
			'tec-sponsors-list-block-editor-script',
			'tec_event_schedule_manager_sponsors_data',
			[
				'sponsors_url' => $sponsors_url,
			]
		);
	}
}
