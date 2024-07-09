<?php
/**
 * View: Speaker List Block.
 *
 * @since 1.2.0
 *
 * @version 1.2.0
 *
 * var array<string,mixed> $attributes array<string|mixed> An array of the block attributes.
 */

use TEC\Conference\Views\Shortcode\Speakers;
use TEC\Conference\Query\Speaker_List;

$speakers = new Speakers( new Speaker_List() );

echo $speakers->render_shortcode( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped, StellarWP.XSS.EscapeOutput.OutputNotEscaped
