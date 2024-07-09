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
 * Class Speaker_List
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\Editor
 */
class Speaker_List {

	use REST_Namespace;

	/**
	 * Registers the conference schedule block.
	 *
	 * @since 1.2.0
	 */
	public function register_block() {
		register_block_type( Plugin::get_asset_path() . 'js/app/speaker-list' );

		$this->localize_speaker_list_data();
	}

	/**
	 * Localizes the speaker list data to the block editor script.
	 *
	 * @since 1.2.0
	 */
	public function localize_speaker_list_data() {
		/**
		 * Filters the speaker list block query URL.
		 *
		 * @since 1.2.0
		 *
		 * @param string $speaker_list_url The speaker list URL.
		 */
		$speaker_list_url = apply_filters( 'tec_event_schedule_manager_speaker_list_block_query_url', $this->get_url( 'speaker-list' ) );

		wp_localize_script(
			'tec-speaker-list-block-editor-script',
			'tec_event_schedule_manager_speaker_list_data',
			[
				'speaker_list_url' => $speaker_list_url,
			]
		);
	}
}
