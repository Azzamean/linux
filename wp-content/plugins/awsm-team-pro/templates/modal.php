<?php
/**
 * Modal Preset Template.
 *
 * Override this by copying it to currenttheme/awsm-team-pro/modal.php
 *
 * @package awsm-team-pro
 */

?>
<div id="<?php echo esc_attr( $this->add_id( array( 'awsm-team', $id ) ) ); ?>" class="awsm-grid-wrapper">
	<?php echo $this->show_member_search( $id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php echo $this->show_team_filter( $team, $id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<div class="awsm-modal">
	<?php if ( $team->have_posts() ) : ?>
		<div class="awsm-grid-modal awsm-grid <?php echo esc_attr( $this->item_style( $options ) ); ?>">
		<?php
		while ( $team->have_posts() ) :
			$team->the_post();
			$teamdata = $this->get_options( 'awsm_team_member', $team->post->ID );

			$personal_info = sprintf( '<div class="awsm-personal-info"><span>%2$s</span><h3>%1$s</h3></div>', get_the_title(), wp_kses( $teamdata['awsm-team-designation'], 'post' ) );
			/**
			 * Filters the member personal info content.
			 *
			 * @since 1.10.0
			 *
			 * @param string $personal_info The HTML content.
			 * @param array $teamdata Current member data array.
			 * @param mixed $team Team members object.
			 * @param int $id The Team Post ID.
			 */
			$personal_info = apply_filters( 'awsm_team_member_personal_info', $personal_info, $teamdata, $team, $id );

			$member_attrs = $this->get_member_attrs( $team );
			?>
				<div id="<?php echo esc_attr( $this->add_id( array( 'awsm-member', $id, $team->post->ID ) ) ); ?>" class="awsm-grid-card awsm-team-item <?php echo esc_attr( $member_attrs['class'] ); ?>"<?php echo ! empty( $member_attrs['style'] ) ? ' style="' . esc_attr( $member_attrs['style'] ) . '"' : ''; ?>>
					<span id="tigger-style-<?php echo esc_attr( $id . '-' . $team->post->ID ); ?>" class="awsm-team-link-control awsm-modal-trigger awsm-modal-trigger-<?php echo esc_attr( $team->post->ID ); ?>" data-trigger="#modal-style-<?php echo esc_attr( $id . '-' . $team->post->ID ); ?>"<?php Awsm_Team::deep_link_attr( $team->post->ID ); ?>>
						<figure>
							<?php echo $this->get_team_thumbnail( $team->post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<figcaption>
								<?php echo $personal_info; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</figcaption>
						</figure>
					</span>
				</div>
			<?php
			endwhile;
		wp_reset_postdata();

		echo $this->get_search_no_results_content( $id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		</div>
		<div class="awsm-modal-items <?php echo esc_attr( $this->item_style( $options ) ); ?>">
			<span class="awsm-team-link-control awsm-modal-close"></span>
			<div class="awsm-modal-items-main">
				<span class="awsm-team-link-control awsm-nav-item awsm-nav-left"></span>
					<?php
					while ( $team->have_posts() ) :
						$team->the_post();
						$teamdata     = $this->get_options( 'awsm_team_member', $team->post->ID );
						$member_terms = 'awsm-all';
						$terms        = get_the_terms( $team->post->ID, 'awsm_team_filters' );
						if ( ! empty( $terms ) ) {
							foreach ( $terms as $member_term ) {
								$member_terms .= ' awsm-' . str_replace( ' ', '-', $member_term->term_id );
							}
						}
						include $this->get_template_path( 'popup.php', 'partials' );
					endwhile;
					?>
				<span class="awsm-team-link-control awsm-nav-item awsm-nav-right"></span>
			   </div>
		</div>
	<?php endif; ?>
	</div>
	<input type="hidden" name="shortcode" id="atb-shortcode" value=<?php echo esc_attr( $id ); ?> >
</div>
