<?php

namespace TEC\Conference\Site_Health;

/**
 * Interface for Site Health Info Field.
 *
 * @link https://developer.wordpress.org/reference/hooks/debug_information/
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Site_Health
 */
interface Info_Field_Interface {

	/**
	 * Gets the ID for this field.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_id(): string;

	/**
	 * Gets the label for this field.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_label(): string;

	/**
	 * Gets the value for this field.
	 * Text should be translated. Can be an associative array that is displayed as name/value pairs.
	 *
	 * @since 1.0.0
	 *
	 * @return string|int|float|array<int>|array<float>|array<string>
	 */
	public function get_value();

	/**
	 * Gets the priority for the field, used to order fields in a section.
	 *
	 * @since 1.0.0
	 *
	 * @return int
	 */
	public function get_priority(): int;

	/**
	 * Get the debug value for the field.
	 *
	 * Optional. The output that is used for this field when the user copies the data. It should be more concise and
	 * not translated. If not set, the content of $value is used. Note that the array keys are used as labels for
	 * the copied data.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_debug(): string;

	/**
	 * Determines if the field is private or not.
	 *
	 * Optional. If set to true, the field will be excluded from the copied data, allowing you to show, for example, API keys here. Default false.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function is_private(): bool;

	/**
	 * Pulls all the params for this field into an array consumable by the site health info page.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function to_array(): array;
}
