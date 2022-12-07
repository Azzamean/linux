
<div class="block">
    <h3 class="section-title">
        <span>General Settings</span>
        <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
            <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
        </svg>
    </h3>
    <table class="floated-form-table form-table">
        <tr valign="top">
            <th scope="row">Reset settings to defaults</th>
            <td>
                <input type="checkbox" name="cmttct_reset_labels" value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Check if you want to reset the labels to defaults (it will remove all current labels).</td>
        </tr>
    </table>
</div>
<div class="block">
    <h3 class="section-title">
        <span>Form Settings</span>
        <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
            <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
        </svg>
    </h3>
    <table class="floated-form-table form-table">
        <tr valign="top">
            <th scope="row">Reset settings to defaults</th>
            <td>
                <input type="checkbox" name="cmttct_reset_labels" value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Check if you want to reset the labels to defaults (it will remove all current labels).</td>
        </tr>
        <tr valign="top">
            <th scope="row">Show Captcha</th>
            <td>
                <input type="hidden" name="cmttct_captcha" value="0" />
                <input type="checkbox" name="cmttct_captcha" <?php echo!empty($captcha) ? 'checked="checked"' : '' ?> value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want to secure the form with Captcha.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Captcha key</th>
            <td>
                <input type="text" name="cmttct_captcha_key" value="<?php echo!empty($captcha_key) ? $captcha_key : ''; ?>" />
            </td>
            <td colspan="2" class="cmbd_field_help_container">Enter the captcha key.</td>
        </tr>

        <tr valign="top">
            <th scope="row" >Captcha secret key</th>
            <td>
                <input type="text" name="cmttct_captcha_private_key" value="<?php echo!empty($captcha_private_key) ? $captcha_private_key : ''; ?>" />
            </td>
            <td colspan="2" class="cmbd_field_help_container">Enter the captcha secret key. You can get your key here: <a href="http://www.google.com/recaptcha/admin"></a></td>
        </tr>
    </table>
</div>

<div class="block">
    <h3 class="section-title">
        <span>Moderation Settings</span>
        <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
            <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
        </svg>
    </h3>
    <table class="floated-form-table form-table">
        <tr valign="top">
            <th scope="row">Moderate new terms</th>
            <td>
                <input type="hidden" name="cmttct_moderation" value="0" />
                <input type="checkbox" name="cmttct_moderation" <?php echo!empty($moderation) ? 'checked="checked"' : '' ?> value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want to have new terms moderation.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Display moderated terms in Terms Dashboard?</th>
            <td>
                <input type="hidden" name="cmttct_show_moderated" value="0" />
                <input type="checkbox" name="cmttct_show_moderated" <?php checked(1, \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_MODERATED, '0')); ?> value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want to display the moderated terms in User Dashboard.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Who can add terms:</th>
            <td class="field-multiselect"><select multiple name="cmttct_allow_add_terms_roles[]" >
                    <?php foreach ($roles as $role_k => $role_v): ?>
                        <option value="<?php echo $role_k; ?>" <?php echo (!empty($allow_roles) && in_array($role_k, $allow_roles) ? 'selected="selected"' : '') ?>><?php echo $role_v; ?></option>
                    <?php endforeach; ?>
                </select></td>
            <td colspan="2" class="cm_field_help_container">Which roles should be able to add terms the the glossary? (select more by holding down ctrl key)</td>
        </tr>

    </table>
</div>

<!-- Star-Rating -->
<?php $enable_rating = \CM\CMTT_Settings::get('cmttct_star_rating'); ?>
<?php $rating_label = \CM\CMTT_Settings::get('cmttct_star_rating_label'); ?>
<?php $enable_numerical = \CM\CMTT_Settings::get('cmttct_star_rating_numerical'); ?>
<?php $display_top = \CM\CMTT_Settings::get('cmttct_star_rating_display_top'); ?>
<?php $display_count = \CM\CMTT_Settings::get('cmttct_star_rating_display_count'); ?>
<div class="block">
    <h3 class="section-title">
        <span>Star Rating</span>
        <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
            <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
        </svg>
    </h3>
    <table class="floated-form-table form-table">
        <tr valing="top">
            <th scope="row">Enable rating terms?</th>
            <td>
                <input type="hidden" 	name="cmttct_star_rating" value="0" />
                <input type="checkbox" 	name="cmttct_star_rating" <?php echo!empty($enable_rating) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want to enable rating terms.</td>
        </tr>
        <tr valign="top">
            <th scope="row">Rating label</th>
            <td>
                <input type="text" name="cmttct_star_rating_label" value="<?php echo!empty($rating_label) ? $rating_label : 'Rating:' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Write down a different label if you would like to translate it</td>
        </tr>
        <tr valing="top">
            <th scope="row">Display numerical rating</th>
            <td>
                <input type="hidden" 	name="cmttct_star_rating_numerical" value="0" />
                <input type="checkbox" 	name="cmttct_star_rating_numerical" <?php echo!empty($enable_numerical) ? 'checked="checked"' : ''; ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want to display numerical rating.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Display rating on top</th>
            <td>
                <input type="hidden" 	name="cmttct_star_rating_display_top" value="0" />
                <input type="checkbox"	name="cmttct_star_rating_display_top" <?php echo!empty($display_top) ? 'checked="checked"' : ''; ?> />
            </td>
            <td colspan="2" class="cm_field_help_container"></td>
        </tr>
        <tr valign="top">
            <th scope="row">Display number of rates</th>
            <td>
                <input type="hidden" 	name="cmttct_star_rating_display_count" value="0" />
                <input type="checkbox"	name="cmttct_star_rating_display_count" <?php echo!empty($display_count) ? 'checked="checked"' : ''; ?> />
            </td>
            <td colspan="2" class="cm_field_help_container"></td>
        </tr>
    </table>
</div>

<div class="block">
    <h3 class="section-title">
        <span>Notification Settings</span>
        <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
            <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
        </svg>
    </h3>
    <table class="floated-form-table form-table">

        <tr valign="top" class=" whole-line">
            <th scope="row">Admin panel notification</th>
            <td>
                <input type="hidden" name="cmttct_panel_notification" value="0" />
                <input type="checkbox" name="cmttct_panel_notification" <?php echo!empty($panel_notification) ? 'checked="checked"' : '' ?> value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want admin to see notification in admin panel when new terms has been added.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Admin email notification</th>
            <td>
                <input type="hidden" name="cmttct_notification" value="0" />
                <input type="checkbox" name="cmttct_notification" <?php echo!empty($notification) ? 'checked="checked"' : '' ?> value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want to recive notification when new terms has been added.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Admin email notification subject</th>
            <td>
                <input type="text" name="cmttct_notification_subject" value="<?php echo!empty($notification_subject) ? $notification_subject : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the admin email notification subject.</td>
        </tr>

        <tr valign="top" class=" whole-line">
            <th scope="row">Admin email notification text</th>
            <td>
                <textarea name="cmttct_notification_text" placeholder="Write notification message here" cols="40" rows="5"><?php echo!empty($notification_text) ? $notification_text : '' ?></textarea>
            </td>
            <td colspan="2" class="cm_field_help_container">This option let you define notification text. (Works only when admin notification is enabled). <br/><br/> You can use tag [term] to display the name of the term. </td>
        </tr>

        <tr valign="top">
            <th scope="row">User email notification</th>
            <td>
                <input type="hidden" name="cmttct_user_notification" value="0" />
                <input type="checkbox" name="cmttct_user_notification" <?php echo!empty($user_notification) ? 'checked="checked"' : '' ?> value="1" />
            </td>
            <td colspan="2" class="cm_field_help_container">Select this option if you want user to recive notification when the status of a terms has been changed.</td>
        </tr>
        <tr valign="top">
            <th scope="row">User email notification subject</th>
            <td>
                <input type="text" name="cmttct_user_notification_subject" value="<?php echo!empty($user_notification_subject) ? $user_notification_subject : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the user email notification subject.</td>
        </tr>

        <tr valign="top" class=" whole-line">
            <th scope="row">User email notification text</th>
            <td>
                <textarea name="cmttct_user_notification_text" placeholder="Write user notification message here" cols="40" rows="5"><?php echo!empty($user_notification_text) ? $user_notification_text : '' ?></textarea>
            </td>
            <td colspan="2" class="cm_field_help_container">This option let you define user notification text. (Works only when user notification is enabled). <br/><br/> You can use tags: [term], [old], [new] to display the name, old status and new status of the term)</td>
        </tr>
    </table>
</div>

<div class="block">
    <h3 class="section-title">
        <span>Suggest Term Form</span>
        <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
            <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
        </svg>
    </h3>
    <table class="floated-form-table form-table">
        <tr valign="top">
            <th scope="row">Page ID</th>
            <td>
                <input type="text" name="cmttct_form_page_id" value="<?php echo!empty($form_page_id) ? $form_page_id : '' ?>" />
                <?php if (!empty($form_page_id) && get_post($form_page_id)): ?>
                    <span><a href="<?php echo admin_url('post.php?post=' . $form_page_id . '&action=edit'); ?>" target="_blank"> edit </a></span>
                <?php endif; ?>
            </td>
            <td colspan="2" class="cm_field_help_container">Page ID used to build a link to the page with "Suggest term" form. You can click edit to open the page editor.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Allow user to edit terms</th>
            <td>
                <input type="hidden" name="cmttct_allow_edit_term" value="0" />
                <input type="checkbox" name="cmttct_allow_edit_term" value="1" <?php echo!empty($allow_edit_term) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Enable edit option.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Private Terms</th>
            <td>
                <select name="cmttct_allow_private_term">
                    <option value="0" <?php selected('0', $allow_private_term); ?>>Not allowed</option>
                    <option value="1" <?php selected('1', $allow_private_term); ?>>Allowed</option>
                    <option value="2" <?php selected('2', $allow_private_term); ?>>Forced</option>
                </select>
            </td>
            <td colspan="2" class="cm_field_help_container">Enable making term private (meaning that it will only be highlighted for it's author).<br>
                    If "Forced" option is selected every user-created term will be private. (doesn't affect terms created in the past, unless edited)</td>
        </tr>

        <tr valign="top">
            <th scope="row">Allow user to delete terms</th>
            <td>
                <input type="hidden" name="cmttct_allow_delete_term" value="0" />
                <input type="checkbox" name="cmttct_allow_delete_term" value="1" <?php echo!empty($allow_delete_term) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Enable delete option.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Allow anonymous users to add terms without specyfing email address</th>
            <td>
                <input type="hidden" name="cmttct_anonymous_email_permit" value="0" />
                <input type="checkbox" name="cmttct_anonymous_email_permit" value="1" <?php echo $anonymous_email_permit ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Let anonymous users suggest terms without e-mail.</td>
        </tr>

        <?php if (class_exists('CMTT_Glossary_Plus')) : ?>
            <tr valign="top">
                <th scope="row">Automatically assign user terms to selected category</th>
                <td class="field-multiselect">
                    <?php echo CMTT_Glossary_Plus::outputCategoriesSelect('cmttct_auto_categories'); ?>
                </td>
                <td colspan="2" class="cm_field_help_container">All user created terms will automatically be assigned to the selected categories.</td>
            </tr>
        <?php endif; ?>

        <tr valign="top">
            <th scope="row">Disable WP Editor</th>
            <td>
                <input type="hidden" name="cmttct_disable_wp_editor" value="0" />
                <input type="checkbox" name="cmttct_disable_wp_editor" value="1" <?php echo $disable_wp_editor ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">disable the WP Editor and use the simple textarea instead.</td>
        </tr>
    </table>

    <h4>Community terms labels</h4>
    <table class="floated-form-table form-table">
        <tr valign="top">
            <th scope="row">Link text</th>
            <td>
                <input type="text" name="cmttct_form_page_id_text" value="<?php echo!empty($form_page_id_text) ? $form_page_id_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Text for the link to the "Suggest term" form.</td>
        </tr>


        <tr valign="top">
            <th scope="row">Label: term title</th>
            <td>
                <input type="text" name="cmttct_form_term_title"  value="<?php echo!empty($form_term_title) ? $form_term_title : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Text for the link to the "Suggest term" form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Label: modification date</th>
            <td>
                <input type="text" name="cmttct_form_term_update" value="<?php echo!empty($form_term_update) ? $form_term_update : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container"></td>
        </tr>

        <tr valign="top">
            <th scope="row">Label: creation date</th>
            <td>
                <input type="text" name="cmttct_form_term_create" value="<?php echo!empty($form_term_create) ? $form_term_create : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container"></td>
        </tr>

        <tr valign="top">
            <th scope="row">Label: edit term</th>
            <td>
                <input type="text" name="cmttct_form_term_edit"   value="<?php echo!empty($form_term_edit) ? $form_term_edit : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Label: delete term</th>
            <td>
                <input type="text" name="cmttct_form_term_delete" value="<?php echo!empty($form_term_delete) ? $form_term_delete : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container"></td>
        </tr>
    </table>
</div>

<div class="block">
    <h3 class="section-title">
        <span>Form Labels &amp; Placeholders</span>
        <svg class="tab-arrow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#6BC07F">
            <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z"></path>
        </svg>
    </h3>
    <table class="floated-form-table form-table">
        <tr valign="top">
            <th scope="row">Title field text</th>
            <td>
                <input type="text" name="cmttct_form_title_text" value="<?php echo!empty($form_title_text) ? $form_title_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the title field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Title field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_title_placeholder" value="<?php echo!empty($form_title_placeholder) ? $form_title_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the title field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Description field text</th>
            <td>
                <input type="text" name="cmttct_form_description_text" value="<?php echo!empty($form_description_text) ? $form_description_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the description field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Private field text</th>
            <td>
                <input type="text" name="cmttct_form_private_text" value="<?php echo!empty($form_private_text) ? $form_private_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the private field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Description field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_description_placeholder" value="<?php echo!empty($form_description_placeholder) ? $form_description_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the description field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Email field text</th>
            <td>
                <input type="text" name="cmttct_form_email_text" value="<?php echo!empty($form_email_text) ? $form_email_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the email field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Email field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_email_placeholder" value="<?php echo!empty($form_email_placeholder) ? $form_email_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the email field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Captcha field text</th>
            <td>
                <input type="text" name="cmttct_form_captcha_text" value="<?php echo!empty($form_captcha_text) ? $form_captcha_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the captcha field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Button text</th>
            <td>
                <input type="text" name="cmttct_form_button_text" value="<?php echo!empty($form_button_text) ? $form_button_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the button label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Update button text</th>
            <td>
                <input type="text" name="cmttct_form_button_text_update" value="<?php echo!empty($form_button_text_update) ? $form_button_text_update : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the update button label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Saved notification</th>
            <td>
                <input type="text" name="cmttct_settings_saved" value="<?php echo!empty($cmttct_settings_saved) ? $cmttct_settings_saved : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed after the term is saved.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Moderation notification</th>
            <td>
                <input type="text" name="cmttct_settings_moderation" value="<?php echo!empty($cmttct_settings_moderation) ? $cmttct_settings_moderation : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed after the term is being held for moderation.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Wrong title error text</th>
            <td>
                <input type="text" name="cmttct_settings_error_text" value="<?php echo!empty($cmttct_settings_error_text) ? $cmttct_settings_error_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed after the term is being held for moderation.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Wrong captcha error text</th>
            <td>
                <input type="text" name="cmttct_settings_error_captcha" value="<?php echo!empty($cmttct_settings_error_captcha_text) ? $cmttct_settings_error_captcha_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed after the term is being held for moderation.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Published notification</th>
            <td>
                <input type="text" name="cmttct_settings_published" value="<?php echo!empty($cmttct_settings_published) ? $cmttct_settings_published : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed after the term is published immediately.</td>
        </tr>

        <tr valign="top">
            <th scope="row">No terms to display</th>
            <td>
                <input type="text" name="cmttct_settings_no_terms" value="<?php echo!empty($cmttct_settings_no_terms) ? $cmttct_settings_no_terms : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed if there are no terms to display.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Not logged in</th>
            <td>
                <input type="text" name="cmttct_settings_not_logged_in" value="<?php echo!empty($cmttct_settings_not_logged_in) ? $cmttct_settings_not_logged_in : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed if a user isn't logged in.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Not allowed to suggest a new term</th>
            <td>
                <input type="text" name="cmttct_settings_not_allowed_to_suggest" value="<?php echo!empty($cmttct_settings_not_allowed_suggest) ? $cmttct_settings_not_allowed_suggest : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text displayed if a user isn't allowed to suggest a new term.</td>
        </tr>

        <!--New Fields-->

        <tr valign="top">
            <th scope="row">Show the excerpt field?</th>
            <td>
                <input type="hidden" name="form_show_field_excerpt" value="0" />
                <input type="checkbox" name="form_show_field_excerpt" value="1" <?php echo!empty($form_show_field_excerpt) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Allow adding the excerpt field in the form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Excerpt field text</th>
            <td>
                <input type="text" name="cmttct_form_excerpt_text" value="<?php echo!empty($form_excerpt_text) ? $form_excerpt_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the excerpt field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Excerpt field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_excerpt_placeholder" value="<?php echo!empty($form_excerpt_placeholder) ? $form_excerpt_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the excerpt field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Show the categories field?</th>
            <td>
                <input type="hidden" name="form_show_field_categories" value="0" />
                <input type="checkbox" name="form_show_field_categories" value="1" <?php echo!empty($form_show_field_categories) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Allow adding the categories field in the form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">"All" selection text</th>
            <td>
                <input type="text" name="cmttct_all_selection" value="<?php echo!empty($all_selection_text) ? $all_selection_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the title field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Categories field text</th>
            <td>
                <input type="text" name="cmttct_form_categories_text" value="<?php echo!empty($form_categories_text) ? $form_categories_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the categories field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Categories field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_categories_placeholder" value="<?php echo!empty($form_categories_placeholder) ? $form_categories_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the categories field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Show the tags field?</th>
            <td>
                <input type="hidden" name="form_show_field_tags" value="0" />
                <input type="checkbox" name="form_show_field_tags" value="1" <?php echo!empty($form_show_field_tags) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Allow adding the tags field in the form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Tags field text</th>
            <td>
                <input type="text" name="cmttct_form_tags_text" value="<?php echo!empty($form_tags_text) ? $form_tags_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the tags field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Tags field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_tags_placeholder" value="<?php echo!empty($form_tags_placeholder) ? $form_tags_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the tags field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Show the image field?</th>
            <td>
                <input type="hidden" name="form_show_field_image" value="0" />
                <input type="checkbox" name="form_show_field_image" value="1" <?php echo!empty($form_show_field_image) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Allow adding the image field in the form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Image field text</th>
            <td>
                <input type="text" name="cmttct_form_image_text" value="<?php echo!empty($form_image_text) ? $form_image_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the image field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Image field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_image_placeholder" value="<?php echo!empty($form_image_placeholder) ? $form_image_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the image field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Image field "Uploads" text</th>
            <td>
                <input type="text" name="cmttct_form_image_upload" value="<?php echo!empty($form_image_upload) ? $form_image_upload : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text for the "Upload" label of the image field.</td>
        </tr>   

        <tr valign="top">
            <th scope="row">Image field "Upload new" text</th>
            <td>
                <input type="text" name="cmttct_form_image_upload_new" value="<?php echo!empty($form_image_upload_new) ? $form_image_upload_new : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text for the "Upload new" label of the image field.</td>
        </tr>    

        <tr valign="top">
            <th scope="row">Image field "View" text</th>
            <td>
                <input type="text" name="cmttct_form_image_view" value="<?php echo!empty($form_image_view) ? $form_image_view : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text for the "View" label of the image field.</td>
        </tr>   

        <tr valign="top">
            <th scope="row">Image field "Remove" text</th>
            <td>
                <input type="text" name="cmttct_form_image_remove" value="<?php echo!empty($form_image_remove) ? $form_image_remove : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text for the "Remove" label of the image field.</td>
        </tr>
        <tr valign="top">
            <th scope="row">Show the synonyms field?</th>
            <td>
                <input type="hidden" name="form_show_field_synonyms" value="0" />
                <input type="checkbox" name="form_show_field_synonyms" value="1" <?php echo!empty($form_show_field_synonyms) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Allow adding the synonyms field in the form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Synonyms field text</th>
            <td>
                <input type="text" name="cmttct_form_synonyms_text" value="<?php echo!empty($form_synonyms_text) ? $form_synonyms_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the synonyms field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Synonyms field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_synonyms_placeholder" value="<?php echo!empty($form_synonyms_placeholder) ? $form_synonyms_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the synonyms field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Show the variations field?</th>
            <td>
                <input type="hidden" name="form_show_field_variations" value="0" />
                <input type="checkbox" name="form_show_field_variations" value="1" <?php echo!empty($form_show_field_variations) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Allow adding the variations field in the form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Variations field text</th>
            <td>
                <input type="text" name="cmttct_form_variations_text" value="<?php echo!empty($form_variations_text) ? $form_variations_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the variations field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Variations field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_variations_placeholder" value="<?php echo!empty($form_variations_placeholder) ? $form_variations_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the variations field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Show the abbreviations field?</th>
            <td>
                <input type="hidden" name="form_show_field_abbreviations" value="0" />
                <input type="checkbox" name="form_show_field_abbreviations" value="1" <?php echo!empty($form_show_field_abbreviations) ? 'checked="checked"' : '' ?> />
            </td>
            <td colspan="2" class="cm_field_help_container">Allow adding the abbreviations field in the form.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Abbreviations field text</th>
            <td>
                <input type="text" name="cmttct_form_abbreviations_text" value="<?php echo!empty($form_abbreviations_text) ? $form_abbreviations_text : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the abbreviations field label.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Abbreviations field placeholder text</th>
            <td>
                <input type="text" name="cmttct_form_abbreviations_placeholder" value="<?php echo!empty($form_abbreviations_placeholder) ? $form_abbreviations_placeholder : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the placeholder text of the abbreviations field.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Pending status label</th>
            <td>
                <input type="text" name="cmttct_old_status" value="<?php echo!empty($form_old_status) ? $form_old_status : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text for "pending" status appearing in the e-mail.</td>
        </tr>

        <tr valign="top">
            <th scope="row">Publish status label</th>
            <td>
                <input type="text" name="cmttct_new_status" value="<?php echo!empty($form_new_status) ? $form_new_status : '' ?>" />
            </td>
            <td colspan="2" class="cm_field_help_container">Enter the text for "publish" status appearing in the e-mail.</td>
        </tr>

    </table>
</div>