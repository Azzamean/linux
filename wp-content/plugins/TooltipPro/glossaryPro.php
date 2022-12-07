<?php

class CMTT_Pro {

    protected static $messages = '';

    public static function init() {
        global $cmtt_isLicenseOk;

        self::includeFiles();

        self::initFiles();

        self::setup_constants();

        if ($cmtt_isLicenseOk) {

            add_filter('cmtt_parse_addition_add', array(__CLASS__, 'parseSynonymsAndVariations'), 10, 2);
            add_filter('cmtt_glossary_index_item_additions', array(__CLASS__, 'addSynonymsAndVariations'), 10, 2);

            remove_filter('cmtt_settings_tooltip_tab_content_after', array('CMTT_Free', 'cmtt_settings_tooltip_tab_content_after'));
            add_filter('cmtt_settings_tooltip_tab_content_after', array(__CLASS__, 'cmtt_settings_tooltip_tab_content_after'), 1000);

            if (\CM\CMTT_Settings::get('cmtt_withoutGlossaryForTermLink')) {
                add_filter('post_type_link', array(__CLASS__, 'cmtt_remove_glossary_from_link'), 999, 2);
                add_action('pre_get_posts', array(__CLASS__, 'cmtt_update_rule_for_term_links'));
            }
            /*
             * Footnotes
             */
            add_filter('cmtt_show_tooltips', array(__CLASS__, 'maybeDisplayFootnotes'), 200, 3);
            add_filter('cmtt_parsed_content', array(__CLASS__, 'onFootnotesDefs'), 200);
            add_action('cmtt_add_disables_metabox', array(__CLASS__, 'addDisablesFields'));
            add_action('cmtt_on_glossary_item_save_before', array(__CLASS__, 'saveDisableRelatedPosts'), 14, 2);

            add_action('admin_init', array(__CLASS__, 'cmtt_glossary_handleexport'));
            if (\CM\CMTT_Settings::get('cmtt_glossaryShowShareBoxTermPage') == 1) {
                add_filter('cmtt_glossary_term_after_content', array(
                    __CLASS__,
                    'cmtt_glossaryAddShareBox'
                ));
            }
            add_filter('cmtt_tooltip_content_add', array(__CLASS__, 'addEditlinkToTooltip'), 10, 2);
            add_filter('cmtt_tooltip_content_add', array(
                __CLASS__,
                'addTermPageLinkToTooltip'
                    ), 100, 2);

            add_action('wp_ajax_cmtt_get_glossary_backup', array(__CLASS__, 'cmtt_glossary_get_backup'));
            add_action('wp_ajax_nopriv_cmtt_get_glossary_backup', array(
                __CLASS__,
                'cmtt_glossary_get_backup'
            ));

            add_action('admin_init', array(__CLASS__, '_cmtt_rescheduleBackup'));
            add_action('cmtt_glossary_backup_event', array(__CLASS__, '_cmtt_doBackup'));
            add_action('cmtt_save_options_before', array(__CLASS__, 'flushCaps'), 10, 2);
            add_filter('cmtt_glossary_index_content_arr', array(__CLASS__, 'addSynonymsToGlossaryIndex'), 10, 5);
            add_filter('cmtt_modify_listnav_counts_term', array(__CLASS__, 'addSynonymsCount'), 10, 3);
            add_action('cmtt_add_submenu_pages', array(__CLASS__, 'add_submenu_pages'));

            add_action('cmtt_replace_template_after_synonyms', array(__CLASS__, 'checkPrivateTerms'), 32, 3);

            /*
             * Tooltips in Ninja tables
             */
            if (\CM\CMTT_Settings::get('cmtt_glossaryParseNinjaTables', 0) == 1) {
                add_filter('ninja_tables_get_public_data', array(
                    __CLASS__,
                    'cmtt_parse_ninja_tables'
                        ), 10, 2);
            }

            /*
             * Tooltips in BuddyBoss Activity Content
             */
            if (\CM\CMTT_Settings::get('cmtt_parseBuddyBossActivityContent')) {
                add_filter('bp_get_activity_content_body', array(
                    __CLASS__,
                    'cmtt_bp_parse'
                        ), \CM\CMTT_Settings::get('cmtt_tooltipParsingPriority', 20000), 2);
            }

            /*
             * Mobile support
             */
            add_filter('cmtt_tooltip_script_data', array(__CLASS__, 'addTooltipScriptData'));
        }
    }

    /**
     * Don't show private terms for other users
     * @param string $titleIndex
     * @param string $title
     * @return type
     */
    public static function checkPrivateTerms($currentItem, $titleIndex, $title) {
        $private = CMTT_Free::_get_meta('cmtt_private', $currentItem->ID);

        if ($private) {
            $current_user = get_current_user_id();
            $author = $currentItem->post_author;
            if ($current_user != $author) {
                throw new GlossaryTooltipException($title);
            }
        }
    }

    public static function cmtt_settings_tooltip_tab_content_after($content) {
        ob_start();
        ?>
        <div class="block">
            <h3 class="section-title">
                <span>Tooltip - Styling</span>
                <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
                    <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
                </svg>
            </h3>
            <table class="floated-form-table form-table">
                <tr valign="top">
                    <th scope="row">Show "Close" icon</th>
                    <td>
                        <input type="hidden" name="cmtt_tooltipShowCloseIcon" value="0" />
                        <input type="checkbox" name="cmtt_tooltipShowCloseIcon" <?php checked(true, \CM\CMTT_Settings::get('cmtt_tooltipShowCloseIcon', 1)); ?> value="1" />
                    </td>
                    <td colspan="2" class="cm_field_help_container">With this option you can choose:<br/>
                        <strong>TRUE</strong> - the close icon will be displayed<br/>
                        <strong>FALSE</strong> - there won't be the close icon<br/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show "Close" icon only on mobile devices</th>
                    <td>
                        <input type="hidden" name="cmtt_tooltipShowCloseIconMobile" value="0" />
                        <input type="checkbox" name="cmtt_tooltipShowCloseIconMobile" <?php checked(true, \CM\CMTT_Settings::get('cmtt_tooltipShowCloseIconMobile', 0)); ?> value="1" />
                    </td>
                    <td colspan="2" class="cm_field_help_container">With this option you can choose:<br/>
                        <strong>TRUE</strong> - the close icon will be displayed only on mobile devices<br/>
                        <strong>FALSE</strong> - the close icon will be displayed on all devices<br/>
                        <strong>Note:</strong> to use this option you need to enable "Show Close icon"
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Close icon color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipCloseColor" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipCloseColor', '#222'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set color of tooltip close icon</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Close icon size</th>
                    <td><input type="number" name="cmtt_tooltipCloseSize" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipCloseSize', 20); ?>" step="1" min="0" max="50"/>px</td>
                    <td colspan="2" class="cm_field_help_container">Set the size of the tooltip close icon</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip background color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipBackground" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipBackground'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set color of tooltip background</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip text color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipForeground" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipForeground'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set color of tooltip text color</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip title's font size</th>
                    <td><input type="number" name="cmtt_tooltipTitleFontSize" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipTitleFontSize'); ?>"
                               step="1" min="0" max="50"/>px</td>
                    <td colspan="2" class="cm_field_help_container">Set font-size of term title in the tooltip. (Works only if the option "Add term
                        title to the tooltip content?" is set)</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip title's text color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipTitleColor_text" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipTitleColor_text'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set color of term title in the tooltip. (Works only if the option "Add term title to the tooltip content?" is set)</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip title's background color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipTitleColor_background" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipTitleColor_background'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set color of the title's background in the tooltip. (Works only if the option "Add term title to the tooltip content?" is set)</td>
                </tr>
                <tr valign="top" class="whole-line">
                    <th scope="row">Tooltip border</th>
                    <td>Style: <select name="cmtt_tooltipBorderStyle">
                            <option value="none" <?php selected('none', \CM\CMTT_Settings::get('cmtt_tooltipBorderStyle')); ?>>None</option>
                            <option value="solid" <?php selected('solid', \CM\CMTT_Settings::get('cmtt_tooltipBorderStyle')); ?>>Solid</option>
                            <option value="dotted" <?php selected('dotted', \CM\CMTT_Settings::get('cmtt_tooltipBorderStyle')); ?>>Dotted</option>
                            <option value="dashed" <?php selected('dashed', \CM\CMTT_Settings::get('cmtt_tooltipBorderStyle')); ?>>Dashed</option>
                        </select><br />
                        Width: <input type="number" name="cmtt_tooltipBorderWidth" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipBorderWidth'); ?>" step="1" min="0" max="10"/>px<br />
                        Color: <input type="text" class="colorpicker" name="cmtt_tooltipBorderColor" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipBorderColor'); ?>" />
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set border styling (style, width, color)</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip rounded corners radius</th>
                    <td><input type="number" name="cmtt_tooltipBorderRadius" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipBorderRadius'); ?>" step="1" min="0" max="50"/>px</td>
                    <td colspan="2" class="cm_field_help_container">Set rounded corners radius</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip opacity</th>
                    <td><input type="number" name="cmtt_tooltipOpacity" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipOpacity', 90); ?>" step="1" min="1" max="100"/></td>
                    <td colspan="2" class="cm_field_help_container">Set opacity of tooltip (100=fully opaque, 0=transparent)</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip z-index</th>
                    <td><input type="number" name="cmtt_tooltipZIndex" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipZIndex', 1500); ?>" step="1" min="1"/></td>
                    <td colspan="2" class="cm_field_help_container">Set tooltip z-index</td>
                </tr>
                <tr valign="top" class="whole-line">
                    <th scope="row">Tooltip sizing</th>
                    <td>Min. width: <input type="number" style="width:50px" name="cmtt_tooltipWidthMin" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipWidthMin', 200); ?>" step="1"/>px<br />
                        Max. width: <input type="number" style="width:50px" name="cmtt_tooltipWidthMax" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipWidthMax', 400); ?>" step="1"/>px
                    </td>
                    <td colspan="2" class="cm_field_help_container">Set the minimal size of the tooltip in pixels. </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip placement</th>
                    <td>
                        <?php
                        $positionsArray = array(
                            'horizontal' => 'Left/right',
                            'vertical'   => 'Top/bottom',
                        );
                        ?>
                        <select name="cmtt_tooltipPlacement">
                            <?php foreach ($positionsArray as $position => $positionLabel) : ?>
                                <option value="<?php echo $position ?>" <?php selected($position, \CM\CMTT_Settings::get('cmtt_tooltipPlacement', 'horizontal')); ?>>
                                    <?php echo $positionLabel ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td colspan="2" class="cm_field_help_container">Choose the location of the tooltip.</td>
                </tr>
                <tr valign="top" class="whole-line">
                    <th scope="row">Tooltip positioning</th>
                    <td>Vertical: <input type="number" style="width:50px" name="cmtt_tooltipPositionTop" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipPositionTop'); ?>" step="1"/>px<br />
                        Horizontal: <input type="number" style="width:50px" name="cmtt_tooltipPositionLeft" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipPositionLeft'); ?>" step="1"/>px
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set distance of tooltip's bottom left corner from cursor pointer</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip font size</th>
                    <td><input type="number" style="width:50px" name="cmtt_tooltipFontSize" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipFontSize'); ?>" step="1"/>px
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set size of font inside tooltip</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip padding</th>
                    <td><input type="text" name="cmtt_tooltipPadding" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipPadding'); ?>"/>
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set internal padding: top, right, bottom, left</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip shadow</th>
                    <td>
                        <input type="hidden" name="cmtt_tooltipShadow" value="0" />
                        <input type="checkbox" name="cmtt_tooltipShadow" <?php checked(true, \CM\CMTT_Settings::get('cmtt_tooltipShadow', 1)); ?> value="1" />
                    </td>

                    <td colspan="2" class="cm_field_help_container">Select this option if you like to show the shadow for the tooltip</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip shadow color</th>
                    <td>
                        <input type="text" class="colorpicker" name="cmtt_tooltipShadowColor" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipShadowColor', '#666666'); ?>"/>
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set the color of the shadow of the tooltip</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip internal link color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipInternalLinkColor" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipInternalLinkColor'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set the color of the links inside the tooltip.</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip edit link color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipInternalEditLinkColor" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipInternalEditLinkColor'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set the color of the edit links in the tooltip. (Added only when the "Add term editlink to the tooltip content?" is enabled) </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip mobile link color</th>
                    <td><input type="text" class="colorpicker" name="cmtt_tooltipInternalMobileLinkColor" value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipInternalMobileLinkColor'); ?>" /></td>
                    <td colspan="2" class="cm_field_help_container">Set color of link to the term page in the tooltip. (Added only when the mobile support is enabled and on mobile device)</td>
                </tr>

            </table>
        </div>
        <div class="block">
            <h3 class="section-title">
                <span>Tooltip - Animation</span>
                <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
                    <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
                </svg>
            </h3>
            <table class="floated-form-table form-table">
                <!-- Tooltip Animation Time -->
                <tr valign="top">
                    <th scope="row">Tooltip animation appearance time</th>
                    <td>
                        <input type="text" style="width:50px" name="cmtt_tooltipDisplayDelay"
                               value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipDisplayDelay', '0.5'); ?>"/>s
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set the animation time for tooltip appearance</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tooltip animation disappearance time</th>
                    <td>
                        <input type="text" style="width:50px" name="cmtt_tooltipHideDelay"
                               value="<?php echo \CM\CMTT_Settings::get('cmtt_tooltipHideDelay', '0.5'); ?>"/>s
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set the animation time for tooltip disappearance
                    </td>
                </tr>
                <!-- Tooltip Display Animation -->
                <tr valign="top" style="clear: left;">
                    <th scope="row">Tooltip display animation</th>
                    <td>
                        <select name="cmtt_tooltipDisplayanimation">
                            <option value="no_animation" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipDisplayanimation', 'no_animation') == 'no_animation' ) ? 'selected' : ''; ?>>No animation</option>
                            <option value="fade_in" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipDisplayanimation', 'no_animation') == 'fade_in' ) ? 'selected' : ''; ?> >
                                Fade in
                            </option>
                            <option value="grow" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipDisplayanimation', 'no_animation') == 'grow' ) ? 'selected' : ''; ?> >
                                Grow
                            </option>
                            <option value="horizontal_flip" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipDisplayanimation', 'no_animation') == 'horizontal_flip' ) ? 'selected' : ''; ?> >
                                Horizontal Flip
                            </option>
                            <option value="center_flip" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipDisplayanimation', 'no_animation') == 'center_flip' ) ? 'selected' : ''; ?> >
                                Center Flip
                            </option>
                        </select>
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set an animation for when the tooltip appears</td>
                </tr>
                <!-- Tooltip hide animation -->
                <tr valign="top">
                    <th scope="row">Tooltip hide animation</th>
                    <td>
                        <select name="cmtt_tooltipHideanimation">
                            <option value="no_animation" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipHideanimation', 'no_animation') == 'no_animation' ) ? 'selected' : ''; ?>>No animation</option>
                            <option value="fade_out" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipHideanimation', 'no_animation') == 'fade_out' ) ? 'selected' : ''; ?> >
                                Fade out
                            </option>
                            <option value="shrink" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipHideanimation', 'no_animation') == 'shrink' ) ? 'selected' : ''; ?> >
                                Shrink
                            </option>
                            <option value="horizontal_flip" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipHideanimation', 'no_animation') == 'horizontal_flip' ) ? 'selected' : ''; ?> >
                                Horizontal Flip
                            </option>
                            <option value="center_flip" <?php echo ( \CM\CMTT_Settings::get('cmtt_tooltipHideanimation', 'no_animation') == 'center_flip' ) ? 'selected' : ''; ?> >
                                Center Flip
                            </option>
                        </select>
                    </td>

                    <td colspan="2" class="cm_field_help_container">Set an animation for when the tooltip disappears
                    </td>
                </tr>
            </table>
        </div>
        <?php
        $content = ob_get_clean();
        return $content;
    }

    /**
     * Include the files
     */
    public static function includeFiles() {
        include_once CMTT_PLUGIN_DIR . "synonyms.php";
        include_once CMTT_PLUGIN_DIR . "related.php";
        include_once CMTT_PLUGIN_DIR . "widgets.php";
        include_once CMTT_PLUGIN_DIR . "package/cminds-pro.php";
        include_once CMTT_PLUGIN_DIR . "customTemplates.php";
        include_once CMTT_PLUGIN_DIR . "schema.php";
    }

    /**
     * Initialize the files
     */
    public static function initFiles() {
        CMTT_RandomTerms_Widget::init();
        CMTT_Search_Widget::init();
        CMTT_LatestTerms_Widget::init();
        CMTT_RelatedTerms_Widget::init();
        CMTT_RelatedArticles_Widget::init();
        CMTT_Categories_Widget::init();
        CMTT_Wordofday_Widget::init();
        CMTT_Synonyms::init();
        CMTT_Related::init();
        CMTT_Custom_Templates::init();
        CMTT_Schema::init();
    }

    /**
     * Setup plugin constants
     */
    public static function setup_constants() {
        
    }

    public static function add_submenu_pages() {
        add_submenu_page(CMTT_MENU_OPTION, 'TooltipGlossary Import/Export', 'Import/Export', 'manage_glossary', 'cmtt_importexport', array(
            __CLASS__,
            'cmtt_importExport'
        ));
    }

    public static function cmtt_bp_parse($content, $activity) {
        global $post;
        $post->ID = $activity->id;

        $content = CMTT_Free::cmtt_glossary_parse($content, true);

        return $content;
    }

    /*
     * removing the "glossary" slug from term link
     *
     */

    public static function cmtt_remove_glossary_from_link($url, $element) {

        if (!empty($element->post_type) && ($element->post_type == 'glossary')) {
            // Now return the full URL
            $url = trim(\CM\CMTT_Settings::get('home'), '/') . "/{$element->post_name}";
            $url = user_trailingslashit($url);
        }

        return $url;
    }

    public static function cmtt_update_rule_for_term_links($query) {
        if (!$query->is_main_query() || 2 != count($query->query) || !isset($query->query['page']) || empty($query->query['name'])) {
            return;
        }

        $query->set('post_type', array('post', 'page', 'glossary'));
    }

    public static function maybeDisplayFootnotes($showTooltips, $glossary_item, $post) {
        $globalFootnotesEnabled = \CM\CMTT_Settings::get('cmtt_displayTermsAsFootnotes', 0);
        $footnotesEnabledForPost = CMTT_Free::_get_meta('_glossary_display_terms_as_footnotes', $post->ID);

        $showFootnotes = $globalFootnotesEnabled || $footnotesEnabledForPost;

        /*
         * If footnotes are enabled we disable tooltips
         */
        if ($showFootnotes) {
            $showTooltips = FALSE;
            add_filter('cmtt_link_replace', [__CLASS__, 'footnotesDisplaySymbol'], 100, 6);
        }
        return $showTooltips;
    }

    public static function footnotesDisplaySymbol($link_replace, $titleAttr, $glossary_item, $additionalClass, $titlePlaceholder, $title = '') {
        /*
         * Make sure this is one time - otherwise one footnote link can affect other links
         */
        remove_filter('cmtt_link_replace', [__CLASS__, 'footnotesDisplaySymbol'], 100, 6);
        $id = $glossary_item->ID;
        $footnoteNumberSpan = self::footnotesPart($title, $id);
        $link_replace .= $footnoteNumberSpan;
        return $link_replace;
    }

    public static function footnotesPart($title, $id) {
        global $footnotesIndexes, $footnotesSynonyms, $replacedTerms;
        /*
         * Add synonyms items to the global array so it can be used to generate footnotes definitions  list
         */
        if (!is_array($footnotesSynonyms)) {
            $footnotesSynonyms = [];
        }
        /*
         *  Check for duplicated synonyms
         */
        if (!empty($footnotesSynonyms[$id]['synonyms'])) {
            $isSynonymInArray = in_array($title, $footnotesSynonyms[$id]['synonyms']);
        } else {
            $isSynonymInArray = false;
        }

        if (!is_array($footnotesIndexes)) {
            $footnotesIndexes = [];
        }
        $synonym_fired = false;

        /*
         *  Add new synonym to array
         */
        if (strtolower($title) !== strtolower($replacedTerms[$title]['post']->post_title) && !$isSynonymInArray) {
            $footnotesSynonyms[$id]['synonyms'][] = $title;

            if (!empty($footnotesIndexes)) {
                $postid_is_in_array = false;
                foreach ($footnotesIndexes as $key => $value) {
                    if ($id === $value['postID']) {
                        $postid_is_in_array = true;
                    }
                }
            }
            if (empty($footnotesIndexes) || !$postid_is_in_array) {

                $post_title = get_the_title($id);
                $footnotesIndexes[$post_title]['footnote'] = (count($footnotesIndexes) + 1);
                $footnotesIndexes[$post_title]['postID'] = $id;
                $footnotesSynonyms[$id]['title'][] = $post_title;
                $synonym_fired = true;
            }
        }

        /*
         *  Create footnotes  terms numeration array
         *  Check for used footnotes
         */
        $postid_is_in_array = false;
        foreach ($footnotesIndexes as $key => $value) {
            if ($id === $value['postID']) {
                $postid_is_in_array = true;
            }
        }
        if (!array_key_exists($title, $footnotesIndexes) && strtolower($title) === strtolower($replacedTerms[$title]['post']->post_title) && !$postid_is_in_array) {
            $footnotesIndexes[$title]['footnote'] = (count($footnotesIndexes) + 1);
            $footnotesIndexes[$title]['postID'] = $id;
        }

        if ($synonym_fired) {
            $footnote_number = $footnotesIndexes[$footnotesSynonyms[$id]['title'][0]]['footnote'];
        } else {
            $footnote_number = $footnotesIndexes[$title]['footnote'];
        }

        if (\CM\CMTT_Settings::get('cmtt_footnoteAestheticsType', 'type1') === 'type1') {
            $footnoteNumber = '[' . $footnote_number . ']';
        } else {
            $footnoteNumber = '{' . $footnote_number . '}';
        }
        $footnoteLinkStyle = 'style="font-size: ' . \CM\CMTT_Settings::get('cmtt_footnoteSymbolSize', '14px') . '; color: ' . \CM\CMTT_Settings::get('cmtt_footnoteSymbolColor', '#ff9fbc') . '; font-style : ' . \CM\CMTT_Settings::get('cmtt_footnoteFormat', 'none') . ' ;"';
        $footnoteNumberSpan = '<span id="cmttFootnoteLink' . $footnote_number . '-0" class="cmtt-footnote"><sup><a class="et_smooth_scroll_disabled cmtt_footnote_link cmtt-footnote-deflink" href="#cmttFootnoteLink' . $footnote_number . '" ' . $footnoteLinkStyle . '>' . $footnoteNumber . '</a></sup></span>';
        return $footnoteNumberSpan;
    }

    public static function onFootnotesDefs($content) {
        global $post, $footnotesIndexes, $footnotesSynonyms;

        // Prepare footnotes definitions output
        $definitions = '';
        if (!empty($footnotesIndexes)) {
            $definitions .= '<div class="cmtt-footnotes-block">';
            $definitions .= '<div class="cmtt-footnote-header">' . \CM\CMTT_Settings::get('cmtt_footnoteDefTitle', 'Terms definitions') . '</div>';
            $definitions .= '<div class="cmtt-footnote-header-border"></div>';
            $backLinkStyle = 'style="font-size: ' . \CM\CMTT_Settings::get('cmtt_footnoteSymbolSize', '14px') . '; color: ' . \CM\CMTT_Settings::get('cmtt_footnoteSymbolColor', '#ff9fbc') . '; font-style : ' . \CM\CMTT_Settings::get('cmtt_footnoteFormat', 'none') . ' ;"';

            $max = \CM\CMTT_Settings::get('cmtt_footnoteDefMax', 5);
            $maxLabel = \CM\CMTT_Settings::get('cmtt_footnoteDefMaxButtonLabel');

            foreach ($footnotesIndexes as $term => $values) {
                $post_id = $values['postID'];
                if (!empty($footnotesSynonyms[$post_id])) {
                    $synonyms = ' ( ' . implode(',', $footnotesSynonyms[$post_id]['synonyms']) . ' ) ';
                } else {
                    $synonyms = '. ';
                }
                $showExcerpt = \CM\CMTT_Settings::get('cmtt_footnoteShowExcerpt', false);
                if ($showExcerpt) {
                    $definitionContent = get_the_excerpt($post_id);
                } else {
                    $definitionContent = get_the_content(null, false, $post_id);
                }
                $stripHTML = \CM\CMTT_Settings::get('cmtt_footnoteStripHTML', false);
                if ($stripHTML) {
                    $definitionContent = strip_tags($definitionContent);
                }
                /*
                 * Check if the links to term page shouldn't be removed
                 */
                $removeLinksToTerms = CMTT_Free::maybeRemoveLinkToGlossaryTerm($post);
                if (!$removeLinksToTerms) {
                    $termHtml = '<a aria-describedby="tt" href="' . get_the_permalink($post_id) . '" class="glossaryLink" target="_blank">' . $term . '</a>';
                } else {
                    $termHtml = $term;
                }

                $definitions .= (0 === $max) ? '<button class="cmtt-footnote-showmore-btn">' . $maxLabel . '</button>' : '';
                $hideClass = (--$max < 0) ? 'hidden' : '';

                $definitions .= '<div class="cmtt-footnote-def ' . $hideClass . '" id="cmttFootnoteLink' . $values['footnote'] . '">';
                $definitions .= '<span class="cmtt-footnote-def-number">' . $values['footnote'] . '. </span>';
                $definitions .= '<span class="cmtt-footnote-def-back"><a class="cmtt_footnote_link cmtt-footnote-backlink" href="#cmttFootnoteLink' . $values['footnote'] . '-0" ' . $backLinkStyle . '> &#8593; </a></span>';
                $definitions .= '<span class="cmtt-footnote-def-key"> ' . $termHtml . $synonyms . '</span>';
                $definitions .= '<span class="cmtt-footnote-def-content"> ' . apply_filters('cmtt_footnotes_definition_content', $definitionContent, $term, $values) . ' </span>';
                $definitions .= '</div>';
            }
            $definitions .= '</div>';
            $definitions .= '<div class="cmtt-footnote-bottom-border"></div>';
        }
        $content .= $definitions;
        return $content;
    }

    /**
     * Adds the disables metabox fields
     * @param array $metaboxFields
     * @return type
     */
    public static function addDisablesFields($post) {
        $termsAsFootnotes = CMTT_Free::_get_meta('_glossary_display_terms_as_footnotes', $post->ID);
        $displayTermsAsFootnotes = (int) (!empty($termsAsFootnotes) && $termsAsFootnotes == 1 );

        echo '<div class="cmtt_disable_for_page_field cmtt-metabox-field">';
        echo '<label for="glossary_display_terms_as_footnotes" class="blocklabel">';
        echo '<input type="checkbox" name="glossary_display_terms_as_footnotes" id="glossary_display_terms_as_footnotes" value="1" ' . checked(1, $displayTermsAsFootnotes, false) . '>';
        echo '&nbsp;&nbsp;&nbsp;Overwrite the "Display terms as a footnotes" setting on this page.</label>';
        echo '</div>';
    }

    /**
     * Saves additional post data
     * @param array $content
     * @return type
     */
    public static function saveDisableRelatedPosts($post_id, $post) {
        $postType = isset($post['post_type']) ? $post['post_type'] : '';
        $disableBoxPostTypes = apply_filters('cmtt_disable_metabox_posttypes', array('glossary', 'post', 'page'));
        if (in_array($postType, $disableBoxPostTypes)) {
            /*
             * Disables the parsing of the given page
             */
            $displayTermsAsFootnotes = 0;
            if (isset($post["glossary_display_terms_as_footnotes"]) && $post["glossary_display_terms_as_footnotes"] == 1) {
                $displayTermsAsFootnotes = 1;
            }
            update_post_meta($post_id, '_glossary_display_terms_as_footnotes', $displayTermsAsFootnotes);
        }
    }

    public static function cmtt_importExport() {
        $showCredentialsForm = self::_cmtt_backupGlossary();
        $showBackupDownloadLink = self::_cmtt_getBackupGlossary(false);

        ob_start();
        include 'views/backend/admin_importexport.php';
        $content = ob_get_contents();
        ob_end_clean();
        include 'views/backend/admin_template.php';
    }

    public static function cmtt_glossary_handleexport() {
        if (!empty($_POST['cmtt_doExport'])) {
            if (!wp_verify_nonce($_POST['cmtt_nonce'], 'cmtt_export')) {
                wp_die('Invalid request');
            }
            self::_cmtt_exportGlossary();
        } elseif (!empty($_POST['cmtt_doImport']) && !empty($_FILES['importCSV']) && is_uploaded_file($_FILES['importCSV']['tmp_name'])) {
            if (!wp_verify_nonce($_POST['cmtt_nonce'], 'cmtt_import')) {
                wp_die('Invalid request');
            }
            self::_cmtt_importGlossary($_FILES['importCSV']);
        } elseif (!empty($_POST['cmtt_doExportSettings'])) {
            if (!wp_verify_nonce($_POST['cmtt_nonce'], 'cmtt_export_settings')) {
                wp_die('Invalid request');
            }
            self::_cmtt_exportGlossarySettings();
        } elseif (!empty($_POST['cmtt_doImportSettings']) && !empty($_FILES['importCSV']) && is_uploaded_file($_FILES['importCSV']['tmp_name'])) {

            if (!wp_verify_nonce($_POST['cmtt_nonce'], 'cmtt_import_settings')) {
                wp_die('Invalid request');
            }
            self::_cmtt_importGlossarySettings($_FILES['importCSV']);
        }
    }

    /**
     * Function adds the editlink
     * @return string
     */
    public static function addEditlinkToTooltip($glossaryItemContent, $glossary_item) {
        $showTitle = \CM\CMTT_Settings::get('cmtt_glossaryAddTermEditlink');

        if ($showTitle == 1 && current_user_can('manage_glossary')) {
            $link = '<a href="' . get_edit_post_link($glossary_item) . '">Edit term</a>';
            $glossaryItemEditlink = '<div class=glossaryItemEditlink>' . $link . '</div>';
            /*
             * Add the editlink
             */
            $glossaryItemContent = $glossaryItemEditlink . $glossaryItemContent;
        }

        return $glossaryItemContent;
    }

    /**
     * Function adds the page term link at the bottom of the tooltip
     * @return string
     */
    public static function addTermPageLinkToTooltip($glossaryItemContent, $glossary_item) {
        $tooltipOnClick = \CM\CMTT_Settings::get('cmtt_glossaryShowTooltipOnClick', '0');
        $addLink = \CM\CMTT_Settings::get('cmtt_glossaryAddTermPagelink');
        $createGlossaryTermPages = (bool) \CM\CMTT_Settings::get('cmtt_createGlossaryTermPages', true);

        if ($createGlossaryTermPages && ( $addLink == 1 || $tooltipOnClick == 1 )) {
            $target = \CM\CMTT_Settings::get('cmtt_glossaryTermPageLinkTargetBlank', false) ? ' target=_blank' : '';
            $text = __(\CM\CMTT_Settings::get('cmtt_glossaryTermDetailsLink'), 'cm-tooltip-glossary');
            $permalink = apply_filters('cmtt_term_tooltip_permalink', get_permalink($glossary_item->ID), $glossary_item->ID);
            $link = '<a class=glossaryTooltipMoreLink href=' . $permalink . ' ' . $target . '>' . $text . '</a>';
            $glossaryPageLink = '<div class=glossaryTooltipMoreLinkWrapper>' . $link . '</div>';
            /*
             * Add the link
             */
            $glossaryItemContent = $glossaryItemContent . $glossaryPageLink;
        }

        return $glossaryItemContent;
    }

    /**
     * Add the social share buttons
     *
     * @param string $content
     *
     * @return string
     */
    public static function cmtt_glossaryAddShareBox($content = '') {
        if (!defined('DOING_AJAX')) {
            ob_start();
            require CMTT_PLUGIN_DIR . 'views/frontend/social_share.phtml';
            $preContent = ob_get_clean();

            $content = $preContent . $content;
        }

        return $content;
    }

    public static function get_backup_filename() {
        $filename = 'glossary_backup_' . date('Ymd_His', current_time('timestamp')) . '.csv';
        return $filename;
    }

    /**
     * Outputs the backup file
     */
    public static function cmtt_glossary_get_backup() {
        $pinOption = \CM\CMTT_Settings::get('cmtt_glossary_backup_pinprotect', false);

        if (!empty($pinOption)) {
            $passedPin = filter_input(INPUT_GET, 'pin');
            if ($passedPin != $pinOption) {
                echo 'Incorrect PIN!';
                die();
            }
        }

        $backupGlossary = self::_cmtt_getBackupGlossary(false);

        if ($backupGlossary) {
            $upload_dir = wp_upload_dir();
            $filepath = trailingslashit($upload_dir['basedir']) . 'cmtt/' . self::get_backup_filename();

            $outstream = fopen($filepath, 'r');
            rewind($outstream);

            header('Content-Encoding: UTF-8');
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename=' . self::get_backup_filename());
            /*
             * Why including the BOM? - Marcin
             */
            echo "\xEF\xBB\xBF"; // UTF-8 BOM
            while (!feof($outstream)) {
                echo fgets($outstream);
            }
            fclose($outstream);
        }
        die();
    }

    /**
     * Outputs the backup glossary AJAX link
     */
    public static function _cmtt_getBackupGlossary($protect = true) {
        $upload_dir = wp_upload_dir();
        $filepath = trailingslashit($upload_dir['basedir']) . 'cmtt/' . self::get_backup_filename();

        if (file_exists($filepath)) {
            $url = admin_url('admin-ajax.php?action=cmtt_get_glossary_backup');

            if (!$protect) {
                $pinOption = \CM\CMTT_Settings::get('cmtt_glossary_backup_pinprotect');
                $url .= $pinOption ? '&pin=' . $pinOption : '';
            }

            return $url;
        }

        return false;
    }

    /**
     * Backups the glossary
     */
    public static function _cmtt_backupGlossary() {
        if (empty($_POST)) {
            return false;
        }

        if (isset($_POST['cmtt_doBackup'])) {
            check_admin_referer('cmtt_do_backup');
            $url = wp_nonce_url('admin.php?page=cmtt_importexport');
            self::_cmtt_doBackup($url);
        }

        return false;
    }

    /**
     * Reschedule the backup event
     * @return type
     */
    public static function _cmtt_rescheduleBackup() {
        $possibleIntervals = array_keys(wp_get_schedules());

        $newScheduleHour = filter_input(INPUT_POST, 'cmtt_glossary_backupCronHour');
        $newScheduleInterval = filter_input(INPUT_POST, 'cmtt_glossary_backupCronInterval');

        if ($newScheduleHour !== null && $newScheduleInterval !== null) {
            wp_clear_scheduled_hook('cmtt_glossary_backup_event');

            if ($newScheduleInterval == 'none') {
                return;
            }

            if (!in_array($newScheduleInterval, $possibleIntervals)) {
                $newScheduleInterval = 'daily';
            }

            $time = strtotime($newScheduleHour);
            if ($time === false) {
                $time = current_time('timestamp');
            }

            wp_schedule_event($time, $newScheduleInterval, 'cmtt_glossary_backup_event');
        }
    }

    public static function _cmtt_doBackup($url = null) {
        $form_fields = array('cmtt_doBackup'); // this is a list of the form field contents I want passed along between page views
        $method = ''; // Normally you leave this an empty string and it figures it out by itself, but you can override the filesystem method here
        // check to see if we are trying to save a file

        $secureWrite = \CM\CMTT_Settings::get('cmtt_glossary_backup_secure', true);

        if ($secureWrite) {
            if (empty($url)) {
                $url = wp_nonce_url('admin.php?page=cmtt_importexport');
            }

            /** WordPress Administration File API */
            require_once( ABSPATH . 'wp-admin/includes/file.php' );

            // okay, let's see about getting credentials
            if (false === ( $creds = request_filesystem_credentials($url, $method, false, false, $form_fields) )) {
                // if we get here, then we don't have credentials yet,
                // but have just produced a form for the user to fill in,
                // so stop processing for now
                return true; // stop the normal page form from displaying
            }

            // now we have some credentials, try to get the wp_filesystem running
            if (!WP_Filesystem($creds)) {
                // our credentials were no good, ask the user for them again
                request_filesystem_credentials($url, $method, true, false, $form_fields);

                return true;
            }
        }

        // get the upload directory
        $upload_dir = wp_upload_dir();
        $filename = trailingslashit($upload_dir['basedir']) . 'cmtt/';

        if (!file_exists($filename)) {
            wp_mkdir_p($filename);
        }

        chmod($filename, 0775);
        $filename .= self::get_backup_filename();

        $string = '';
        $outstream = fopen("php://temp", 'r+');
        $exportData = self::_cmtt_prepareExportGlossary();

        $header_length = count($exportData['data'][0]);
        $cmtt_meta_start = 9;

        if ($header_length < $cmtt_meta_start) {

            for ($i = 0; $i <= $cmtt_meta_start - $header_length; $i++) {
                $exportData['data'][0][$header_length + $i] = '';
            }
            $exportData['data'][0] = array_merge(
                    $exportData['data'][0],
                    array_slice($exportData['header_map'], count($exportData['data'][0]))
            );
        }

        $header_map = $exportData['data'][0];

        $first = true;
        foreach ($exportData['data'] as $line_array) {
            if ($first) {
                $line = $line_array;
                $first = false;
            } else {

                foreach ($header_map as $key => $value) {
                    if ($key > $cmtt_meta_start) {
                        $key = $value;
                    }

                    if (!isset($line_array[$key])) {
                        $line[$key] = '';
                    } else {
                        $line[$key] = $line_array[$key];
                    }
                }
            }

            fputcsv($outstream, $line, ',', '"');
            unset($line);
        }
        rewind($outstream);
        while (!feof($outstream)) {
            $string .= fgets($outstream);
        }
        fclose($outstream);

        if ($secureWrite) {
            /*
             * by this point, the $wp_filesystem global should be working, so let's use it to create a file
             */
            global $wp_filesystem;
            if (!$wp_filesystem->put_contents($filename, $string, FS_CHMOD_FILE)) {
                echo "error saving file!";
            }
        } else {
            file_put_contents($filename, $string, LOCK_EX);
            chmod($filename, 0775);
        }
    }

    /**
     * Exports the glossary
     */
    public static function _cmtt_exportGlossary() {
        $exportData = self::_cmtt_prepareExportGlossary();

        $outstream = fopen("php://temp", 'r+');
        $header_length = count($exportData['data'][0]);
        $cmtt_meta_start = 10;

        if ($header_length < $cmtt_meta_start) {

            for ($i = 0; $i <= $cmtt_meta_start - $header_length; $i++) {
                $exportData['data'][0][$header_length + $i] = '';
            }
            $exportData['data'][0] = array_merge(
                    $exportData['data'][0],
                    array_slice($exportData['header_map'], count($exportData['data'][0]))
            );
        }

        $header_map = $exportData['data'][0];

        $first = true;
        foreach ($exportData['data'] as $line_array) {
            if ($first) {
                $line = $line_array;
                $first = false;
            } else {

                foreach ($header_map as $key => $value) {
                    if ($key > $cmtt_meta_start) {
                        $key = $value;
                    }

                    if (!isset($line_array[$key])) {
                        $line[$key] = '';
                    } else {
                        $line[$key] = $line_array[$key];
                    }
                }
            }

            fputcsv($outstream, $line, ',', '"');
            unset($line);
        }
        rewind($outstream);

        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=glossary_export_' . date('Ymd_His', current_time('timestamp')) . '.csv');
        /*
         * Why including the BOM? - Marcin
         */
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        while (!feof($outstream)) {
            echo fgets($outstream);
        }
        fclose($outstream);
        exit;
    }

    public static function _cmtt_prepareExportGlossary() {
        $args = array(
            'post_type'              => 'glossary',
            'post_status'            => 'publish',
            'nopaging'               => true,
            'orderby'                => 'ID',
            'order'                  => 'ASC',
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        );

        $q = new WP_Query($args);
        $exportData = array();
        $exportHeaderRow = array(
            'Id',
            'Title',
            'Excerpt',
            'Description',
            'Synonyms',
            'Variations',
            'Categories',
            'Abbreviation',
            'Tags',
            'Image',
            'Languages'
        );
        $exportHeaderRow = apply_filters('cmtt_export_header_row', $exportHeaderRow);
        $postsArray = $q->get_posts();
        foreach ($postsArray as $term) {
            $meta = get_post_meta($term->ID);
            foreach (array_keys($meta) as $item) {
                if ($item === 'cmtt_synonyms') {
                    continue;
                }
                if ($item === CMTT_Related::TRANSIENT_NAME) {
                    continue;
                }
                if ($item === 'cmtt_variations') {
                    continue;
                } else {
                    if ((strpos($item, 'cmtt')) !== false || (strpos($item, '_glossary_related_article')) !== false) {
                        $exportHeaderRow[] = $item;
                    }
                }
            }
            break;
        }
        wp_reset_postdata();

        $exportData[] = array_unique($exportHeaderRow);
        $header_map = array();

        /*
         * Get all the glossary items
         */
        foreach ($q->get_posts() as $term) {
            /*
             * All the meta information
             */
            $meta2 = get_post_meta($term->ID, '', true);

            foreach ($meta2 as $key => $value) {

                if ($key === 'cmtt_synonyms' && $value == $value) {
                    //delete this particular object from the $array
                    unset($meta2[$key]);
                    continue;
                }
                if ($key === 'cmtt_variations' && $value == $value) {
                    //delete this particular object from the $array
                    unset($meta2[$key]);
                    continue;
                }
                if ($key === 'cmtt_abbreviations' && $value == $value) {
                    //delete this particular object from the $array
                    unset($meta2[$key]);
                    continue;
                } else {
                    if ($key === '_glossary_related_article') {
                        if (is_array($value)) {
                            $v = unserialize($value[0]);
                            if (is_array($v)) {
                                foreach ($v as $v_item) {
                                    $meta2[$key . '_' . $v_item['name']] = $v_item['url'];
                                    array_push($exportData[0], $key . '_' . $v_item['name']);
                                }
                            }
                        }
                        unset($meta2[$key]);
                    } else if (false !== (strpos($key, 'cmtt'))) {
                        $meta2[$key] = is_array($value) ? $value[0] : $value;
                    } else {
                        unset($meta2[$key]);
                    }
                }
            }
            $metaValues = $meta2;

            $image_url = get_the_post_thumbnail_url($term->ID, 'full');
            if (!empty($image_url))
                $exportDataRow[] = $image_url;

            $exportDataRow = array(
                $term->ID,
                $term->post_title,
                /*
                 * Change related to ticket #53075
                 */
//                str_replace( array( "\r\n", "\n", "\r" ), array( "", "", "" ), nl2br( $term->post_excerpt ) ),
//                str_replace( array( "\r\n", "\n", "\r" ), array( "", "", "" ), nl2br( $term->post_content ) ),
                $term->post_excerpt,
                $term->post_content,
                CMTT_Synonyms::getSynonyms($term->ID, true),
                CMTT_Synonyms::getSynonyms($term->ID, false),
                '',
                '',
                '',
                $image_url,
                ''
            );

            $exportDataRowWithMeta = apply_filters('cmtt_export_data_row', $exportDataRow, $term);
            $exportDataRowWithMeta = array_merge($exportDataRowWithMeta, $metaValues);

            $header_map = array_unique(array_merge($header_map, array_keys($exportDataRowWithMeta)));
            $exportData[] = array_merge($exportDataRowWithMeta, $metaValues);
        }

        return array(
            'header_map' => $header_map,
            'data'       => $exportData
        );
    }

    public static function _cmtt_importGlossary($file) {
        $filesrc = $file['tmp_name'];
        $fp = fopen($filesrc, 'r');
        $tab = array();
        while (!feof($fp)) {
            $item = fgetcsv($fp, 0, ',', '"');
            $tab[] = $item;
        }
        fclose($fp);
        $error = '';
        $allElements = 0;
        $importedElements = 0;

        remove_action('save_post', array('CMTT_Related', 'triggerOnSave'));
        remove_action('save_post', array('CMTTW_Related', 'triggerOnSave'));

        $header_map = array();
        $cmtt_meta_start = 10;

        foreach ($tab[0] as $key => $header_item) {
            if ($key < $cmtt_meta_start) {
                $header_map[$key] = $key;
            } else {
                $header_map[$key] = $header_item;
            }
        }

        $total = count($tab);
        for ($i = 1; $i < $total; $i++) {
            if (is_array($tab[$i])) {
                $allElements++;
                $result = self::importGlossaryItem($tab[$i], $header_map);
                if ($result > 0) {
                    $importedElements++;
                } else {
                    $error = abs($result);
                }
                unset($tab[$i]);
            }
        }

        $queryArgs = array(
            'msg'           => 'imported',
            'itemstotal'    => $allElements,
            'itemsimported' => $importedElements,
            'error'         => $error
        );
        wp_safe_redirect(add_query_arg($queryArgs, $_SERVER['REQUEST_URI']), 303);
        exit;
    }

    /**
     * Imports the single glossary item
     *
     * @param type $item
     * @param type $override
     *
     * @return boolean
     * @global type $wpdb
     */
    public static function importGlossaryItem($item, $header_map, $override = true) {
        if (!empty($item) && is_array($item)) {
            /*
             * Too few columns
             */
            if (count($item) < 4) {
                return - 5;
            }
            /*
             * If first column is not empty it have to be a number
             */
            if (!empty($item[0]) && intval($item[0]) == 0) {
                return - 6;
            }
            /*
             * Empty title
             */
            if (empty($item[1])) {
                return - 1;
            }
            /*
             * Empty description
             */
            if (empty($item[3])) {
                return - 3;
            }

            global $wpdb;
            $data = array(
                'post_title'   => $item[1],
                'post_type'    => 'glossary',
                'post_excerpt' => $item[2],
                'post_content' => $item[3],
                'post_status'  => 'publish'
            );

            if (!\CM\CMTT_Settings::get('cmtt_importSameTitle', 0)) {
                $sql = $wpdb->prepare("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type=%s AND post_title=%s AND post_status='publish'", 'glossary', $item[1]);
                $existingPosts = $wpdb->get_results($sql);
            }

            $existingId = 0;
            if (!empty($existingPosts) && is_array($existingPosts)) {
                foreach ($existingPosts as $glossaryPost) {
                    if ($glossaryPost->post_title == $item[1]) {
                        $existingId = $glossaryPost->ID;
                        break;
                    }
                }
            }
            if (!empty($existingId)) {
                //update
                $data['ID'] = $existingId;

                // cmtt processing
                $sql = $wpdb->prepare("SELECT meta_key FROM {$wpdb->postmeta} WHERE post_id=%s AND meta_key LIKE '%cmtt%'", $existingId);
                $post_meta_keys_ = $wpdb->get_results($sql, ARRAY_N);
                $post_meta_keys = array();
                $new_custom_related_articles = array();
                $_glossary_related_article = get_post_meta($existingId, '_glossary_related_article', TRUE);

                foreach ($post_meta_keys_ as $value) {
                    $post_meta_keys[] = $value[0];
                }
                unset($post_meta_keys_);

                $cmtt_data = array();
                $cmtt_data_insert = array();
                foreach ($header_map as $key => $value) {
                    if (strpos($value, 'cmtt') !== false) {

                        if (trim($item[$key]) == "" || is_array($item[$key])) {
                            continue;
                        } else {
                            // if field exists
                            if (in_array($value, $post_meta_keys)) {
                                $cmtt_data[$value] = $item[$key];
                            } else {
                                $cmtt_data_insert[$value] = $item[$key];
                            }
                        }
                    }
                    // If it's a custom related post field and it's not empty
                    if (strpos($value, '_glossary_related_article') !== false && !empty($item[$key])) {
                        if (is_array($_glossary_related_article) && count($_glossary_related_article) > 0) {
                            foreach ($_glossary_related_article as &$glossary_related_article_item) {
                                if (isset($glossary_related_article_item['name']) && $value == '_glossary_related_article_' . $glossary_related_article_item['name']) {
                                    $glossary_related_article_item['url'] = $item[$key];
                                }
                            }
                        } else {
                            $article_name = str_replace('_glossary_related_article_', '', $value);
                            $new_custom_related_articles[] = array("name" => $article_name, "url" => $item[$key]);
                        }
                    }
                }

                if ($override) {
                    // Insert cmtt data
                    if (!empty($cmtt_data_insert)) {
                        foreach ($cmtt_data_insert as $meta_key => $meta_value) {
                            $wpdb->insert($wpdb->postmeta,
                                    array('meta_value' => $meta_value, 'post_id' => $existingId, 'meta_key' => $meta_key)
                            );
                        }
                    }
                    // Update cmtt data
                    if (!empty($cmtt_data)) {
                        try {
                            foreach ($cmtt_data as $meta_key => $meta_value) {
                                update_post_meta($existingId, $meta_key, $meta_value);
                            }
                        } catch (Exception $e) {
                            error_log("\n " . 'Exception:  ' . print_r($e->getMessage(), true), 3, 'error.log');
                        }
                    }

                    // Update cmtt _glossary_related_article
                    if (is_array($_glossary_related_article) && (!empty($_glossary_related_article) || !empty($new_custom_related_articles))) {
                        $_glossary_related_article = array_merge($_glossary_related_article, $new_custom_related_articles);
                        try {
                            update_post_meta($existingId, '_glossary_related_article', serialize($_glossary_related_article));
                        } catch (Exception $e) {
                            error_log("\n " . 'Exception:  ' . print_r($e->getMessage(), true), 3, 'error.log');
                        }
                    }

                    $update = wp_update_post($data);
                } else {
                    $update = false;
                }
            } else {
                // Insert new glossary item
                $update = wp_insert_post($data, true);

                if ($update > 0) {
                    foreach ($header_map as $key => $value) {
                        if (strpos($value, 'cmtt') !== false) {
                            $cmtt_data_insert[$value] = $item[$key];
                        }
                        if (strpos($value, '_glossary_related_article') !== false && !empty($item[$key])) {
                            $custom_related_article = array();
                            $custom_related_article['name'] = str_replace('_glossary_related_article_', '', $value);
                            $custom_related_article['url'] = $item[$key];
                            $custom_related_articles[] = $custom_related_article;
                        }
                    }
                    if (!empty($custom_related_articles)) {
                        $cmtt_data_insert['_glossary_related_article'] = serialize($custom_related_articles);
                    }

                    if (!empty($cmtt_data_insert)) {
                        foreach ($cmtt_data_insert as $meta_key => $meta_value) {
                            try {
                                $wpdb->insert($wpdb->postmeta,
                                        array('meta_value' => $meta_value, 'post_id' => $update, 'meta_key' => $meta_key)
                                );
                            } catch (Exception $e) {
                                error_log("\n " . 'Exception:  ' . print_r($e->getMessage(), true), 3, 'error.log');
                            }
                        }
                    }
                }
            }

            if ($update > 0 && isset($item[4]) && isset($item[5])) {
                CMTT_Synonyms::setSynonyms($update, $item[4], true);
                CMTT_Synonyms::setSynonyms($update, $item[5], false);
            }

            /*
             * Image
             */
            $image_column = 9;
            if ($update > 0 && !empty($item[$image_column])) {
                self::uploadImage($item[$image_column], $update, '');
            }

            do_action('cmtt_import_glossary_item', $item, $update);

            /*
             * Return with no error
             */
            /*
             * Release memory
             */
            $item = null;
            return $update;
        }

        return - 4;
    }

    /**
     * Exports the glossary settings
     */
    public static function _cmtt_exportGlossarySettings() {
        $exportData = self::_cmtt_prepareExportGlossarySettings();

        $outstream = fopen("php://temp", 'r+');

        foreach ($exportData as $line) {
            fputcsv($outstream, $line, ',', '"');
        }
        rewind($outstream);

        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=glossary_export_settings_' . date('Ymd_His', current_time('timestamp')) . '.csv');
        /*
         * Why including the BOM? - Marcin
         */
        echo "\xEF\xBB\xBF"; // UTF-8 BOM
        while (!feof($outstream)) {
            echo fgets($outstream);
        }
        fclose($outstream);
        exit;
    }

    public static function _cmtt_prepareExportGlossarySettings() {
        $optionNames = wp_load_alloptions();
        $export_data[] = array('Title', 'Value');

        function cmtt_get_the_option_names($k) {
            return strpos($k, 'cmtt') === 0;
        }

        $options = array_filter($optionNames, 'cmtt_get_the_option_names', ARRAY_FILTER_USE_KEY);

        foreach ($options as $k => $v) {
            $export_data[] = array($k, $v);
        }

        return $export_data;
    }

    public static function _cmtt_importGlossarySettings($file) {
        $filesrc = $file['tmp_name'];

        $fp = fopen($filesrc, 'r');
        $tab = array();
        while (!feof($fp)) {
            $item = fgetcsv($fp, 0, ',', '"');
            $tab[] = $item;
        }
        $error = '';
        $allElements = 0;
        $importedElements = 0;

        for ($i = 1; $i < count($tab); ++$i) {
            if (is_array($tab[$i])) {
                $allElements++;
                $result = self::importGlossaryOption($tab[$i]);
                if ($result > 0) {
                    $importedElements++;
                } else {
                    $error = abs($result);
                }
            }
        }
        $glossaryPostID = \CM\CMTT_Settings::get("cmtt_glossaryID");

        if ($glossaryPostID > 0) {
            /*
             * Update glossary post permalink
             */
            $glossaryPost = array(
                'ID'        => $glossaryPostID,
                'post_name' => \CM\CMTT_Settings::get("cmtt_glossaryPermalink")
            );
            wp_update_post($glossaryPost);
            \CM\CMTT_Settings::_flush_rewrite_rules();
        }

        $queryArgs = array(
            'settingsMsg'      => 'imported',
            'settingstotal'    => $allElements,
            'settingsImported' => $importedElements,
            'settings_error'   => $error
        );
        wp_safe_redirect(add_query_arg($queryArgs, $_SERVER['REQUEST_URI']), 303);
        exit;
    }

    /**
     * Imports the single glossary option
     *
     * @param array $option
     *
     * @return boolean
     */
    public static function importGlossaryOption($option) {
        if (!empty($option) && is_array($option) && count($option) == 2) {
            return \CM\CMTT_Settings::set($option[0], maybe_unserialize($option[1]));
        }
        return - 1;
    }

    public static function uploadImage($url, $parent_post, $img_title) {
        $image_data = file_get_contents($url);
        $upload_dir = wp_upload_dir();
        $filename = basename($url);
        if (wp_mkdir_p($upload_dir['path'])) {
            $file = trailingslashit($upload_dir['path']) . $filename;
        } else {
            $file = trailingslashit($upload_dir['basedir']) . $filename;
        }
        file_put_contents($file, $image_data);
        $guid = trailingslashit($upload_dir['path']) . $filename;

        // Check image file type
        $wp_filetype = wp_check_filetype($filename, null);
        $atache_path = ltrim(trailingslashit($upload_dir['subdir']) . $filename, DIRECTORY_SEPARATOR);
        $attachment = array(
            'guid'           => trailingslashit($upload_dir['url']) . $filename,
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => $filename,
            'post_content'   => '',
            'post_status'    => 'inherit',
        );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        // Generate the metadata for the attachment, and update the database record.
        $attach_id = wp_insert_attachment($attachment, $atache_path, $parent_post);
        $attach_data = wp_generate_attachment_metadata($attach_id, $guid);
        wp_update_attachment_metadata($attach_id, $attach_data);
        set_post_thumbnail($parent_post, $attach_id);

        return $attach_id;
    }

    public static function flushCaps($post, $messages) {
        $oldRoles = \CM\CMTT_Settings::get('cmtt_glossaryRoles', array('administrator', 'editor'));
        $newRoles = $post['cmtt_glossaryRoles'];
        if ($oldRoles != $newRoles) {
            CMTT_Free::_add_caps($newRoles);
            self::$messages = __('New Role assignment has been saved!', 'cm-tooltip-glossary');
        }
    }

    /**
     * Add Synonyms to Glossary Index
     * @param string $glossariIndexContentArr
     * @param mixed $glossaryItem
     * @param string $preItemTitleContent
     * @param string $postItemTitleContent
     * @return string
     */
    public static function addSynonymsToGlossaryIndex($glossariIndexContentArr, $glossaryItem, $preItemTitleContent, $postItemTitleContent, $shortcodeAtts) {
        $addSynonymsToTheGlossaryIndex = \CM\CMTT_Settings::get('cmtt_glossarySynonymsInIndex', 1);
        $hideSynonyms = !empty($shortcodeAtts['hide_synonyms']);

        if ($hideSynonyms || !$addSynonymsToTheGlossaryIndex) {
            return $glossariIndexContentArr;
        }
        /*
         * Add synonyms to the list
         * @since 2.6.8
         */
        $synonyms = CMTT_Synonyms::getSynonymsArr($glossaryItem->ID);
        if (!empty($synonyms) && is_array($synonyms)) {
            foreach ($synonyms as $synonym) {
                $glossariIndexContentArr[mb_strtolower($synonym)] = $preItemTitleContent . $synonym . $postItemTitleContent;
            }
        }
        return $glossariIndexContentArr;
    }

    /**
     * If synonyms are added to the Glossary Index - count them
     * @param int $counts
     * @param mixed $term
     * @param array $shortcodeAtts
     * @return int
     */
    public static function addSynonymsCount($counts, $term, $shortcodeAtts) {
        $addSynonymsToTheGlossaryIndex = \CM\CMTT_Settings::get('cmtt_glossarySynonymsInIndex', 1);
        $hideSynonyms = !empty($shortcodeAtts['hide_synonyms']);

        if ($addSynonymsToTheGlossaryIndex && !$hideSynonyms) {
            $synonyms = CMTT_Synonyms::getSynonymsArr($term->ID);
            if (!empty($synonyms) && is_array($synonyms)) {
                $nonLatinLetters = (bool) \CM\CMTT_Settings::get('cmtt_index_nonLatinLetters');
                foreach ($synonyms as $synonym) {

                    $firstLetterOriginal = mb_substr($synonym, 0, 1);

                    if (!$nonLatinLetters) {
                        $firstLetterOriginal = remove_accents($firstLetterOriginal);
                    }
                    $firstLetter = mb_strtolower($firstLetterOriginal);

                    if (preg_match('/\d/', $firstLetter)) {
                        $firstLetter = 'al-num';
                    }

                    if (!isset($counts[$firstLetter])) {
                        $counts[$firstLetter] = 0;
                    }
                    $counts[$firstLetter]++;
                    $counts['all']++;
                }
            }
        }
        return $counts;
    }

    public static function parseSynonymsAndVariations($addition, $glossary_item) {
        $additions = $glossary_item->additions;
        if (!empty($additions) && is_array($additions)) {
            $addition = '|' . implode('|', $additions);
        }
        return $addition;
    }

    public static function addSynonymsAndVariations($additions, $glossary_item) {
        if (!is_array($additions)) {
            $additions = [];
        }
        $synonymsArr = CMTT_Synonyms::getSynonymsArr($glossary_item->ID, true);
        $variationsArr = CMTT_Synonyms::getSynonymsArr($glossary_item->ID, false);
        $synonyms = array_merge($synonymsArr, $variationsArr);
        $synonymsNormalized = array();

        if (!empty($synonyms) && count($synonyms) > 0) {
            foreach ($synonyms as $val) {
                $val = CMTT_Free::normalizeTitle($val);
                if (!empty($val)) {
                    $synonymsNormalized[] = $val;
                }
            }
            if (!empty($synonymsNormalized)) {
                $additions = array_merge($additions, $synonymsNormalized);
            }
        }
        return $additions;
    }

    /**
     * Add tooltip script data
     * @param array $tooltipData
     * @return type
     */
    public static function addTooltipScriptData($tooltipData) {
        $tooltipData['mobile_support'] = (bool) \CM\CMTT_Settings::get('cmtt_glossaryMobileSupport');
        return $tooltipData;
    }

}
