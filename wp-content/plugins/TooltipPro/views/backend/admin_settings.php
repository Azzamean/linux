<?php if (!empty($messages)): ?>
    <div class="updated" style="clear:both"><p><?php echo $messages; ?></p></div>
<?php endif; ?>

<?php echo do_shortcode('[cminds_pro_ads id="cmtt"]'); ?>

<div id="cminds_settings_container">
    <div class="cminds_settings_description">
        <p>
            <?php
            global $cmindsPluginPackage;
            $shortcodesPage = $cmindsPluginPackage['cmtt']->licensingApi->getPageSlug('shortcodes');
            ?>
            <strong>Supported Shortcodes:</strong> <a href="<?php echo get_admin_url('', 'admin.php?page=' . esc_attr($shortcodesPage)); ?>">See the list</a>
        </p>

        <p>
            <?php
            $glossaryId = CMTT_Glossary_Index::getGlossaryIndexPageId();
            if ($glossaryId > 0 && get_post($glossaryId)) :

                $glossaryIndexPageEditLink = admin_url('post.php?post=' . $glossaryId . '&action=edit');
                $glossaryIndexPageLink = get_page_link($glossaryId);
                ?>
                <strong>Link to the Glossary Index Page:</strong> <a href="<?php echo $glossaryIndexPageLink; ?>" target="_blank"><?php echo $glossaryIndexPageLink; ?></a> (<a title="Edit the Glossary Index Page" href="<?php echo $glossaryIndexPageEditLink; ?>">edit</a>)
                <?php
            endif;
            ?>
        </p>
        <p>
            <strong>Example of Glossary Term link:</strong> <?php echo trailingslashit(home_url(get_option('cmtt_glossaryPermalink'))) . 'sample-term' ?>
        </p>
        <form method="post">
            <div>
                <div class="cmtt_field_help_container">Warning! This option will completely erase all of the data stored by the CM Tooltip Glossary in the database: terms, options, synonyms etc. <br/> It will also remove the Glossary Index Page. <br/> It cannot be reverted.</div>
                <input onclick="return confirm('All options of CM Tooltip Glossary will be erased. This cannot be reverted.')" type="submit" name="cmtt_removeAllOptions" value="Remove all options" class="button cmtt-cleanup-button"/>
                <input onclick="return confirm('All terms of CM Tooltip Glossary will be erased. This cannot be reverted.')" type="submit" name="cmtt_removeAllItems" value="Remove all items" class="button cmtt-cleanup-button"/>
                <span style="display: inline-block;position: relative;"></span>
            </div>
        </form>

        <?php
        // check permalink settings
        if (get_option('permalink_structure') == '') {
            echo '<span style="color:red">Your WordPress Permalinks needs to be set to allow plugin to work correctly. Please Go to <a href="' . admin_url() . 'options-permalink.php" target="new">Settings->Permalinks</a> to set Permalinks to Post Name.</span><br><br>';
        }
        ?>

    </div>

    <br/>
    <div class="clear"></div>

    <form method="post">
        <?php wp_nonce_field('update-options'); ?>
        <input type="hidden" name="action" value="update" />


        <div id="cmtt_tabs" class="glossarySettingsTabs">
            <div class="glossary_loading"></div>

            <?php
            CMTT_Pro::renderSettingsTabsControls();

            CMTT_Pro::renderSettingsTabs();
            ?>

            <div id="tabs-1">
                <div class="block">
                    <h3>General Settings</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top" class="whole-line">
                            <th scope="row">Glossary Index Page ID</th>
                            <td>
                                <?php wp_dropdown_pages(array('name' => 'cmtt_glossaryID', 'selected' => (int) get_option('cmtt_glossaryID', -1), 'show_option_none' => '-None-', 'option_none_value' => '0')) ?>
                                <br/><input type="checkbox" name="cmtt_glossaryID" value="-1" /> Generate page for Glossary Index
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the page ID of the page you would like to use as the Glossary Index Page. If you select "-None-" terms will still be highlighted in relevant posts/pages but there won't be a central list of terms (Glossary Index Page). If you check the checkbox a new page would be generated automatically. WARNING! You have to manually remove old pages!</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Roles allowed to add/edit terms:</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryRoles" value="0" />
                                <?php
                                echo CMTT_Pro::outputRolesList();
                                ?>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the custom post types where you'd like the Glossary Terms to be highlighted.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Create Glossary Term Pages:</th>
                            <td>
                                <input type="hidden" name="cmtt_createGlossaryTermPages" value="0" />
                                <input type="checkbox" name="cmtt_createGlossaryTermPages" <?php checked(true, get_option('cmtt_createGlossaryTermPages', TRUE)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Uncheck this if you don't want the Glossary Term pages to be created. <strong>After disabling this all of the links to the Glossary Term pages will be removed.</strong></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Glossary Terms Permalink</th>
                            <td><input type="text" name="cmtt_glossaryPermalink" value="<?php echo get_option('cmtt_glossaryPermalink', 'glossary'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Enter the name you would like to use for the permalink to the Glossary Terms.
                                By default this is "glossary", however you can update this if you wish.
                                If you are using a parent please indicate this in path eg. "/path/glossary", otherwise just leave glossary or the name you have chosen.
                                <br/><br/>
                                The permalink of the Glossary Index Page will change automatically, but you can change it manually (if you like) using the "edit" link near the "Link to the Glossary Index Page" above.
                                <br/><br/><strong>WARNING! If you already use this permalink the plugin's behavior may be unpredictable.</strong>
                                <br/><strong>This option cannot be empty.</strong>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Glossary Breadcrumbs Title</th>
                            <td><input type="text" name="cmtt_glossaryBreadcrumbs" value="<?php echo get_option('cmtt_glossaryBreadcrumbs', CMTT_NAME); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Enter the name for the plugin's post type, which is usually displayed in the breadcrumbs.
                                By default this is the post type name, however you can change it here to anything you want.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Limit number of characters for the description column text in the Glossary List Table</th>
                            <td>
                                <input type="hidden" name="cmtt_show_desc_inlist_table" value="0"/>
                                <input type="number" min="0" step="1"
                                       name="cmtt_show_desc_inlist_table"
                                       value="<?php echo get_option('cmtt_show_desc_inlist_table', 0); ?>"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show a limited
                                number of characters in the description column. If the value set to 0, the description column will be hidden.</td>
                        </tr>

                    </table>
                    <div class="clear"></div>
                </div>
                <div class="block">
                    <h3>Advanced Custom Fields Settings</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Highlight terms in ACF fields?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryParseACFFields" value="0" />
                                <input type="checkbox" name="cmtt_glossaryParseACFFields" <?php checked(true, get_option('cmtt_glossaryParseACFFields')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container"> Select this option if you wish to highlight Glossary Terms in ALL of the "Advanced Custom Fields" fields.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Types of fields to highlight:</th>
                            <td>
                                <input type="hidden" name="cmtt_acf_parsed_field_types" value="0" />
                                <?php
                                echo CMTT_Pro::outputACFTypesList();
                                ?>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the types of ACF fields in which you'd like the Glossary Terms to be highlighted.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Types of fields to remove the WP functions:</th>
                            <td>
                                <input type="hidden" name="cmtt_acf_remove_filters_for_type" value="0" />
                                <?php
                                echo CMTT_Pro::outputACFTypesList('cmtt_acf_remove_filters_for_type', array('text'));
                                ?>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the types of ACF fields for which the built in WP filters adding paragraphs and newlines should be removed.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Types of fields to wrap with &lt;span&gt; tag:</th>
                            <td>
                                <input type="hidden" name="cmtt_acf_wrap_in_span_for_type" value="0"/>
                                <?php
                                echo CMTT_Pro::outputACFTypesList('cmtt_acf_wrap_in_span_for_type', array('text', 'checkbox'));
                                ?>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the types of ACF fields which should be wrapped
                                with &lt;span&gt; tag.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Don't use the DOM parser for ACF fields?</th>
                            <td>
                                <input type="hidden" name="cmtt_disableDOMParserForACF" value="0" />
                                <input type="checkbox" name="cmtt_disableDOMParserForACF" <?php checked(true, get_option('cmtt_disableDOMParserForACF', FALSE)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to parse the ACF fields using the simple parser (preg_replace) instead of DOM parser. Warning! May break content.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" ><?php _e('Excluded ACF Field IDs', 'cm-tooltip-glossary'); ?>:</th>
                            <td>
                                <input type="text" name="cmtt_disableACFfields" value="<?php echo get_option('cmtt_disableACFfields'); ?>" placeholder="<?php _e('field_id,field_2_id', 'cm-tooltip-glossary'); ?>"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">You can put here the comma separated list of IDs of the ACF fields you would like to exclude from being parsed.</td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Term highlighting</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Highlight terms on given post types:</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryOnPosttypes" value="0" />
                                <?php
                                echo CMTT_Pro::outputCustomPostTypesList();
                                ?>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the custom post types where you'd like the Glossary Terms to be highlighted.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Only show terms on single posts/pages (not Homepage, authors etc.)?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryOnlySingle" value="0" />
                                <input type="checkbox" name="cmtt_glossaryOnlySingle" <?php checked(true, get_option('cmtt_glossaryOnlySingle')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish to only highlight glossary terms when viewing a single page/post.
                                This can be used so terms aren't highlighted on your homepage, or author pages and other taxonomy related pages.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Highlight terms in bbPress replies?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryParseBBPressFields" value="0" />
                                <input type="checkbox" name="cmtt_glossaryParseBBPressFields" <?php checked(true, get_option('cmtt_glossaryParseBBPressFields')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container"> Select this option if you wish to highlight Glossary Terms in ALL of the "bbPress" replies.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Highlight terms on BuddyPress pages?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryParseBuddyPressPages" value="0" />
                                <input type="checkbox" name="cmtt_glossaryParseBuddyPressPages" <?php checked(true, get_option('cmtt_glossaryParseBuddyPressPages', 1)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container"> Select this option if you wish to highlight Glossary Terms in ALL of the "bbPress" replies.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Highlight first term occurrence only?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryFirstOnly" value="0" />
                                <input type="checkbox" name="cmtt_glossaryFirstOnly" <?php checked(true, get_option('cmtt_glossaryFirstOnly')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you want to only highlight the first occurrence of each term on a page/post.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Treat variations/synonyms the same as base term?</th>
                            <td>
                                <input type="hidden" name="cmtt_firstOnlyIncludingVariations" value="0" />
                                <input type="checkbox" name="cmtt_firstOnlyIncludingVariations" <?php checked(true, get_option('cmtt_firstOnlyIncludingVariations', 0)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to only highlight the first occurrence of each of the terms form/variant/synonym.
                                eg. if the term is "HTML" and it appears in the content as both "HTML" and "html", both will be highlighted.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Highlight only space separated terms?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryOnlySpaceSeparated" value="0" />
                                <input type="checkbox" name="cmtt_glossaryOnlySpaceSeparated" <?php checked(true, get_option('cmtt_glossaryOnlySpaceSeparated')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to only search for the terms separated from other words (usually by space).</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Highlight the terms in Text Widget</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryParseTextWidget" value="0" />
                                <input type="checkbox" name="cmtt_glossaryParseTextWidget" <?php checked(true, get_option('cmtt_glossaryParseTextWidget', 1)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to highlight the glossary terms in the Text Widget built in WordPress.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Highlight the terms in WPBakery</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryParseWPBakery" value="0" />
                                <input type="checkbox" name="cmtt_glossaryParseWPBakery" <?php checked(true, get_option('cmtt_glossaryParseWPBakery', 0)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to highlight the glossary terms in the WPBakery shortcodes.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Highlight the terms on category/tag pages</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryHighlightInArchive" value="0" />
                                <input type="checkbox"
                                       name="cmtt_glossaryHighlightInArchive"
                                       <?php checked(true, get_option('cmtt_glossaryHighlightInArchive', 1)); ?>
                                       value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you want to highlight the glossary terms on category/tag pages.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Exclude hyphenated words</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryExcludeHyphenatedWords" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_glossaryExcludeHyphenatedWords"
                                       <?php checked(true, get_option('cmtt_glossaryExcludeHyphenatedWords', 0)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you wish to exclude hyphenated words, like
                                <i>camera-ready</i>, <i>up-to-date</i> <i>and well-known</i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Exclude words in double quotes</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryInDoubleQuotes" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_glossaryInDoubleQuotes"
                                       <?php checked(true, get_option('cmtt_glossaryInDoubleQuotes', 0)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you wish to exclude words in double quotes
                            </td>
                        </tr>
                    </table>
                    <div class="clear"></div>
                </div>

                <div class="block">
                    <h3>Footnotes display settings</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" >Display terms as a footnotes:</th>
                            <td>
                                <input type="hidden" name="cmtt_displayTermsAsFootnotes" value="0" />
                                <input type="checkbox" name="cmtt_displayTermsAsFootnotes" <?php checked(1, get_option('cmtt_displayTermsAsFootnotes')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Enable show terms not as links with tooltips but as footnotes with definitions below the main post content<br><br></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left">Display style :</th>
                            <td>
                                <label for="cmtt_footnoteAestheticsType"></label>
                                <select name="cmtt_footnoteAestheticsType">
                                    <option value="type1" <?php selected('type1', get_option('cmtt_footnoteAestheticsType')); ?>>Square brackets</option>
                                    <option value="type2" <?php selected('type2', get_option('cmtt_footnoteAestheticsType')); ?>>Curly brackets</option>
                                </select>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">How the reference link is displayed in the Front-End<br><br></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" style="width:100px;">Font size</th>
                            <td>
                                <label for="cmtt_footnoteSymbolSize"></label>
                                <input type="text" name="cmtt_footnoteSymbolSize" value="<?php echo get_option('cmtt_footnoteSymbolSize'); ?>" style="width:60px;"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Choose the font size for footnote link<br><br></td>
                            <th scope="row" valign="middle" align="left" style="width:100px;">Color</th>
                            <td>
                                <label for="cmtt_footnoteSymbolColor"></label>
                                <input type="color" name="cmtt_footnoteSymbolColor" value="<?php echo get_option('cmtt_footnoteSymbolColor'); ?>" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Choose the font color for footnote link<br><br></td>
                            <th scope="row" valign="middle" align="left" style="width:100px;">Style</th>
                            <td>
                                <label for="cmtt_footnoteFormat"></label>
                                <select name="cmtt_footnoteFormat"><option value="none" <?php selected('none', get_option('cmtt_footnoteFormat')); ?>>None</option><option value="bold" <?php selected('bold', get_option('cmtt_footnoteFormat')); ?>>Bold</option>
                                    <option value="italic" <?php selected('italic', get_option('cmtt_footnoteFormat')); ?>>Italic</option>
                                </select>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Choose the font style for footnote link<br><br></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" style="width:200px;">Footnotes definitions title</th>
                            <td>
                                <label for="cmtt_footnoteDefTitle"></label>
                                <input type="text" name="cmtt_footnoteDefTitle" value="<?php echo get_option('cmtt_footnoteDefTitle', 'Terms defenitions'); ?>" style="width:260px;"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Choose the title for footnote (terms) definitions bottom block<br><br></td>
                        </tr>
                    </table>
                </div>

                <div class="block">
                    <h3>Performance &amp; Debug</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Add RSS feeds?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryAddFeeds" value="0" />
                                <input type="checkbox" name="cmtt_glossaryAddFeeds" <?php checked(true, get_option('cmtt_glossaryAddFeeds', true)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                <strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Select this option if you want to have the RSS feeds for your glossary terms.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Load the scripts in footer?</th>
                            <td>
                                <input type="hidden" name="cmtt_script_in_footer" value="0" />
                                <input type="checkbox" name="cmtt_script_in_footer" <?php checked(true, get_option('cmtt_script_in_footer', true)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                <strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Select this option if you want to load the plugin's js files in the footer.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Only highlight on "main" WP query?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryOnMainQuery" value="0" />
                                <input type="checkbox" name="cmtt_glossaryOnMainQuery" <?php checked(1, get_option('cmtt_glossaryOnMainQuery')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                <strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Select this option if you wish to only highlight glossary terms on main glossary query.
                                Unchecking this box may fix problems with highlighting terms on some themes which manipulate the WP_Query.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Run the function outputting the Glossary Index Page only once</th>
                            <td>
                                <input type="hidden" name="cmtt_removeGlossaryCreateListFilter" value="0" />
                                <input type="checkbox" name="cmtt_removeGlossaryCreateListFilter" <?php checked(1, get_option('cmtt_removeGlossaryCreateListFilter')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                <strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Select this option if you wish to remove the filter responsible for outputting the Glossary Index. <br/>
                                When this option is selected the function responsible for rendering the Glossary Index page (hooked to "the_content" filter) <br/>
                                will run only once and then it will be removed. It's known that this conflicts with some translation plugins (e.g. qTranslate, Jetpack, PageBuilder).
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Run backlink generating function only once</th>
                            <td>
                                <input type="hidden" name="cmtt_addBacklinksOnce" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_addBacklinksOnce" <?php checked(true, get_option('cmtt_addBacklinksOnce', 0)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show a backlink to Glossary Index on glossary term page only once
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Enable the caching mechanisms</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryEnableCaching" value="0" />
                                <input type="checkbox" name="cmtt_glossaryEnableCaching" <?php checked(true, get_option('cmtt_glossaryEnableCaching', FALSE)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to use the internal caching mechanisms.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Remove the parsing of the excerpts?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryRemoveExcerptParsing" value="0" />
                                <input type="checkbox" name="cmtt_glossaryRemoveExcerptParsing" <?php checked(true, get_option('cmtt_glossaryRemoveExcerptParsing', 1)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Uncheck this option if you'd like to parse the excerpts in search for the glossary terms.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Move tooltip contents to footer?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryTooltipHashContent" value="0" />
                                <input type="checkbox" name="cmtt_glossaryTooltipHashContent" <?php checked(true, get_option('cmtt_glossaryTooltipHashContent', 0)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                If this option is enabled, the tooltip content will not be passed directly to JS with the HTML attribute.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Don't use the DOM parser for the content</th>
                            <td>
                                <input type="hidden" name="cmtt_disableDOMParser" value="0" />
                                <input type="checkbox" id="cmtt_disableDOMParser" name="cmtt_disableDOMParser" <?php checked(true, get_option('cmtt_disableDOMParser', FALSE)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                <strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Select this option if you want to parse the content using the simple parser (preg_replace) instead of DOM parser.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" ><?php _e('Tooltip Parsing Priority', 'cm-tooltip-glossary'); ?>:</th>
                            <td>
                                <input type="text" name="cmtt_tooltipParsingPriority" value="<?php echo get_option('cmtt_tooltipParsingPriority', 20000); ?>" placeholder="20000"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container"><strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Changes the priority of the "glossary_parse" function firing. Can solve some problems with builders.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" ><?php _e('Tooltip Variants/Synonyms Separator', 'cm-tooltip-glossary'); ?>:</th>
                            <td>
                                <input type="text" name="cmtt_tooltipVariantsSynonymsSeparator" value="<?php echo get_option('cmtt_tooltipVariantsSynonymsSeparator', ','); ?>" placeholder=","/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container"><strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Changes the separator for the Glossary Term Synonyms/Variants, can be used if you plan to use commas in the terms. For example you can use semicolon ";", hash "#" etc.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Use a non-minified version of tooltip script</th>
                            <td>
                                <input type="hidden" name="cmtt_disableMinifiedTooltip" value="0"/>
                                <input type="checkbox" id="cmtt_disableMinifiedTooltip"
                                       name="cmtt_disableMinifiedTooltip" <?php checked(true, get_option('cmtt_disableMinifiedTooltip', false)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                <strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Select this option if you want use non-minified version of the tooltip.js file.<br/>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Turn on AMP</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryTurnOnAmp" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_glossaryTurnOnAmp" <?php checked(true, get_option('cmtt_glossaryTurnOnAmp', 0)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you want to show tooltips in AMP pages.<br/>
                                <a href="https://creativeminds.helpscoutdocs.com/article/2648-cm-tooltip-cmtg-extras-amp-support-accelerated-mobile-pages"
                                   target="_blank">
                                    <i>See documentation</i>
                                </a>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Add structured data to the Term Page</th>
                            <td>
                                <input type="hidden" name="cmtt_add_structured_data_term_page" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_add_structured_data_term_page" <?php checked(true, get_option('cmtt_add_structured_data_term_page', 1)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you want to add <a href="https://developers.google.com/search/docs/guides/intro-structured-data">
                                    structured data</a> to the Term Page.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Convert content to initial encoding</th>
                            <td>
                                <input type="hidden" name="cmtt_convert_to_initial_encoding" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_convert_to_initial_encoding"
                                       <?php checked(true, get_option('cmtt_convert_to_initial_encoding', 0)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                <strong>Warning: Don't change this setting unless you know what you're doing</strong><br/>
                                Select this option if you want to convert page content from "HTML Entities" to "UTF-8"
                                after the CM Tooltip parser has processed the content.
                            </td>
                        </tr>
                    </table>
                    <div class="clear"></div>
                </div>
                <div class="block">
                    <h3>Backup</h3>
                    <p>Easily backup your glossary to the file. You can create/download a backup on the <a href="<?php echo admin_url('admin.php?page=cmtt_importexport'); ?>">Import/Export</a> page.</p>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" >PIN Protect</th>
                            <td>
                                <input type="text" name="cmtt_glossary_backup_pinprotect" value="<?php echo get_option('cmtt_glossary_backup_pinprotect'); ?>"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Fill this field with a PIN code which will be required to get the backup. Leave empty to disable PIN Protection.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" >Secure Backup</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_backup_secure" value="0" />
                                <input type="checkbox" name="cmtt_glossary_backup_secure" <?php checked(true, get_option('cmtt_glossary_backup_secure', true)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this field if you want to use the secure WP Filesystem API for the file saves. Note: This may require the FTP/SSH credentials.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Backup rebuild interval:</th>
                            <td>
                                <select name="cmtt_glossary_backupCronInterval" >
                                    <?php
                                    $types = wp_get_schedules();
                                    $selectedInterval = get_option('cmtt_glossary_backupCronInterval', 'none');
                                    ?>
                                    <option value="none" <?php selected('none', $selectedInterval) ?>><?php _e('Never', 'cm-tooltip-glossary') ?></option>
                                    <?php foreach ($types as $typeName => $type): ?>
                                        <option value="<?php echo $typeName; ?>" <?php selected($typeName, $selectedInterval) ?>><?php echo $type['display']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Choose how often the backup of the glossary is saved. Choose 'none' to disable automatic saves.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Backup rebuild hour:</th>
                            <td><input type="time" placeholder="00:00" size="5" name="cmtt_glossary_backupCronHour" value="<?php echo get_option('cmtt_glossary_backupCronHour'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Choose the hour when the Glossary Index Backup save should take place. The hour should be properly formatted string eg. 23:00 or 1 AM</td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Edit Screen Elements</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" ><?php _e('Synonym Suggestions API', 'cm-tooltip-glossary'); ?>:</th>
                            <td>
                                <input type="text" name="cmtt_glossarySynonymSuggestionsAPI" value="<?php echo get_option('cmtt_glossarySynonymSuggestionsAPI'); ?>" placeholder="<?php _e('Affiliate Code', 'cm-tooltip-glossary'); ?>"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">To get the API Key please go to <a href="https://words.bighugelabs.com/getkey.php" target="_blank">Big Huge Thesaurus</a></td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Referrals</h3>
                    <p>Refer new users to any of the CM Plugins and you'll receive a minimum of <strong>15%</strong> of their purchase! For more information please visit CM Plugins <a href="http://www.cminds.com/referral-program/" target="new">Affiliate page</a></p>
                    <table>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" >Enable referrals:</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryReferral" value="0" />
                                <input type="checkbox" name="cmtt_glossaryReferral" <?php checked(1, get_option('cmtt_glossaryReferral')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Enable referrals link at the bottom of the question and the answer page<br><br></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" valign="middle" align="left" ><?php _e('Affiliate Code', 'cm-tooltip-glossary'); ?>:</th>
                            <td>
                                <input type="text" name="cmtt_glossaryAffiliateCode" value="<?php echo get_option('cmtt_glossaryAffiliateCode'); ?>" placeholder="<?php _e('Affiliate Code', 'cm-tooltip-glossary'); ?>"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container"><?php _e('Please add your affiliate code in here.', 'cm-tooltip-glossary'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="tabs-2">
                <div class="block">
                    <h3>Glossary Index Page Settings</h3>
                    <table class="floated-form-table form-table">


                        <tr valign="top">
                            <th scope="row">Remove the link from Glossary Index to the Glossary Term pages?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryListTermLink" value="0" />
                                <input type="checkbox" name="cmtt_glossaryListTermLink" <?php checked(true, get_option('cmtt_glossaryListTermLink')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you do not want to show links to the glossary term pages on the Glossary Index page. Keep in mind that the plugin use a <strong>&lt;span&gt;</strong> tag instead of a link tag and if you are using a custom CSS you should take this into account</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Style glossary index page differently?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryDiffLinkClass" value="0" />
                                <input type="checkbox" name="cmtt_glossaryDiffLinkClass" <?php checked(true, get_option('cmtt_glossaryDiffLinkClass')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish for the links in the glossary index page to be styled differently than the regular way glossary terms links are styled.  By selecting this option you will be able to use the class 'glossaryLinkMain' to style only the links on the glossary index page otherwise they will retain the class 'glossaryLink' and will be identical to the linked terms on all other pages.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show featured image thumbnail?</th>
                            <td>
                                <input type="hidden" name="cmtt_showFeaturedImageThumbnail" value="0" />
                                <input type="checkbox" name="cmtt_showFeaturedImageThumbnail" <?php checked(true, get_option('cmtt_showFeaturedImageThumbnail')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you want to display the thumbnails of the featured image on the Glossary Index (when available).
                                <br/><i>Works only on "Classic + definition", "Classic + excerpt"</i>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show glossary index page as tiles</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryListTiles" value="0" />
                                <input type="checkbox" name="cmtt_glossaryListTiles" <?php checked(true, get_option('cmtt_glossaryListTiles')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish the glossary index page to be displayed as tiles. This is not recommended when you have long terms.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Small tiles tile width</th>
                            <td><input type="text" name="cmtt_glossarySmallTileWidth" value="<?php echo get_option('cmtt_glossarySmallTileWidth', '85px'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select the width of the single tile in the "Small tiles" view
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show glossary index page with definition</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryTooltipDesc" value="0" />
                                <input type="checkbox" name="cmtt_glossaryTooltipDesc" <?php checked(true, get_option('cmtt_glossaryTooltipDesc')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish the glossary index page to be displayed with definition near each term.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Remove the tooltips on the Glossary Index Page?</th>
                            <td>&nbsp;</td>
                            <?php
                            $link = admin_url('post.php?post=' . get_option('cmtt_glossaryID') . '&action=edit');
                            ?>
                            <td colspan="2" class="cmtt_field_help_container">If you want to remove the tooltip from the Glossary Index page, you should edit the page using Wordpress's Pages menu (or clicking <a href="<?php echo $link; ?>" target="_blank">this link</a>)<br/>
                                And in the <strong>"Tooltip Plugin"</strong> tab select the option <strong>"Exclude this page from Tooltip plugin"</strong></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Mark terms not older than X days as "New"</th>
                            <td><input type="text" name="cmtt_glossaryNewItemMaxDays" value="<?php echo get_option('cmtt_glossaryNewItemMaxDays', '0'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">
                                If this setting contains a positive number then Glossary Terms not older than this number will be marked as "New". 0 turns off the feature.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Title for the mark indicating "New" terms</th>
                            <td><input type="text" name="cmtt_glossaryNewItemMarkTitle" value="<?php echo get_option('cmtt_glossaryNewItemMarkTitle', 'New!'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">
                                You can select the title which will appear as a title on hover over the star indicating that the term is "New".
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Sharing box</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Show the sharing box on the Glossary Index Page?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryShowShareBox" value="0" />
                                <input type="checkbox" name="cmtt_glossaryShowShareBox" <?php checked(true, get_option('cmtt_glossaryShowShareBox')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish to show the "Share This" box on the Glossary Index Page with links to Facebook, Twitter, Google+ and LinkedIn.</td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Pagination</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Paginate Glossary Index page (items per page)</th>
                            <td><input type="text" name="cmtt_perPage" value="<?php echo get_option('cmtt_perPage'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">How many elements per page should be displayed (0 to disable pagination)</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Pagination type</th>
                            <td><select name="cmtt_glossaryServerSidePagination">
                                    <option value="0" <?php echo selected(0, get_option('cmtt_glossaryServerSidePagination')); ?>>Client-side</option>
                                    <option value="1" <?php echo selected(1, get_option('cmtt_glossaryServerSidePagination')); ?>>Server-side</option>
                                </select></td>
                            <td colspan="2" class="cmtt_field_help_container">Client-side: longer loading, fast page switch (with additional alphabetical index)<br />
                                Server-side: faster loading, slower page switch <br/>
                                <strong>Note: The Alphabetical Index only works in Server-side pagination in Pro+/Ecommerce</strong>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Pagination position (Server-side only)</th>
                            <td><select name="cmtt_glossaryPaginationPosition">
                                    <option value="bottom" <?php echo selected('bottom', get_option('cmtt_glossaryPaginationPosition')); ?>>Bottom</option>
                                    <option value="top" <?php echo selected('top', get_option('cmtt_glossaryPaginationPosition')); ?>>Top</option>
                                    <option value="both" <?php echo selected('both', get_option('cmtt_glossaryPaginationPosition')); ?>>Both</option>
                                </select></td>
                            <td colspan="2" class="cmtt_field_help_container">Choose where you would like the pagination to appear on the Index Page (only for the Server-side pagination). For the client side the pagination is always on the bottom. </td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Alphabetic index</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Display Alphabetical Index</th>
                            <td>
                                <input type="hidden" name="cmtt_index_enabled" value="0" />
                                <input type="checkbox" name="cmtt_index_enabled" <?php checked(true, get_option('cmtt_index_enabled', 1)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">If you uncheck this option the alphabetical index will not be displayed on the Glossary Index Page</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Stretch the alphabetical index to 100% </th>
                            <td>
                                <input type="hidden" name="cmtt_letter_width" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_letter_width" <?php checked(true, get_option('cmtt_letter_width', 0)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">If you check this option the alphabetical index will be stretched to 100% width
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Letters in alphabetic index</th>
                            <td><input type="text" class="cmtt_longtext" name="cmtt_index_letters" value="<?php echo esc_attr(implode(',', get_option('cmtt_index_letters', array()))); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Which letters should be shown in alphabetic index (separate by commas)</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Size of the letters in alphabetic index</th>
                            <td>
                                <select name="cmtt_indexLettersSize">
                                    <option value="small" <?php selected('small', get_option('cmtt_indexLettersSize')); ?>>Small</option>
                                    <option value="medium" <?php selected('medium', get_option('cmtt_indexLettersSize')); ?>>Medium</option>
                                    <option value="large" <?php selected('large', get_option('cmtt_indexLettersSize')); ?>>Large</option>
                                </select>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the size of the letters in the alphabetic index: small(7pt), medium(10pt), large(14pt)</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show numeric [0-9] in alphabetic index?</th>
                            <td>
                                <input type="hidden" name="cmtt_index_includeNum" value="0" />
                                <input type="checkbox" name="cmtt_index_includeNum" <?php checked(true, get_option('cmtt_index_includeNum')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish to show [0-9] option in alphabetical index.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show all [ALL] in alphabetic index?</th>
                            <td>
                                <input type="hidden" name="cmtt_index_includeAll" value="0" />
                                <input type="checkbox" name="cmtt_index_includeAll" <?php checked(true, get_option('cmtt_index_includeAll')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish to show [All] option in alphabetical index.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show matching elements counts in alphabetic index?</th>
                            <td>
                                <input type="hidden" name="cmtt_index_showCounts" value="0" />
                                <input type="checkbox" name="cmtt_index_showCounts" <?php checked(true, get_option('cmtt_index_showCounts', '1')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show the number of elements matching each letter on hover.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show empty letters in alphabetic index?</th>
                            <td>
                                <input type="hidden" name="cmtt_index_showEmpty" value="0" />
                                <input type="checkbox" name="cmtt_index_showEmpty" <?php checked(true, get_option('cmtt_index_showEmpty')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish to display empty letters (they will be grayed out). Uncheck to hide.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Use titles for sorting instead of permalinks?</th>
                            <td>
                                <input type="hidden" name="cmtt_index_sortby_title" value="0" />
                                <input type="checkbox" name="cmtt_index_sortby_title" <?php checked(true, get_option('cmtt_index_sortby_title', '0')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">By default the terms in the Glossary Index are sorted by their slug(permalink part), which allows to differentiate terms with the same title (multiple meanings). You can switch to sorting by title if that better suits your needs.<td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">What locale should be used for sorting?</th>
                            <td><input type="text" size="4" name="cmtt_index_locale" value="<?php echo get_option('cmtt_index_locale', get_locale()) ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container"> You can specify the locale which should be used for sorting the items on Glossary Index eg. 'de_DE', 'it_IT'. If left empty the locale of the Wordpress installation will be used.
                                <br/><i>Works only if the "intl" library is installed (see "Server Information" tab).</i></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Limit items in the glossary index page </th>
                            <td><input type="text" name="cmtt_limitNum" value="<?php echo get_option('cmtt_limitNum', 0); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">How many items in the glossary index page should be displayed</td>
                        </tr>


                    </table>
                </div>
            </div>
            <div id="tabs-3">
                <div class="block">
                    <h3>Glossary Term - Display</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Choose the template for glossary term?</th>
                            <td>
                                <select name="cmtt_glossaryPageTermTemplate">
                                    <?php
                                    $selectedTemplate = get_option('cmtt_glossaryPageTermTemplate', 0);
                                    $templates = CMTT_Custom_Templates::getPageTemplatesOptions();
                                    ?>
                                    <?php foreach ($templates as $templateKey => $template): ?>
                                        <option value="<?php echo $templateKey; ?>" <?php selected($templateKey, $selectedTemplate) ?>><?php echo $template; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Choose the page template of the current theme or set default.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show the sharing box on the Glossary Term Page?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryShowShareBoxTermPage" value="0" />
                                <input type="checkbox" name="cmtt_glossaryShowShareBoxTermPage" <?php checked(true, get_option('cmtt_glossaryShowShareBoxTermPage')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you wish to show the "Share This" box on the Glossary Index Page with links to Facebook, Twitter, Google+ and LinkedIn.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show back link on the top</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_addBackLink" value="0" />
                                <input type="checkbox" name="cmtt_glossary_addBackLink" <?php checked(true, get_option('cmtt_glossary_addBackLink')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show link back to Glossary Index from glossary term page</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show back link on the bottom</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_addBackLinkBottom" value="0" />
                                <input type="checkbox" name="cmtt_glossary_addBackLinkBottom" <?php checked(true, get_option('cmtt_glossary_addBackLinkBottom')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show link back to Glossary Index from glossary term page</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Remove comments from term page</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryRemoveCommentsTermPage" value="0" />
                                <input type="checkbox" name="cmtt_glossaryRemoveCommentsTermPage" <?php checked(true, get_option('cmtt_glossaryRemoveCommentsTermPage')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to remove the comments support form the term pages.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Content to be displayed before the Glossary Term description</th>
                            <td>
                                <textarea cols="30" rows="4" style="resize: both" placeholder="You can put anything here, including HTML and shortcodes" name="cmtt_glossaryContentBefore" /><?php echo get_option('cmtt_glossaryContentBefore', '') ?></textarea>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">You can put anything here, including HTML, shortcodes. It will be displayed right before the description.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Content to be displayed after the Glossary Term description</th>
                            <td>
                                <textarea cols="30" rows="4" style="resize: both" placeholder="You can put anything here, including HTML and shortcodes" name="cmtt_glossaryContentAfter" /><?php echo get_option('cmtt_glossaryContentAfter', '') ?></textarea>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">You can put anything here, including HTML, shortcodes. It will be displayed right after the description.</td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Glossary Term - Links</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Remove link to the glossary term page?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryTermLink" value="0" />
                                <input type="checkbox" name="cmtt_glossaryTermLink" <?php checked(true, get_option('cmtt_glossaryTermLink')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you do not want to show links from posts or pages to the glossary term pages. This will only apply to Post / Pages and not to the Glossary Index page, for Glossary Index page please visit index page tab in settings. Keep in mind that the plugin use a <strong>&lt;span&gt;</strong> tag instead of a link tag and if you are using a custom CSS you should take this into account</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Simplify term permalink</th>
                            <td>
                                <input type="hidden" name="cmtt_withoutGlossaryForTermLink" value="0" />
                                <input type="checkbox" name="cmtt_withoutGlossaryForTermLink" <?php checked(true, get_option('cmtt_withoutGlossaryForTermLink', '0')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Enable this option if you want to remove "glossary" slug from term permalink
                                <br>Example: www.example.com/term
                                <br> instead of www.example.com/glossary/term</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Open glossary term page in a new windows/tab?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryInNewPage" value="0" />
                                <input type="checkbox" name="cmtt_glossaryInNewPage" <?php checked(true, get_option('cmtt_glossaryInNewPage')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want glossary term page to open in a new window/tab.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show HTML "title" attribute for glossary links</th>
                            <td>
                                <input type="hidden" name="cmtt_showTitleAttribute" value="0" />
                                <input type="checkbox" name="cmtt_showTitleAttribute" <?php checked(true, get_option('cmtt_showTitleAttribute')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to use glossary name as HTML "title" for link</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Link underline</th>
                            <td>Style: <select name="cmtt_tooltipLinkUnderlineStyle">
                                    <option value="none" <?php selected('none', get_option('cmtt_tooltipLinkUnderlineStyle')); ?>>None</option>
                                    <option value="solid" <?php selected('solid', get_option('cmtt_tooltipLinkUnderlineStyle')); ?>>Solid</option>
                                    <option value="dotted" <?php selected('dotted', get_option('cmtt_tooltipLinkUnderlineStyle')); ?>>Dotted</option>
                                    <option value="dashed" <?php selected('dashed', get_option('cmtt_tooltipLinkUnderlineStyle')); ?>>Dashed</option>
                                </select><br />
                                Width: <input type="number" name="cmtt_tooltipLinkUnderlineWidth" value="<?php echo get_option('cmtt_tooltipLinkUnderlineWidth'); ?>" step="1" min="0" max="10"/>px<br />
                                Color: <input type="text" class="colorpicker" name="cmtt_tooltipLinkUnderlineColor" value="<?php echo get_option('cmtt_tooltipLinkUnderlineColor'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Set style of glossary link underline</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Link underline (hover)</th>
                            <td>Style: <select name="cmtt_tooltipLinkHoverUnderlineStyle">
                                    <option value="none" <?php selected('none', get_option('cmtt_tooltipLinkHoverUnderlineStyle')); ?>>None</option>
                                    <option value="solid" <?php selected('solid', get_option('cmtt_tooltipLinkHoverUnderlineStyle')); ?>>Solid</option>
                                    <option value="dotted" <?php selected('dotted', get_option('cmtt_tooltipLinkHoverUnderlineStyle')); ?>>Dotted</option>
                                    <option value="dashed" <?php selected('dashed', get_option('cmtt_tooltipLinkHoverUnderlineStyle')); ?>>Dashed</option>
                                </select><br />
                                Width: <input type="number" name="cmtt_tooltipLinkHoverUnderlineWidth" value="<?php echo get_option('cmtt_tooltipLinkHoverUnderlineWidth'); ?>" step="1" min="0" max="10"/>px<br />
                                Color: <input type="text" class="colorpicker" name="cmtt_tooltipLinkHoverUnderlineColor" value="<?php echo get_option('cmtt_tooltipLinkHoverUnderlineColor'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Set style of glossary link underline on mouse hover</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Link text color</th>
                            <td><input type="text" class="colorpicker" name="cmtt_tooltipLinkColor" value="<?php echo get_option('cmtt_tooltipLinkColor'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Set color of glossary link text color</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Link text color (hover)</th>
                            <td><input type="text" class="colorpicker" name="cmtt_tooltipLinkHoverColor" value="<?php echo get_option('cmtt_tooltipLinkHoverColor'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">Set color of glossary link text color on mouse hover</td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Glossary Term - Related Articles &amp; Terms</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Show related articles</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_showRelatedArticles" value="0" />
                                <input type="checkbox" name="cmtt_glossary_showRelatedArticles" <?php checked(true, get_option('cmtt_glossary_showRelatedArticles')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show list of related articles (posts, pages) on glossary term description page</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Order of the related articles by:</th>
                            <td>
                                <select name="cmtt_glossary_relatedArticlesOrder">
                                    <option value="menu_order" <?php selected('menu_order', get_option('cmtt_glossary_relatedArticlesOrder')); ?>>Menu Order</option>
                                    <option value="post_title" <?php selected('post_title', get_option('cmtt_glossary_relatedArticlesOrder')); ?>>Post Title</option>
                                    <option value="post_date DESC" <?php selected('post_date DESC', get_option('cmtt_glossary_relatedArticlesOrder')); ?>>Publising Date DESC</option>
                                    <option value="post_date ASC" <?php selected('post_date ASC', get_option('cmtt_glossary_relatedArticlesOrder')); ?>>Publising Date ASC</option>
                                    <option value="post_modified DESC" <?php selected('post_modified DESC', get_option('cmtt_glossary_relatedArticlesOrder')); ?>>Last Modified DESC</option>
                                    <option value="post_modified ASC" <?php selected('post_modified ASC', get_option('cmtt_glossary_relatedArticlesOrder')); ?>>Last Modified ASC</option>
                                </select>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">How the related articles should be ordered?</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Number of related articles:</th>
                            <td><input type="number" name="cmtt_glossary_showRelatedArticlesCount" value="<?php echo get_option('cmtt_glossary_showRelatedArticlesCount'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">How many related articles should be shown?</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Post types to index:</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_showRelatedArticlesPostTypesArr" value="" />
                                <select multiple name="cmtt_glossary_showRelatedArticlesPostTypesArr[]" >
                                    <?php
                                    $types = get_option('cmtt_glossary_showRelatedArticlesPostTypesArr');
                                    foreach (get_post_types() as $type):
                                        ?>
                                        <option value="<?php echo $type; ?>" <?php if (is_array($types) && in_array($type, $types)) echo 'selected'; ?>><?php echo $type; ?></option>
                                    <?php endforeach; ?>
                                </select></td>
                            <td colspan="2" class="cmtt_field_help_container">Which post types should be indexed? (select more by holding down ctrl key)</td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">Refresh related articles index:</th>
                            <td><input type="submit" name="cmtt_glossaryRelatedRefresh" value="Rebuild Index!" class="button"/></td>
                            <td colspan="2" class="cmtt_field_help_container">The index for relations between articles (posts, pages) and glossary terms is being rebuilt on daily basis. Click this button if you want to do it manually (it may take a while)</td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">Auto-add parsed pages to related articles index?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_relatedFillAfterParsing" value="0" />
                                <input type="checkbox" name="cmtt_glossary_relatedFillAfterParsing" <?php checked(true, get_option('cmtt_glossary_relatedFillAfterParsing', 0)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to automatically add the parsed pages to the glossary index when they're parsed.</td>
                        </tr>

                    </table>
                </div>
                <div class="block">
                    <h3>Glossary Term - Synonyms</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Show synonyms list</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_addSynonyms" value="0" />
                                <input type="checkbox" name="cmtt_glossary_addSynonyms" <?php checked(true, get_option('cmtt_glossary_addSynonyms')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show list of synonyms of the term on glossary term description page</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show synonyms list in tooltip</th>
                            <td>
                                <input type="hidden" name="cmtt_glossary_addSynonymsTooltip" value="0" />
                                <input type="checkbox" name="cmtt_glossary_addSynonymsTooltip" <?php checked(true, get_option('cmtt_glossary_addSynonymsTooltip')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to show the list of synonyms of the term tooltip</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Show synonyms in Glossary Index Page</th>
                            <td>
                                <input type="hidden" name="cmtt_glossarySynonymsInIndex" value="0" />
                                <input type="checkbox"
                                       name="cmtt_glossarySynonymsInIndex" <?php checked(true, get_option('cmtt_glossarySynonymsInIndex')); ?>
                                       value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you want to show synonyms as terms in Glossary Index Page
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="tabs-4">
                <div class="block">
                    <h3>Tooltip - Content</h3>
                    <?php do_action('cminds_cmtt_admin_tooltip_preview'); ?>
                    <table class="floated-form-table form-table">
                        <th scope="row">Show tooltip?</th>
                        <td>
                            <input type="hidden" name="cmtt_glossaryTooltip" value="0"/>
                            <input type="checkbox"
                                   name="cmtt_glossaryTooltip" <?php checked(true, get_option('cmtt_glossaryTooltip')); ?>
                                   value="1"/>
                        </td>
                        <td colspan="2" class="cmtt_field_help_container">Select this option if you wish to show a tooltip.
                            By default the tooltip will appear on hover, to show tooltips on click also enable option
                            "Display tooltips on click".  The tooltip can be styled differently using the tooltip.css
                            and tooltip.js files in the plugin folder.
                        </td>
                        <tr valign="top">
                            <th scope="row">Add term title to the tooltip content?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryAddTermTitle" value="0" />
                                <input type="checkbox" name="cmtt_glossaryAddTermTitle" <?php checked(true, get_option('cmtt_glossaryAddTermTitle')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want the term title to appear in the tooltip content.</td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">Show links to related articles?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryTooltipShowLink" value="0" />
                                <input type="checkbox" name="cmtt_glossaryTooltipShowLink" <?php checked(true, get_option('cmtt_glossaryTooltipShowLink')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you'd like to show the related articles list in the tooltip content.</td>
                        </tr> 
                        <tr valign="top">
                            <th scope="row">How many related articles should be shown?</th>
                            <td><input type="text" name="cmtt_glossaryTooltipAmountLinks" value="<?php echo get_option('cmtt_glossaryTooltipAmountLinks'); ?>"  /></td>
                            <td colspan="2" class="cmtt_field_help_container">How many related articles should be shown in the tooltip?</td>
                        </tr>      

                        <tr valign="top">
                            <th scope="row">Add term editlink to the tooltip content?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryAddTermEditlink" value="0" />
                                <input type="checkbox" name="cmtt_glossaryAddTermEditlink" <?php checked(true, get_option('cmtt_glossaryAddTermEditlink')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want the term editlink to appear in the tooltip content (only for logged in users with "edit_posts" capability).</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Strip the shortcodes?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryTooltipStripShortcode" value="0" />
                                <input type="checkbox" name="cmtt_glossaryTooltipStripShortcode" <?php checked(true, get_option('cmtt_glossaryTooltipStripShortcode')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to strip the shortcodes from the glossary page description/excerpt before showing the tooltip.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Limit tooltip length?</th>
                            <td><input type="text" name="cmtt_glossaryLimitTooltip" value="<?php echo get_option('cmtt_glossaryLimitTooltip'); ?>"  /></td>
                            <td colspan="2" class="cmtt_field_help_container">
                                Select this option if you want to show only a limited number of characters (minimum is 30) and add "<?php echo get_option('cmtt_glossaryTermDetailsLink'); ?>" at the end of the tooltip text.<br/>
                                <strong>The tooltip has to be clickable for users to be able to click this link.</strong>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Add term page link to the end of the tooltip content?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryAddTermPagelink" value="0" />
                                <input type="checkbox" name="cmtt_glossaryAddTermPagelink" <?php checked(true, get_option('cmtt_glossaryAddTermPagelink', false)); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want the term page link to appear in the tooltip content.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Clean tooltip text?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryFilterTooltip" value="0" />
                                <input type="checkbox" name="cmtt_glossaryFilterTooltip" <?php checked(true, get_option('cmtt_glossaryFilterTooltip')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to remove extra spaces and special characters from tooltip text.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Leave the &lt;a&gt; tags?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryFilterTooltipA" value="0" />
                                <input type="checkbox" name="cmtt_glossaryFilterTooltipA" <?php checked(true, get_option('cmtt_glossaryFilterTooltipA')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to preserve the html anchor tags in tooltip text.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Leave the &lt;img&gt; tags?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryFilterTooltipImg" value="0" />
                                <input type="checkbox" name="cmtt_glossaryFilterTooltipImg" <?php checked(true, get_option('cmtt_glossaryFilterTooltipImg')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to preserve the images in tooltip text.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Use term excerpt for hover?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryExcerptHover" value="0" />
                                <input type="checkbox" name="cmtt_glossaryExcerptHover" <?php checked(true, get_option('cmtt_glossaryExcerptHover')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to use the term excerpt (if it exists) as hover text.
                                <br/>NOTE: You have to manually create the excerpts for term pages using the "Excerpt" field.
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Avoid parsing protected tags?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryProtectedTags" value="0" />
                                <input type="checkbox" name="cmtt_glossaryProtectedTags" <?php checked(true, get_option('cmtt_glossaryProtectedTags')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want to avoid using the glossary for the following tags: Script, A, H1, H2, H3, PRE, Object.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Terms case-sensitive?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryCaseSensitive" value="0" />
                                <input type="checkbox" name="cmtt_glossaryCaseSensitive" <?php checked('1', get_option('cmtt_glossaryCaseSensitive')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select this option if you want glossary terms to be case-sensitive.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Content to be displayed before the Tooltip content</th>
                            <td>
                                <textarea cols="30" rows="4" style="resize: both" placeholder="You can put anything here, including HTML and shortcodes" name="cmtt_glossaryTooltipContentBefore" /><?php echo get_option('cmtt_glossaryTooltipContentBefore', '') ?></textarea>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">You can put anything here, including HTML, shortcodes. It will be displayed right before the description.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Content to be displayed after the Tooltip content</th>
                            <td>
                                <textarea cols="30" rows="4" style="resize: both" placeholder="You can put anything here, including HTML and shortcodes" name="cmtt_glossaryTooltipContentAfter" /><?php echo get_option('cmtt_glossaryTooltipContentAfter', '') ?></textarea>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">You can put anything here, including HTML, shortcodes. It will be displayed right after the description.</td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Tooltip - Mobile Support & Activation</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row">Disable tooltips on mobile devices?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryMobileDisableTooltips" value="0" />
                                <input type="checkbox" name="cmtt_glossaryMobileDisableTooltips" <?php checked(true, get_option('cmtt_glossaryMobileDisableTooltips')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">If this option is enabled then on the mobile devices the tooltips will not appear.</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Display tooltips on click?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryShowTooltipOnClick" value="0" />
                                <input type="checkbox" name="cmtt_glossaryShowTooltipOnClick" <?php checked(true, get_option('cmtt_glossaryShowTooltipOnClick', '0')); ?> value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">If this option is enabled then on the tooltips will be displayed only when term is clicked not on hover (default).</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Close tooltips only on button click?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryCloseOnlyOnButton" value="0" />
                                <input type="checkbox"
                                       name="cmtt_glossaryCloseOnlyOnButton" <?php checked(true, get_option('cmtt_glossaryCloseOnlyOnButton', 0)); ?>
                                       value="1" />
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">If this option is enabled then the only way to close the tooltip
                                on mobile devices will be by clicking the "Close icon".
                                <br/>
                                <strong>Make sure that the "Show close icon" option is enabled, otherwise it won't be possible to close the tooltips!</strong>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Disable tooltips on desktops?</th>
                            <td>
                                <input type="hidden" name="cmtt_glossaryDesktopDisableTooltips" value="0"/>
                                <input type="checkbox"
                                       name="cmtt_glossaryDesktopDisableTooltips"
                                       <?php checked(true, get_option('cmtt_glossaryDesktopDisableTooltips', 0)); ?>
                                       value="1"/>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">If this option is enabled then on desktops
                                the tooltips will not appear.
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="block">
                    <h3>Tooltip - Featured Images</h3>
                    <table class="floated-form-table form-table">
                        <tr valign="top">
                            <th scope="row"> Show featured image in tooltip?</th>
                            <td>
                                <select name="cmtt_glossary_tooltip_featuredImageDisplay">
                                    <option value="no" <?php selected('no', get_option('cmtt_glossary_tooltip_featuredImageDisplay')); ?>>No</option>
                                    <option value="above_content" <?php selected('above_content', get_option('cmtt_glossary_tooltip_featuredImageDisplay')); ?>>Above content</option>
                                    <option value="below_content" <?php selected('below_content', get_option('cmtt_glossary_tooltip_featuredImageDisplay')); ?>>Below Content</option>
                                    <option value="left_aligned" <?php selected('left_aligned', get_option('cmtt_glossary_tooltip_featuredImageDisplay')); ?>>Left Aligned</option>
                                    <option value="right_aligned" <?php selected('right_aligned', get_option('cmtt_glossary_tooltip_featuredImageDisplay')); ?>>Right Aligned</option>
                                </select>
                            </td>
                            <td colspan="2" class="cmtt_field_help_container">Select the way you want the image to be displayed in the tooltip</td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Image width:</th>
                            <td><input type="text" name="cmtt_glossary_tooltip_imageWidth" value="<?php echo get_option('cmtt_glossary_tooltip_imageWidth', '100px'); ?>" /></td>
                            <td colspan="2" class="cmtt_field_help_container">The image's width in the tooltip</td>
                        </tr>
                    </table>
                </div>
                <?php
                $additionalTooltipTabContent = apply_filters('cmtt_settings_tooltip_tab_content_after', '');
                echo $additionalTooltipTabContent;
                ?>
            </div>

        </div>
        <p class="submit" style="clear:left">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'cm-tooltip-glossary') ?>" name="cmtt_glossarySave" />
        </p>
    </form>
</div>