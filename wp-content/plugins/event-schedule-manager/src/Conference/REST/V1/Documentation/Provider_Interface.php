<?php
/**
 * The Provider Interface.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Documentation
 */

namespace TEC\Conference\REST\V1\Documentation;

/**
 * Provider Interface.
 *
 * @since 1.2.0
 *
 * @package TEC\Conference\REST\V1\Documentation
 */
interface Provider_Interface {

	/**
	 * Returns an array in the format used by OpenAPI 3.0.
	 *
	 * While the structure must conform to that used by v3.0 of OpenAPI the structure can be that of a full document
	 * or that of a document part.
	 * The intelligence lies in the "gatherer" of informations rather than in the single "providers" implementing this
	 * interface.
	 *
	 * @since 1.2.0
	 *
	 * @return array<string|mixed> An array description of a OpenAPI supported component.
	 */
	public function get_documentation();
}
