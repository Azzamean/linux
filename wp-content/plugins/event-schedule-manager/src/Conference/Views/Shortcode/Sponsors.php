<?php
/**
 * Handles the sponsors shortcode.
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Views\Shortcode
 */

namespace TEC\Conference\Views\Shortcode;

use TEC\Conference\Plugin;
use TEC\Conference\Query\Sponsors as Sponsors_Query;
use TEC\Conference\Vendor\StellarWP\Assets\Assets;

/**
 * Class Sponsors
 *
 * @since 1.0.0
 *
 * @package TEC\Conference\Views\Shortcode
 */
class Sponsors {

	/**
	 * An instance of the Sponsors_Query class.
	 *
	 * @since 1.2.0
	 *
	 * @var Sponsors_Query
	 */
	private $sponsors_query;

	/**
	 * Sponsors constructor.
	 *
	 * @since 1.2.0
	 *
	 * @param Sponsors_Query $sponsors_query An instance of the Sponsors_Query class.
	 */
	public function __construct( Sponsors_Query $sponsors_query ) {
		$this->sponsors_query = $sponsors_query;
	}

	/**
	 * The [tec_sponsors] shortcode handler.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string|mixed> $attr Array of attributes from shortcode.
	 *
	 * @return string The HTML output the shortcode.
	 */
	public function render_shortcode( $attr ) {
		Assets::instance()->enqueue_group( 'event-schedule-manager-views' );

		$attr = shortcode_atts( [
			'link'               => 'none',
			'title'              => 'hidden',
			'content'            => 'hidden',
			'excerpt_length'     => 55,
			'heading_level'      => 'h2',
			'include_unassigned' => true,
		], $attr );

		// Convert 'include_unassigned' to a boolean.
		$attr['include_unassigned'] = filter_var( $attr['include_unassigned'], FILTER_VALIDATE_BOOLEAN );

		$attr['link']      = strtolower( $attr['link'] );
		$terms             = $this->sponsors_query->get_sponsor_levels( 'tec_conference_sponsor_level_order', Plugin::SPONSOR_LEVEL_TAXONOMY, $attr['include_unassigned'] );
		$sponsors_by_terms = $this->sponsors_query->get_sponsors_by_terms( $terms, $attr );

		ob_start();
		?>
		<div class="tec-sponsors">
			<?php
			foreach ( $sponsors_by_terms as $sponsors_by_term ) {
				$term     = $sponsors_by_term['term'];
				$sponsors = $sponsors_by_term['sponsors'];
			?>

			<div class="tec-sponsor-level tec-sponsor-level-<?php echo sanitize_html_class( $term->slug ); ?>">
				<?php
				if ( $term->slug === 'unassigned' && count( $terms ) >= 2 && $attr['include_unassigned'] ) {
					?>
					<hr>
					<?php
				} elseif ( $term->slug !== 'unassigned' ) {
					$heading_level = $attr['heading_level'] ?: 'h2';
					?>
					<<?php echo esc_attr( $heading_level ); ?> class="tec-sponsor-level-heading">
					<span><?php echo esc_html( $term->name ); ?></span>
					</<?php echo esc_attr( $heading_level ); ?>>
					<?php
				}
				?>

				<ul class="tec-sponsor-list">
					<?php foreach ( $sponsors as $sponsor ) { ?>

						<li id="tec-sponsor-<?php echo absint( $sponsor['id'] ); ?>" class="<?php echo esc_attr( implode( ' ', $sponsor['sponsor_classes'] ) ); ?>">
							<?php
							// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
							// phpcs:disable StellarWP.XSS.EscapeOutput.OutputNotEscaped
							echo $this->render_sponsor_title( $sponsor, $attr );
							// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
							// phpcs:enable StellarWP.XSS.EscapeOutput.OutputNotEscaped
							?>
							<div class="tec-sponsor-description">
								<?php
								// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
								// phpcs:disable StellarWP.XSS.EscapeOutput.OutputNotEscaped
								echo $this->render_sponsor_image( $sponsor, $attr );
								// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
								// phpcs:enable StellarWP.XSS.EscapeOutput.OutputNotEscaped
								?>
								<?php if ( $attr['content'] === 'full' ) { ?>
									<?php echo wp_kses_post( $sponsor['content'] ); ?>
								<?php } elseif ( $attr['content'] === 'excerpt' ) { ?>
									<?php echo wp_kses_post( $sponsor['excerpt'] ); ?>
								<?php } ?>
							</div>
						</li>
					<?php } ?>
				</ul>
				</div>
			<?php } ?>
		</div>

		<?php

		wp_reset_postdata();
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Renders the sponsor title.
	 *
	 * @since 1.2.0
	 *
	 * @param array<string|mixed> $sponsor The sponsor data.
	 * @param array<string|mixed> $attr    The shortcode attributes.
	 *
	 * @return string The rendered sponsor title HTML.
	 */
	private function render_sponsor_title( $sponsor, $attr ) {
		if ( $attr['title'] !== 'visible' ) {
			return '';
		}

		ob_start();

		if ( $attr['link'] === 'website' && $sponsor['website'] ) {
			?>
			<h3>
				<a href="<?php echo esc_url( $sponsor['website'] ); ?>">
					<?php echo esc_html( $sponsor['title'] ); ?>
				</a>
			</h3>
			<?php
		} elseif ( $attr['link'] === 'post' ) {
			?>
			<h3>
				<a href="<?php echo esc_url( $sponsor['link'] ); ?>">
					<?php echo esc_html( $sponsor['title'] ); ?>
				</a>
			</h3>
			<?php
		} else {
			?>
			<h3>
				<?php echo esc_html( $sponsor['title'] ); ?>
			</h3>
			<?php
		}

		return ob_get_clean();
	}

	/**
	 * Renders the sponsor image.
	 *
	 * @since 1.2.0
	 *
	 * @param array<string|mixed> $sponsor The sponsor data.
	 * @param array<string|mixed> $attr    The shortcode attributes.
	 *
	 * @return string The rendered sponsor image HTML.
	 */
	private function render_sponsor_image( $sponsor, $attr ) {
		ob_start();

		if ( $attr['link'] === 'website' && $sponsor['website'] ) {
			?>
			<a href="<?php echo esc_url( $sponsor['website'] ); ?>">
				<img
					class="tec-sponsor-image"
					src="<?php echo esc_url( $sponsor['image'] ); ?>"
					alt="<?php esc_attr( $sponsor['title'] ); ?>"
					style="width: auto; max-height: <?php echo esc_attr( $sponsor['logo_height'] ); ?>;"
				/>
			</a>
			<?php
		} elseif ( $attr['link'] === 'post' ) {
			?>
			<a href="<?php echo esc_url( $sponsor['link'] ); ?>">
				<img
					class="tec-sponsor-image"
					src="<?php echo esc_url( $sponsor['image'] ); ?>"
					alt="<?php esc_attr( $sponsor['title'] ); ?>"
					style="width: auto; max-height: <?php echo esc_attr( $sponsor['logo_height'] ); ?>;"
				/>
			</a>
			<?php
		} else {
			?>
			<img
				class="tec-sponsor-image"
				src="<?php echo esc_url( $sponsor['image'] ); ?>"
				alt="<?php esc_attr( $sponsor['title'] ); ?>"
				style="width: auto; max-height: <?php echo esc_attr( $sponsor['logo_height'] ); ?>;"
			/>
			<?php
		}

		return ob_get_clean();
	}

	/**
	 * Returns the sponsor level terms in set order.
	 *
	 * @since 1.0.0
	 * @deprecated 1.2.0
	 *
	 * @param string $option   The option key to fetch from the database.
	 * @param string $taxonomy The taxonomy to fetch terms for.
	 *
	 * @return array Array of term objects.
	 */
	public function get_sponsor_levels( string $option, string $taxonomy, bool $include_unassigned = false ): array {
		_deprecated_function( __METHOD__, '1.2.0', '\TEC\Conference\Query\Sponsors->get_sponsor_levels( $option, $taxonomy, $include_unassigned )' );

		$option       = get_option( $option, [] );
		$term_objects = get_terms(
			[
				'taxonomy'   => $taxonomy,
				'hide_empty' => true,
			]
		);
		$terms        = [];

		foreach ( $term_objects as $term ) {
			$terms[ $term->term_id ] = $term;
		}

		if ( $include_unassigned ) {
			$unassigned_term = (object) [
				'term_id'  => 0,
				'name'     => __( 'Unassigned Sponsors', 'event-schedule-manager' ),
				'slug'     => 'unassigned',
				'taxonomy' => $taxonomy,
			];
			$terms[]         = $unassigned_term;
		}

		return $this->order_terms_by_option( $terms, $option );
	}

	/**
	 * Orders the terms by a given option.
	 *
	 * @since 1.0.0
	 * @deprecated 1.2.0
	 *
	 * @param array $terms  The terms to be ordered.
	 * @param array $option The order option.
	 *
	 * @return array The ordered terms.
	 */
	private function order_terms_by_option( array $terms, array $option ): array {
		_deprecated_function( __METHOD__, '1.2.0', '\TEC\Conference\Query\Sponsors->order_terms_by_option( $terms, $option )' );

		$ordered_terms = [];

		foreach ( $option as $term_id ) {
			if ( isset( $terms[ $term_id ] ) ) {
				$ordered_terms[] = $terms[ $term_id ];
				unset( $terms[ $term_id ] );
			}
		}

		return array_merge( $ordered_terms, array_values( $terms ) );
	}
}
