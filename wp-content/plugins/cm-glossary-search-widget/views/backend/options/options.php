<?php

use com\cminds\searchwidget\App;
use com\cminds\searchwidget\plugin\options\Options;
use com\cminds\searchwidget\plugin\helpers\HTMLHelper;
?>
<div class="clear"></div>
<hr />

<?php
echo do_shortcode('[cminds_pro_ads id="'.com\cminds\searchwidget\App::SLUG.'"]');
?>

<div class="cmsw">
    <div id="cmsw-plugin-reset-show">
        <hr />
        <p>
            <a href="javascript:void(0)" onclick="jQuery('#cmsw-plugin-reset-show').hide();
                    jQuery('#cmsw-plugin-reset').show();">Show</a> plugin reset options.
        </p>
    </div>
    <div id="cmsw-plugin-reset" style="display: none;">
        <hr />
        <form method="post">
            <p>
                <?php submit_button('Restore options to defaults', 'secondary', NULL, FALSE, array('onclick' => 'return confirm("Are you sure?\n\nThis action cannot be undone.");')); ?>
            </p>
            <input type="hidden" name="cmsw_action_restore_defaults" value="1" />
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('cmsw_action_restore_defaults'); ?>" />
        </form>
    </div>
    <h2 class="nav-tab-wrapper">
        <a href="#cmsw-tab-plugin-options" data-for="general-options" class="nav-tab">Plugin Options</a>
        <a href="#cmsw-tab-plugin-labels" data-for="plugin-labels" class="nav-tab">Plugin Labels</a>
        <a href="#cmsw-tab-plugin-appearance" data-for="plugin-appearance" class="nav-tab">Plugin Appearance</a>
        <a href="#cmsw-tab-plugin-advanced" data-for="plugin-advanced" class="nav-tab">Plugin
            Debug/Advanced</a>
    </h2>
    <form method="post">
        <div data-role="tab" data-tab="general-options" style="display: none;">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="show_on_homepage">Show on Front Page</label></th>
                    <td>
                        <input type="checkbox" id="show_on_homepage" onchange="jQuery(this).next().val(this.checked ? 1 : 0)" <?php echo Options::getOption('show_on_homepage') ? 'checked="checked"' : ''; ?> />
                        <input type="hidden" name="show_on_homepage" value="<?php echo esc_attr(Options::getOption('show_on_homepage')); ?>" />
                        <p class="description">
                            Show <?php echo App::PLUGIN_NAME; ?> on Front Page.<br>This option dedicated for <span style='color: #f00;'>front page <strong>only</strong></span> and isn't overlapped with "Show on given post types - Page" below
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="show_on_glossary_page">Show on Glossary Page</label></th>
                    <td>
                        <input type="checkbox" id="show_on_glossary_page" onchange="jQuery(this).next().val(this.checked ? 1 : 0)" <?php echo Options::getOption('show_on_glossary_page') ? 'checked="checked"' : ''; ?> />
                        <input type="hidden" name="show_on_glossary_page" value="<?php echo esc_attr(Options::getOption('show_on_glossary_page')); ?>" />
                        <p class="description">
                            Show <?php echo App::PLUGIN_NAME; ?> on Glossary Index Page.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="show_on_post_types">Show on given post types</label></th>
                    <td>
                        <fieldset>
                            <input name="show_on_post_types[]" type="hidden" value="" />
                            <?php $post_types = Options::getOption('show_on_post_types'); ?>
                            <?php $items = get_post_types(array('public' => true), 'objects', 'and'); ?>
                            <?php foreach ($items as $item): ?>
                                <?php echo '<label><input name="show_on_post_types[]" type="checkbox" ' . (in_array($item->name, $post_types) ? 'checked="checked"' : '') . ' value="' . esc_attr($item->name) . '" />' . esc_html($item->labels->singular_name . ' (' . $item->name . ')') . '</label><br />'; ?>
                            <?php endforeach; ?>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="number_of_results">Number of results *</label></th>
                    <td>
                        <input name="number_of_results" type="number" min="1" max="50" step="1" id="number_of_results" value="<?php echo intval(Options::getOption('number_of_results')); ?>" class="regular-text" required="required">
                        <p class="description">Max number of results displayed in <?php echo App::PLUGIN_NAME; ?>.<br /><strong>Caution - this option can influence on performance.</strong></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="show_content">Search suggestion with content</label></th>
                    <td>
                        <input type="checkbox" id="show_content" onchange="jQuery(this).next().val(this.checked ? 1 : 0)" <?php echo Options::getOption('show_content') ? 'checked="checked"' : ''; ?> />
                        <input type="hidden" name="show_content" value="<?php echo esc_attr(Options::getOption('show_content')); ?>" />
                        <p class="description">
                            Show first line of founded entries in search suggestion.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="show_icon">Show button</label>
                    </th>
                    <td>
                        <input type="checkbox"
                               id="show_icon"
                               onchange="jQuery(this).next().val(this.checked ? 1 : 0)"
                            <?php echo Options::getOption('show_icon') ? 'checked="checked"' : ''; ?> />
                        <input type="hidden"
                               name="show_icon"
                               value="<?php echo esc_attr(Options::getOption('show_icon')); ?>" />
                        <p class="description">
                            Select this option if you want to add a button which will open the search form on click
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <div data-role="tab" data-tab="plugin-labels" style="display: none;">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="label_title_open">Open title *</label></th>
                    <td>
                        <input name="label_title_open" type="text" id="label_title_open" value="<?php echo esc_attr(Options::getOption('label_title_open')); ?>" class="regular-text" required="required">
                        <p class="description">Title of <?php echo App::PLUGIN_NAME; ?> when open.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="label_title_closed">Close title *</label></th>
                    <td>
                        <input name="label_title_closed" type="text" id="label_title_closed" value="<?php echo esc_attr(Options::getOption('label_title_closed')); ?>" class="regular-text" required="required">
                        <p class="description">Title of <?php echo App::PLUGIN_NAME; ?> when closed.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="label_search_no_results">Search no results label *</label></th>
                    <td>
                        <input name="label_search_no_results" type="text" id="label_search_no_results" value="<?php echo esc_attr(Options::getOption('label_search_no_results')); ?>" class="regular-text" required="required">
                        <p class="description">Message when no results found.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="label_search_placeholder">Search placeholder</label></th>
                    <td>
                        <input name="label_search_placeholder" type="text" id="label_search_placeholder" value="<?php echo esc_attr(Options::getOption('label_search_placeholder')); ?>" class="regular-text">
                        <p class="description">Placeholder of search input.</p>
                    </td>
                </tr>
            </table>
        </div>
        <div data-role="tab" data-tab="plugin-appearance" style="display: none;">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="widget_color">Color *</label></th>
                    <td>
                        <?php echo HTMLHelper::inputColor('widget_color', Options::getOption('widget_color'), array('class' => 'regular-text', 'id' => 'widget_color')); ?>
                        <p class="description"><?php echo App::PLUGIN_NAME; ?> color.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="widget_icon_bg_color">Button Background color</label></th>
                    <td>
                        <?php echo HTMLHelper::inputColor('widget_icon_bg_color', Options::getOption('widget_icon_bg_color'), array('class' => 'regular-text', 'id' => 'widget_icon_bg_color')); ?>
                        <p class="description">Set the background color of the button, which opens the form.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="widget_icon_color">Button icon Color</label></th>
                    <td>
                        <?php echo HTMLHelper::inputColor('widget_icon_color', Options::getOption('widget_icon_color'), array('class' => 'regular-text', 'id' => 'widget_icon_color')); ?>
                        <p class="description">Set the color of the button, which opens the form.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="widget_icon_size">Button Size</label></th>
                    <td>
                        <input name="widget_icon_size"
                               id="widget_icon_size"
                               placeholder="50"
                               value="<?php echo Options::getOption('widget_icon_size'); ?>"
                               type="number" min="0" max="1000"
                               class="regular-text"
                               >
                        <p class="description">Set the button size.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="widget_placement">Placement *</label></th>
                    <td>
                        <select name="widget_placement" id="widget_placement" class="regular-text" required="required">
                            <option value="BL" <?php echo Options::getOption('widget_placement') == 'BL' ? 'selected="selected"' : ''; ?>>Bottom Left</option>
                            <option value="BR" <?php echo Options::getOption('widget_placement') == 'BR' ? 'selected="selected"' : ''; ?>>Bottom Right</option>
                        </select>
                        <p class="description"><?php echo App::PLUGIN_NAME; ?> placement on page.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="show_powered_by">Show powered by</label></th>
                    <td>
                        <input type="checkbox" id="show_powered_by" onchange="jQuery(this).next().val(this.checked ? 1 : 0)" <?php echo Options::getOption('show_powered_by') ? 'checked="checked"' : ''; ?> />
                        <input type="hidden" name="show_powered_by" value="<?php echo esc_attr(Options::getOption('show_powered_by')); ?>" />
                        <p class="description">
                            Show powered by <strong><?php echo App::PLUGIN_NAME_EXTENDED; ?></strong> plugin.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="widget_icon_opened">Custom open button</label></th>
                    <?php wp_enqueue_media(); ?>
                    <td class="CM_Media_Uploader">
                        <?php
                        echo Options::_image_uploader('widget_icon_opened');
                        ?>
                        <p class="description">
                            Upload an image which will be used instead of the default open button<br/>
                            Leave empty to use default
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="widget_icon_closed">Custom close button</label></th>
                    <?php wp_enqueue_media(); ?>
                    <td class="CM_Media_Uploader">
                        <?php
                        echo Options::_image_uploader('widget_icon_closed');
                        ?>
                        <p class="description">
                            Upload an image which will be used instead of the default close button<br/>
                            Leave empty to use default
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <div data-role="tab" data-tab="plugin-advanced" style="display: none;">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="show_content">Pass WP_Query by reference</label></th>
                    <td>
                        <input type="checkbox" id="show_content" onchange="jQuery(this).next()
                                .val(this.checked ? 1 : 0)" <?php echo Options::getOption('pass_query_by_reference') ? 'checked="checked"' : ''; ?> />
                        <input type="hidden" name="pass_query_by_reference" value="<?php echo esc_attr(Options::getOption('pass_query_by_reference')); ?>" />
                        <p class="description">Disable this option only if you
                                get Warning: Parameter 2 to ..\DataFeedAbstract::filterPostWhere()
                                expected to be a reference.
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <input type="hidden" name="cmsw_action_update" value="1" />
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('cmsw_action_update'); ?>" />
        <?php submit_button(); ?>
        <small>* - required fields</small>
    </form>
</div>

<script type="text/javascript">
    (function ($) {
        "use strict";
        $('.cmsw .nav-tab').on('click', function () {
            $('.cmsw .nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.cmsw *[data-role="tab"]').hide();
            $('.cmsw *[data-role="tab"][data-tab="' + $(this).data('for') + '"]').show();
        });
        if ($('.cmsw a[href="' + window.location.hash + '"]').click().length != 1) {
            $('.cmsw a.nav-tab').first().click();
        }
        $('.cmsw input[type="submit"]').on('click', function () {
            if ($('.cmsw form').find(':invalid')) {
                var tab = $('.cmsw form').find(':invalid').first().parents('*[data-role="tab"]').data('tab');
                $('.cmsw').find('a[data-for="' + tab + '"]').click();
            }
        });
    })(jQuery);
</script>
<style type="text/css">
    .cmsw{
        min-height: 600px;
    }
</style>