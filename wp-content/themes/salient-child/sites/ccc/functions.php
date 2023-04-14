<?php

// STYLE SIMPLE BANNER
function simple_banner_head()
{
?>
	<style type="text/css">
		@media only screen and (min-width: 768px) {
			#header-outer {
				margin-top: 80.4px !important;
			}

			.simple-banner {
				margin-top: 33px;
			}
		}

		@media only screen and (max-width: 600px) {

			div#header-outer,
			.ocm-effect-wrap-inner {
				margin-top: 76px !important;
			}

			body[data-slide-out-widget-area-style=slide-out-from-right] .slide_out_area_close {
				top: 110px;
				z-index: 11;
			}
		}
	</style>
	<?php if (is_user_logged_in()) { ?>
		<style type="text/css">
			#wpadminbar {
				position: fixed;
			}
		</style>
	<?php }
}

// CHECK IF SIMPLE BANNER PLUGIN IS ACTIVATED
if (
    in_array(
        "simple-banner/simple-banner.php",
        apply_filters("active_plugins", get_option("active_plugins"))
    )
) {
    add_action("wp_head", "simple_banner_head");
}

// COMMENTS SENT TO HELEN LAU USER INSTEAD OF ADMIN
function se_comment_moderation_recipients( $emails, $comment_id ) {
    $comment = get_comment( $comment_id );
    $post = get_post( $comment->comment_post_ID );
    $user = get_user_by( 'id', '47' );

    // Return only the post author if the author can modify.
    //if ( user_can( $user->ID, 'edit_published_posts' ) && ! empty( $user->user_email ) ) {
        $emails = array( $user->user_email );
    //}

    return $emails;
}
add_filter( 'comment_moderation_recipients', 'se_comment_moderation_recipients', 11, 2 );
add_filter( 'comment_notification_recipients', 'se_comment_moderation_recipients', 11, 2 );