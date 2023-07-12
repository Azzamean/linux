<?php
if (!defined('ABSPATH')) {
	die('No direct access allowed');
}

if (!class_exists('WPO_Elementor')) :

/**
 * Class to handle used images in Elementor plugin
 */
class WPO_Elementor {

	/**
	 * Constructor
	 */
	private function __construct() {
		if (!defined('ELEMENTOR_VERSION')) return;
		add_filter('wpo_get_posts_content_images_from_plugins', array($this, 'get_posts_content_images'), 10, 2);
	}

	/**
	 * Returns singleton instance
	 *
	 * @return WPO_Elementor
	 */
	public static function instance() {
		static $_instance = null;
		if (null === $_instance) {
			$_instance = new self();
		}
		return $_instance;
	}

	/**
	 * Appends images array with images found in Elementor plugin content
	 *
	 * @param array $images
	 * @param int $post_id
	 *
	 * @return array
	 */
	public function get_posts_content_images($images, $post_id) {
		$data_string = get_post_meta($post_id, '_elementor_data', true);
		$data = json_decode($data_string, true);

		$background_images = array();
		$this->extract_background_images($data, $background_images);
		return array_merge($images, $background_images);
	}

	/**
	 * Extracts background images from decoded json
	 *
	 * @param array|null $data
	 * @param array $background_images
	 *
	 * @return void
	 */
	private function extract_background_images($data, &$background_images) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (preg_match('/^(_)?background(_overlay)?_image$/', $key) && isset($value['id'])) {
					$background_images[] = $value['id'];
				} elseif (is_array($value)) {
					$this->extract_background_images($value, $background_images);
				}
			}
		}
	}
}

endif;
