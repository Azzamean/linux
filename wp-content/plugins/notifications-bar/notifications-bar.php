<?php
/*
Plugin Name: Notifications Bar
Description: A customizable notifications bar for Linux Foundation Project Sites using the Salient theme
Version: 1.3
Author: Andrew Bringaze
Author URI: https://www.linuxfoundation.org/
License: GPLv2
*/

// Enqueue the necessary CSS and JavaScript files
function notification_bar_enqueue_scripts()
{
    wp_enqueue_style(
        "notifications-bar-style",
        plugins_url("css/notifications-bar.css", __FILE__)
    );
    //wp_enqueue_script( 'notifications-bar-script', plugins_url( 'js/notifications-bar.js', __FILE__ ), array( 'jquery' ), '1.0', true );
}
add_action("wp_enqueue_scripts", "notification_bar_enqueue_scripts");

// Create a custom admin page for the notifications bar settings
function notification_bar_admin_menu()
{
    //add_submenu_page( 'tools.php', 'Notifications Bar', 'Notifications Bar', 'manage_options', 'notifications-bar', 'notification_bar_settings_page' );
    add_submenu_page(
        "tools.php",
        "Notifications Bar",
        "Notifications Bar",
        "manage_options",
        "notifications-bar",
        "notification_bar_settings_page"
    );
}
add_action("admin_menu", "notification_bar_admin_menu");

// Display the notifications bar on the front-end
function notification_bar_display()
{
    // Get the user-defined settings from the database
    $notification_bar_text = get_option("notification_bar_text") ?: "";
    $notification_background_color =
        get_option("notification_background_color") ?: "#ffffff";
    $notification_text_color =
        get_option("notification_text_color") ?: "inherit";
    $notification_link_color =
        get_option("notification_link_color") ?: "inherit";

    // Output the HTML for the notifications bar if it is not empty
    if ($notification_bar_text != "") {
        echo '<div class="notifications-bar">';
        echo '<div class="container">';
        echo "<div>" . $notification_bar_text . "</div>";
        echo "</div>";
        echo "</div>";

        // Styles pulled
        echo "<style>";
        echo ".notifications-bar { background-color: " .
            $notification_background_color .
            "; }";
        echo ".notifications-bar { color: " . $notification_text_color . "; }";
        echo ".notifications-bar a { color: " .
            $notification_link_color .
            "; }";
        echo "</style>";
    }
}
// THIS METHOD IS BEING MOVED INTO THE SALIENT HEADER FILE IN THE CHILD THEME
//add_action("wp_head", "notification_bar_display");

// Create the settings page for the notifications bar
function notification_bar_settings_page()
{
    // Save the settings when the form is submitted
    if (isset($_POST["notification_bar_save_settings"])) {
        update_option(
            "notification_bar_text",
            wp_kses_post($_POST["notification_bar_text"])
        ); // Save the settings when the form is submitted
        update_option(
            "notification_background_color",
            sanitize_text_field($_POST["notification_background_color"])
        );
        update_option(
            "notification_text_color",
            sanitize_text_field($_POST["notification_text_color"])
        );

        update_option(
            "notification_link_color",
            sanitize_text_field($_POST["notification_link_color"])
        );

        echo '<div class="notice notice-success"><p>Settings saved successfully!</p></div>';
    }

    // Get the current settings from the database
    $notification_bar_text = get_option("notification_bar_text");
    $notification_background_color = get_option(
        "notification_background_color"
    );
    $notification_text_color = get_option("notification_text_color");
    $notification_link_color = get_option("notification_link_color");

    // Output the settings page HTML
    ?>
    <div class="wrap">
        <h1>Notifications Bar Settings</h1>
        <form method="post" action="">
            <table class="form-table">
			
                <tr valign="top">
                    <th scope="row">Notifications Bar Text</th>
                    <td>
			           <?php
    // Output the WYSIWYG editor
    ?>
				<?php wp_editor($notification_bar_text, "notification_bar_text", [
        "textarea_name" => "notification_bar_text",
        "media_buttons" => false,
        "plugins" => "tinymcespellchecker",
        "textarea_rows" => 5,
        "quicktags" => ["buttons" => ","],
        "tinymce" => [
            "toolbar1" =>
                "formatselect,fontsizeselect, bold,italic,underline, link,unlink, alignleft, aligncenter, alignright, alignjustify",
            "toolbar2" => "",
            "toolbar3" => ""
        ]
    ]); ?>
					</td>
                </tr>	
                <tr valign="top">
                    <th scope="row">Notifications Bar Background Color</th>
                    <td><input type="text" name="notification_background_color" value="<?php echo esc_attr(
                        $notification_background_color
                    ); ?>" /></td>
                </tr>				
				<tr valign="top">
                    <th scope="row">Notifications Text Color</th>
                    <td><input type="text" name="notification_text_color" value="<?php echo esc_attr(
                        $notification_text_color
                    ); ?>" /></td>
                </tr>
								<tr valign="top">
                    <th scope="row">Notifications Link Color</th>
                    <td><input type="text" name="notification_link_color" value="<?php echo esc_attr(
                        $notification_link_color
                    ); ?>" /></td>
                </tr>

            </table>
            <p class="submit">
                <input type="submit" name="notification_bar_save_settings" class="button-primary" value="Save Settings" />
            </p>
        </form>
    </div>
    <?php
}
