<?php if ($data['allowAddTerms']) { ?>

    <div id="communityTerms_wrapper">

        <a name="mtmsg"></a>
        <div id="communityTerms_msg"></div>

        <form id="communityTerms_form" method="post">

            <?php if (isset($data['term_id'])) { ?>
                <input type="hidden" name="cmtct[term_id]" id="cmtct_term_id" value="<?php echo $data['term_id']; ?>" />
            <?php } ?>

            <!--Private field-->
            <?php if ($data['allow_private_term']): ?>

                <div id="communityTerms_private">
                    <?php if ('1' == $data['allow_private_term']): ?>
                        <label><?php echo $data['form_private_text'] ?>
                            <input type="checkbox" name="cmtct[private]" value="1" <?php checked('1', $data['form_is_private']); ?> />
                        </label>
                    <?php elseif ('2' == $data['allow_private_term']): ?>
                        <input type="hidden" name="cmtct[private]" value="1" />
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <label for="communityTerms_title"><?php echo $data['form_title_text'] ?></label>
            <div id="communityTerms_title">

                <?php if (isset($data['form_title_value'])) { ?>
                    <input type="text" name="cmtct[title]" value="<?php echo $data['form_title_value']; ?>" required="required" />
                <?php } else { ?>
                    <input type="text" name="cmtct[title]" placeholder="<?php echo $data['form_title_placeholder'] ?>" required="required" >
                <?php } ?>
            </div>

            <label for="communityTerms_description"><?php echo $data['form_description_text'] ?></label>
            <div id="communityTerms_description">
                <?php
                if ($data['disable_wp_editor']) {
                    echo '<textarea placeholder="' . $data['form_description_placeholder'] . '">' . (isset($data['form_description_value']) ? $data['form_description_value'] : '') . '</textarea>';
                } else {
                    wp_editor($data['form_description_placeholder'], 'communityTerms_description_area', $data['editor_settings']);
                }
                ?>
            </div>
            <!--Excerpt field-->
            <?php if ($data['form_show_field_excerpt']): ?>
                <label for="communityTerms_excerpt"><?php echo $data['form_excerpt_text'] ?></label>
                <div id="communityTerms_excerpt">
                    <?php
                    if ($data['disable_wp_editor']) {
                        echo '<textarea placeholder="' . $data['form_excerpt_placeholder'] . '">' . (isset($data['form_excerpt_value']) ? $data['form_excerpt_value'] : '') . '</textarea>';
                    } else {
                        wp_editor($data['form_excerpt_placeholder'], 'communityTerms_excerpt_area', $data['editor_settings_excerpt']);
                    }
                    ?>
                </div>
            <?php endif; ?>

            <!--Categories field-->
            <?php if ($data['form_show_field_categories']): ?>
                <label for="communityTerms_categories"><?php echo $data['form_categories_text'] ?></label>
                <div id="communityTerms_categories">
                    <?php
                    $data['taxonomy'] = 'glossary-categories';
                    $data['field_slug'] = 'communityTerms_categories';
                    $data['hide_empty'] = false;
                    echo CMTooltipCommunityTermsDashboardFrontend::getTaxonomyTerms($data);
                    ?>
                </div>
            <?php endif; ?>

            <!--Tags field-->
            <?php if ($data['form_show_field_tags']): ?>
                <label for="communityTerms_tags"><?php echo $data['form_tags_text'] ?></label>
                <div id="communityTerms_tags">
                    <?php
                    $data['taxonomy'] = 'glossary-tags';
                    $data['field_slug'] = 'communityTerms_tags';
                    $data['hide_empty'] = false;
                    echo CMTooltipCommunityTermsDashboardFrontend::getTaxonomyTerms($data);
                    ?>
                </div>
            <?php endif; ?>

            <!--Image field-->
            <?php if ($data['form_show_field_image']): ?>
                <label for="communityTerms_image"><?php echo $data['form_image_text'] ?></label>
                <div id="communityTerms_image">
                    <?php
                    echo CMTooltipCommunityTermsFrontend::$upload->getEditView(array());
                    ?>
                </div>
            <?php endif; ?>

            <!--Synonyms field-->
            <?php if ($data['form_show_field_synonyms']): ?>
                <label for="communityTerms_synonyms"><?php echo $data['form_synonyms_text'] ?></label>
                <div id="communityTerms_synonyms">
                    <textarea name="communityTerms_synonyms" placeholder="<?php echo $data['form_synonyms_placeholder']; ?>"><?php echo isset($data['form_synonyms_value']) ? $data['form_synonyms_value'] : ''; ?></textarea>
                </div>
            <?php endif; ?>

            <!--Variations field-->
            <?php if ($data['form_show_field_variations']): ?>
                <label for="communityTerms_variations"><?php echo $data['form_variations_text'] ?></label>
                <div id="communityTerms_variations">
                    <textarea name="communityTerms_variations" placeholder="<?php echo $data['form_variations_placeholder']; ?>"><?php echo isset($data['form_variations_value']) ? $data['form_variations_value'] : ''; ?></textarea>
                </div>
            <?php endif; ?>

            <!--Abbreviations field-->
            <?php if ($data['form_show_field_abbreviations']): ?>
                <label for="communityTerms_abbreviations"><?php echo $data['form_abbreviations_text'] ?></label>
                <div id="communityTerms_abbreviations">
                    <?php // wp_editor( $data[ 'form_abbreviations_placeholder' ], 'communityTerms_abbreviations_area', $data[ 'editor_settings' ] )    ?>
                    <textarea name="communityTerms_abbreviations" placeholder="<?php echo $data['form_abbreviations_placeholder']; ?>"><?php echo isset($data['form_abbreviations_value']) ? $data['form_abbreviations_value'] : ''; ?></textarea>
                </div>
            <?php endif; ?>

            <?php if (!$data['loggedIn']): ?>

                <label for="communityTerms_email"><?php echo $data['form_email_text'] ?></label>
                <div id="communityTerms_email"><input type="email" name="cmtct[email]" placeholder="<?php echo $data['form_email_placeholder'] ?>" <?php echo 0 == $data['anonymous_email_permit'] ? 'required="required"' : '' ?> ></div>
            <?php else: ?>
                <div id="communityTerms_logged_in">
                    <input type="hidden" name="logged-in" value="1" />
                </div>
                <?php if (isset($data['user_id'])) { ?>
                    <input type="hidden" name="cmtct[user_id]" id="cmtct_user_id" value="<?php echo $data['user_id']; ?>" />
                <?php } ?>
            <?php endif; ?>

            <?php
            if (!empty($data['captcha'])) {
                echo CMTCT_Recaptcha::getScript();
            }
            ?>

            <div id="communityTerms_button">
                <button <?php echo!empty($data['captcha']) ? CMTCT_Recaptcha::getAtts() : ''; ?> type="submit"><?php echo $data['form_button_text'] ?></button>
            </div>

            <div id="communityTerms_overlay" class="alert alert-info">
                <span>
                    <?php echo __($data['form_please_wait_text'], 'cmt_community_terms') . '...' ?>
                </span>
            </div>

        </form>
    </div>
    <?php
} else {
    echo \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_NOT_ALLOWED_TO_SUGGEST, 'Currently you are not allowed to suggest a new terms. Please contact with page administrator.');
}
?>