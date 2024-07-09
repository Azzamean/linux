<?php
/**
 * View: Sponsors Block.
 *
 * @since 1.2.0
 *
 * @version 1.0.0
 *
 * var array<string,mixed> $attributes array<string|mixed> An array of the block attributes.
 */

use TEC\Conference\Views\Shortcode\Sponsors;
use TEC\Conference\Query\Sponsors as Sponsors_Query;

$sponsors = new Sponsors( new Sponsors_Query() );

echo $sponsors->render_shortcode( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped, StellarWP.XSS.EscapeOutput.OutputNotEscaped
