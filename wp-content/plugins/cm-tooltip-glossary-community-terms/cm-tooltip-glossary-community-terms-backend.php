<?php

class CMTooltipCommunityTermsBackend {

    const COMMUNITYTERMS_SEARCH_BY_AUTHOR = 'cmttct_search_by_author';
    const COMMUNITYTERMS_CAPTCHA = 'cmttct_captcha';
    const COMMUNITYTERMS_CAPTCHA_KEY = 'cmttct_captcha_key';
    const COMMUNITYTERMS_CAPTCHA_PRIVATE_KEY = 'cmttct_captcha_private_key';
    const COMMUNITYTERMS_MODERATION = 'cmttct_moderation';
    const COMMUNITYTERMS_SHOW_MODERATED = 'cmttct_show_moderated';
    const COMMUNITYTERMS_ALLOW_ROLES = 'cmttct_allow_add_terms_roles';
    const COMMUNITYTERMS_ADMIN_NOTIFICATION = 'cmttct_notification';
    const COMMUNITYTERMS_NOTIFICATION_TEXT = 'cmttct_notification_text';
    const COMMUNITYTERMS_NOTIFICATION_SUBJECT = 'cmttct_notification_subject';
    const COMMUNITYTERMS_USER_NOTIFICATION = 'cmttct_user_notification';
    const COMMUNITYTERMS_USER_NOTIFICATION_TEXT = 'cmttct_user_notification_text';
    const COMMUNITYTERMS_USER_NOTIFICATION_SUBJECT = 'cmttct_user_notification_subject';
    const COMMUNITYTERMS_PANEL_NOTIFICATION = 'cmttct_panel_notification';
    const COMMUNITYTERMS_FORM_PAGE_ID = 'cmttct_form_page_id';
    const COMMUNITYTERMS_FORM_PAGE_ID_TEXT = 'cmttct_form_page_id_text';
    const COMMUNITYTERMS_ALLOW_ANONYMOUS_EMAIL = 'cmttct_anonymous_email_permit';
    const COMMUNITYTERMS_DISABLE_WP_EDITOR = 'cmttct_disable_wp_editor';
    const COMMUNITYTERMS_ALLOW_EDIT_TERM = 'cmttct_allow_edit_term';
    const COMMUNITYTERMS_ALLOW_DELETE_TERM = 'cmttct_allow_delete_term';
    const COMMUNITYTERMS_ALLOW_PRIVATE_TERM = 'cmttct_allow_private_term';
// Labels and placeholders
    const COMMUNITYTERMS_OLD_STATUS = 'cmttct_old_status';
    const COMMUNITYTERMS_NEW_STATUS = 'cmttct_new_status';
    const COMMUNITYTERMS_FORM_TITLE_TEXT = 'cmttct_form_title_text';
    const COMMUNITYTERMS_FORM_PRIVATE_TEXT = 'cmttct_form_private_text';
    const COMMUNITYTERMS_FORM_TITLE_PLACEHOLDER = 'cmttct_form_title_placeholder';
    const COMMUNITYTERMS_FORM_DESCRIPTION_TEXT = 'cmttct_form_description_text';
    const COMMUNITYTERMS_FORM_DESCRIPTION_PLACEHOLDER = 'cmttct_form_description_placeholder';
    const COMMUNITYTERMS_FORM_EMAIL_TEXT = 'cmttct_form_email_text';
    const COMMUNITYTERMS_FORM_EMAIL_PLACEHOLDER = 'cmttct_form_email_placeholder';
    const COMMUNITYTERMS_FORM_CAPTCHA_TEXT = 'cmttct_form_captcha_text';
    const COMMUNITYTERMS_FORM_BUTTON_TEXT = 'cmttct_form_button_text';
    const COMMUNITYTERMS_FORM_BUTTON_TEXT_UPDATE = 'cmttct_form_button_text_update';
    const CMTCT_MYTERMS_USER_NOTIFICATION_DEFAULT_TEXT = 'Status of your term "%s" has been changed from "%s" to "%s".';
    const COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_TERM = '[term]';
    const COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_POST_NEW_STATUS = '[new]';
    const COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_POST_OLD_STATUS = '[old]';
    const COMMUNITYTERMS_PUBLISH_ALL_MSG = '[<strong>CM Tooltip Community Terms</strong>] All of the pending terms has been published.';
    const COMMUNITYTERMS_PUBLISH_TERM_MSG = '[<strong>CM Tooltip Community Terms</strong>] Selected term has been published.';
    const COMMUNITYTERMS_SETTINGS_SAVED = 'cmttct_settings_saved';
    const COMMUNITYTERMS_SETTINGS_ERROR_TEXT = 'cmttct_settings_error_text';
    const COMMUNITYTERMS_SETTINGS_ERROR_CAPTCHA = 'cmttct_settings_error_captcha';
    const COMMUNITYTERMS_SETTINGS_MODERATION = 'cmttct_settings_moderation';
    const COMMUNITYTERMS_SETTINGS_PUBLISHED = 'cmttct_settings_published';
    const COMMUNITYTERMS_SETTINGS_NO_TERMS = 'cmttct_settings_no_terms';
    const COMMUNITYTERMS_SETTINGS_NOT_ALLOWED_TO_SUGGEST = 'cmttct_settings_not_allowed_to_suggest';
    const COMMUNITYTERMS_SETTINGS_NOT_LOGGED_IN = 'cmttct_settings_not_logged_in';
    const COMMUNITYTERMS_FORM_TERM_TITLE = 'cmttct_form_term_title';
    const COMMUNITYTERMS_FORM_TERM_UPDATE = 'cmttct_form_term_update';
    const COMMUNITYTERMS_FORM_TERM_CREATE = 'cmttct_form_term_create';
    const COMMUNITYTERMS_FORM_TERM_EDIT = 'cmttct_form_term_edit';
    const COMMUNITYTERMS_FORM_TERM_DELETE = 'cmttct_form_term_delete';
    const COMMUNITYTERMS_SETTINGS_UPDATED = 'cmttct_settings_updated';
    const COMMUNITYTERMS_SETTINGS_EMPTY_FIELDS = 'cmttct_settings_empty_fields';
    const COMMUNITYTERMS_SETTINGS_EDITING_DISABLED = 'cmttct_settings_editing_disabled';

    /* Star-Rating */
    const COMMUNITYTERMS_SETTINGS_ENABLE_RATING = 'cmttct_star_rating';
    const COMMUNITYTERMS_SETTINGS_ENABLE_RATING_NUMERICAL = 'cmttct_star_rating_numerical';
    const COMMUNITYTERMS_SETTINGS_STAR_RATING_LABEL = 'cmttct_star_rating_label';
    const COMMUNITYTERMS_SETTINGS_STAR_RATING_DISPLAY_TOP = 'cmttct_star_rating_display_top';
    const COMMUNITYTERMS_SETTINGS_STAR_RATING_DISPLAY_COUNT = 'cmttct_star_rating_display_count';

    /* New fields */
    const COMMUNITYTERMS_SHOW_FIELD_EXCERPT = 'form_show_field_excerpt';
    const COMMUNITYTERMS_SHOW_FIELD_CATEGORIES = 'form_show_field_categories';
    const COMMUNITYTERMS_SHOW_FIELD_TAGS = 'form_show_field_tags';
    const COMMUNITYTERMS_SHOW_FIELD_IMAGE = 'form_show_field_image';
    const COMMUNITYTERMS_SHOW_FIELD_SYNONYMS = 'form_show_field_synonyms';
    const COMMUNITYTERMS_SHOW_FIELD_VARIATIONS = 'form_show_field_variations';
    const COMMUNITYTERMS_SHOW_FIELD_ABBREVIATIONS = 'form_show_field_abbreviations';
    const COMMUNITYTERMS_ALL_SELECTION = 'cmttct_all_selection';
    const COMMUNITYTERMS_FORM_EXCERPT_TEXT = 'cmttct_form_excerpt_text';
    const COMMUNITYTERMS_FORM_EXCERPT_PLACEHOLDER = 'cmttct_form_excerpt_placeholder';
    const COMMUNITYTERMS_FORM_CATEGORIES_TEXT = 'cmttct_form_categories_text';
    const COMMUNITYTERMS_FORM_CATEGORIES_PLACEHOLDER = 'cmttct_form_categories_placeholder';
    const COMMUNITYTERMS_FORM_TAGS_TEXT = 'cmttct_form_tags_text';
    const COMMUNITYTERMS_FORM_TAGS_PLACEHOLDER = 'cmttct_form_tags_placeholder';
    const COMMUNITYTERMS_FORM_IAMGE_TEXT = 'cmttct_form_image_text';
    const COMMUNITYTERMS_FORM_IAMGE_PLACEHOLDER = 'cmttct_form_image_placeholder';
    const COMMUNITYTERMS_FORM_IAMGE_UPLOAD = 'cmttct_form_image_upload';
    const COMMUNITYTERMS_FORM_IAMGE_UPLOAD_NEW = 'cmttct_form_image_upload_new';
    const COMMUNITYTERMS_FORM_IAMGE_VIEW = 'cmttct_form_image_view';
    const COMMUNITYTERMS_FORM_IAMGE_REMOVE = 'cmttct_form_image_remove';
    const COMMUNITYTERMS_FORM_SYNONYMS_TEXT = 'cmttct_form_synonyms_text';
    const COMMUNITYTERMS_FORM_SYNONYMS_PLACEHOLDER = 'cmttct_form_synonyms_placeholder';
    const COMMUNITYTERMS_FORM_VARIATIONS_TEXT = 'cmttct_form_variations_text';
    const COMMUNITYTERMS_FORM_VARIATIONS_PLACEHOLDER = 'cmttct_form_variations_placeholder';
    const COMMUNITYTERMS_FORM_ABBREVIATIONS_TEXT = 'cmttct_form_abbreviations_text';
    const COMMUNITYTERMS_FORM_ABBREVIATIONS_PLACEHOLDER = 'cmttct_form_abbreviations_placeholder';
    const COMMUNITYTERMS_FORM_PLEASE_WAIT_TEXT = 'cmttct_form_please_wait_text';

    /* Index Page */
    const COMMUNITYTERMS_INDEX_PAGE_AUTHOR_FILTER = 'cmttct_index_page_author_filter';

    static $panelNotification = '';

    public static function registerFilterActions() {
        add_action('manage_posts_custom_column', array(__CLASS__, 'displayEmail'), 10, 2);
        add_action('transition_post_status', array(__CLASS__, 'statusObserver'), 10, 3);

        add_filter('cmtt_config', [__CLASS__, 'cmtt_config']);
        add_filter('cmtt_thirdparty_option_names', array(__CLASS__, 'addOptionNames'));
        add_filter('cmtt_save_options_after', array(__CLASS__, 'maybeResetLabels'), 10, 2);

        add_filter('cmtt_restrict_manage_posts_filter', array(__CLASS__, 'cmttct_restrict_manage_posts'));
        add_filter('cmtt_glossary_restrict_manage_posts', array(__CLASS__, 'cmttct_restrict_manage_posts'));

        $postType = filter_input(INPUT_GET, 'post_type');

        if ($postType == 'glossary') {
            add_filter('page_row_actions', array(__CLASS__, 'addPostRowAction'), 10, 2);
            add_filter('post_row_actions', array(__CLASS__, 'addPostRowAction'), 10, 2);
            add_filter('manage_posts_columns', array(__CLASS__, 'addEmailColumn'), 10, 2);
        }
    }

    public static function maybeResetLabels($post, $messages) {
        if(!empty($post['cmttct_reset_labels'])) {
            $config = self::config([]);
            foreach ($config['settings'] as $key => $value) {
                CM\CMTT_Settings::set($key, $value);
            }
        }
    }

    public static function getSettings() {
        $settings = CMTooltipCommunityTerms::getMyTermsSettings();

        $roles = new WP_Roles();

        /*
         * Add Anonymous user to the roles array
         */
        $_tmp = array_merge($roles->get_names(), array('anonymous' => 'Anonymous'));
        asort($_tmp);

        $settings['roles'] = $_tmp;

        return $settings;
    }

    public static function config($config) {
        if(!isset($config['settings'])){
            $config['settings'] = [];
        }
        $cmttct_settings = [
            self::COMMUNITYTERMS_OLD_STATUS                      => __('pending', 'cmt_community_terms'),
            self::COMMUNITYTERMS_NEW_STATUS                      => __('publish', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TITLE_TEXT                 => __('Title', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TITLE_PLACEHOLDER          => __('Write terms title', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_DESCRIPTION_TEXT           => __('Description', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_PRIVATE_TEXT               => __('Private term', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_DESCRIPTION_PLACEHOLDER    => __('Write terms description', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_EMAIL_TEXT                 => __('Email', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_EMAIL_PLACEHOLDER, __('Your email', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_CAPTCHA_TEXT               => __('Captcha', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_BUTTON_TEXT                => __('Suggest a term', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_PAGE_ID_TEXT               => __('Suggest a term', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_BUTTON_TEXT_UPDATE         => __('Update a term', 'cmt_community_terms'),
            self::COMMUNITYTERMS_NOTIFICATION_TEXT               => __('New term: [term] has been added to the glossary.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_USER_NOTIFICATION_TEXT          => __('The status of the term: [term] has been changed from [old] to [new].', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_SAVED                  => __('Term has been saved.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_ERROR_TEXT             => __('Wrong title or description.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_ERROR_CAPTCHA          => __('Wrong Captcha.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_MODERATION             => __('Waiting for moderation.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_PUBLISHED              => __('Term is published.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_NO_TERMS               => __('There are no terms to display.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_NOT_ALLOWED_TO_SUGGEST => __('Currently you are not allowed to suggest a new terms. Please contact with page administrator.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_NOT_LOGGED_IN          => __('You need to be logged in to have access to this page.'),
            self::COMMUNITYTERMS_SETTINGS_UPDATED                => __('Term has been updated.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_SETTINGS_EDITING_DISABLED       => __('Editing terms is disabled.'),
            self::COMMUNITYTERMS_SETTINGS_EMPTY_FIELDS           => __('Fields can not be empty.', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TERM_TITLE                 => __('Term title', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TERM_UPDATE                => __('Last update', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TERM_CREATE                => __('Created', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TERM_EDIT                  => __('Edit term', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TERM_DELETE                => __('Delete term', 'cmt_community_terms'),
            self::COMMUNITYTERMS_ALL_SELECTION                   => __('All', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_EXCERPT_TEXT               => __('Excerpt', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_EXCERPT_PLACEHOLDER        => __('Write terms excerpt', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_CATEGORIES_TEXT            => __('Categories', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_CATEGORIES_PLACEHOLDER     => __('Select terms categories', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TAGS_TEXT                  => __('Tags', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_TAGS_PLACEHOLDER           => __('Select terms tags', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_IAMGE_TEXT                 => __('Featured Image', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_IAMGE_PLACEHOLDER          => __('Select the image', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_IAMGE_UPLOAD               => __('Upload', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_IAMGE_UPLOAD_NEW           => __('Upload new', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_IAMGE_VIEW                 => __('View', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_IAMGE_REMOVE               => __('Remove', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_SYNONYMS_TEXT              => __('Synonyms', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_SYNONYMS_PLACEHOLDER       => __('Add terms synonyms', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_VARIATIONS_TEXT            => __('Variations', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_VARIATIONS_PLACEHOLDER     => __('Add terms variations', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_ABBREVIATIONS_TEXT         => __('Abreviations', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_ABBREVIATIONS_PLACEHOLDER  => __('Write terms abbreviations', 'cmt_community_terms'),
            self::COMMUNITYTERMS_FORM_PLEASE_WAIT_TEXT           => __('Please wait', 'cmt_community_terms'),
        ];
        $config['settings'] = array_merge($config['settings'], $cmttct_settings);
        return $config;
    }

    /**
     * Adds the community terms options to the saved options
     * @return string
     */
    public static function addOptionNames($option_names) {
        $option_names = array_merge($option_names, array(
            self::COMMUNITYTERMS_SEARCH_BY_AUTHOR,
            self::COMMUNITYTERMS_CAPTCHA,
            self::COMMUNITYTERMS_CAPTCHA_KEY,
            self::COMMUNITYTERMS_CAPTCHA_PRIVATE_KEY,
            self::COMMUNITYTERMS_MODERATION,
            self::COMMUNITYTERMS_SHOW_MODERATED,
            self::COMMUNITYTERMS_ALLOW_ROLES,
            self::COMMUNITYTERMS_ADMIN_NOTIFICATION,
            self::COMMUNITYTERMS_NOTIFICATION_TEXT,
            self::COMMUNITYTERMS_NOTIFICATION_SUBJECT,
            self::COMMUNITYTERMS_USER_NOTIFICATION,
            self::COMMUNITYTERMS_USER_NOTIFICATION_TEXT,
            self::COMMUNITYTERMS_USER_NOTIFICATION_SUBJECT,
            self::COMMUNITYTERMS_PANEL_NOTIFICATION,
            self::COMMUNITYTERMS_OLD_STATUS,
            self::COMMUNITYTERMS_NEW_STATUS,
            self::COMMUNITYTERMS_FORM_TITLE_TEXT,
            self::COMMUNITYTERMS_FORM_TITLE_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_DESCRIPTION_TEXT,
            self::COMMUNITYTERMS_FORM_PRIVATE_TEXT,
            self::COMMUNITYTERMS_FORM_DESCRIPTION_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_EMAIL_TEXT,
            self::COMMUNITYTERMS_FORM_EMAIL_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_CAPTCHA_TEXT,
            self::COMMUNITYTERMS_FORM_BUTTON_TEXT,
            self::COMMUNITYTERMS_FORM_BUTTON_TEXT_UPDATE,
            self::COMMUNITYTERMS_FORM_PAGE_ID,
            self::COMMUNITYTERMS_FORM_PAGE_ID_TEXT,
            self::COMMUNITYTERMS_SETTINGS_SAVED,
            self::COMMUNITYTERMS_SETTINGS_ERROR_TEXT,
            self::COMMUNITYTERMS_SETTINGS_ERROR_CAPTCHA,
            self::COMMUNITYTERMS_SETTINGS_MODERATION,
            self::COMMUNITYTERMS_SETTINGS_PUBLISHED,
            self::COMMUNITYTERMS_SETTINGS_NO_TERMS,
            self::COMMUNITYTERMS_SETTINGS_NOT_ALLOWED_TO_SUGGEST,
            self::COMMUNITYTERMS_SETTINGS_NOT_LOGGED_IN,
            self::COMMUNITYTERMS_SETTINGS_UPDATED,
            self::COMMUNITYTERMS_SETTINGS_EDITING_DISABLED,
            self::COMMUNITYTERMS_SETTINGS_EMPTY_FIELDS,
            self::COMMUNITYTERMS_FORM_TERM_TITLE,
            self::COMMUNITYTERMS_FORM_TERM_UPDATE,
            self::COMMUNITYTERMS_FORM_TERM_CREATE,
            self::COMMUNITYTERMS_FORM_TERM_EDIT,
            self::COMMUNITYTERMS_FORM_TERM_DELETE,
            self::COMMUNITYTERMS_ALLOW_ANONYMOUS_EMAIL,
            self::COMMUNITYTERMS_DISABLE_WP_EDITOR,
            self::COMMUNITYTERMS_ALLOW_EDIT_TERM,
            self::COMMUNITYTERMS_ALLOW_DELETE_TERM,
            self::COMMUNITYTERMS_ALLOW_PRIVATE_TERM,
            'cmttct_auto_categories',
            /* Star-Rating */
            self::COMMUNITYTERMS_SETTINGS_ENABLE_RATING,
            self::COMMUNITYTERMS_SETTINGS_ENABLE_RATING_NUMERICAL,
            self::COMMUNITYTERMS_SETTINGS_STAR_RATING_LABEL,
            self::COMMUNITYTERMS_SETTINGS_STAR_RATING_DISPLAY_TOP,
            self::COMMUNITYTERMS_SETTINGS_STAR_RATING_DISPLAY_COUNT,
            /*  New Fields */
            self::COMMUNITYTERMS_SHOW_FIELD_EXCERPT,
            self::COMMUNITYTERMS_SHOW_FIELD_CATEGORIES,
            self::COMMUNITYTERMS_SHOW_FIELD_TAGS,
            self::COMMUNITYTERMS_SHOW_FIELD_IMAGE,
            self::COMMUNITYTERMS_SHOW_FIELD_SYNONYMS,
            self::COMMUNITYTERMS_SHOW_FIELD_VARIATIONS,
            self::COMMUNITYTERMS_SHOW_FIELD_ABBREVIATIONS,
            self::COMMUNITYTERMS_ALL_SELECTION,
            self::COMMUNITYTERMS_FORM_EXCERPT_TEXT,
            self::COMMUNITYTERMS_FORM_EXCERPT_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_CATEGORIES_TEXT,
            self::COMMUNITYTERMS_FORM_CATEGORIES_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_TAGS_TEXT,
            self::COMMUNITYTERMS_FORM_TAGS_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_IAMGE_TEXT,
            self::COMMUNITYTERMS_FORM_IAMGE_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_IAMGE_UPLOAD,
            self::COMMUNITYTERMS_FORM_IAMGE_UPLOAD_NEW,
            self::COMMUNITYTERMS_FORM_IAMGE_VIEW,
            self::COMMUNITYTERMS_FORM_IAMGE_REMOVE,
            self::COMMUNITYTERMS_FORM_SYNONYMS_TEXT,
            self::COMMUNITYTERMS_FORM_SYNONYMS_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_VARIATIONS_TEXT,
            self::COMMUNITYTERMS_FORM_VARIATIONS_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_ABBREVIATIONS_TEXT,
            self::COMMUNITYTERMS_FORM_ABBREVIATIONS_PLACEHOLDER,
            self::COMMUNITYTERMS_FORM_PLEASE_WAIT_TEXT,
            self::COMMUNITYTERMS_INDEX_PAGE_AUTHOR_FILTER
                )
        );
        return $option_names;
    }

    private static function getPostCount() {
        $posts = wp_count_posts('glossary');
        return isset($posts->pending) ? $posts->pending : 0;
    }

    public static function preparePanelNotification() {
        $count = self::getPostCount();
        $text = '';

        if ($count) {
            $text = sprintf('
			<div class="updated">
				<p>[<strong>CM Tooltip Community Terms</strong>] <strong>%s</strong> pending %s waiting for the approval. Go to the <a href="' . admin_url() . 'edit.php?s&post_status=pending&post_type=glossary">terms list</a> or <a href="' . admin_url() . 'edit.php?s&post_status=pending&post_type=glossary&cmttct_action=' . CMTooltipCommunityTerms::COMMUNITYTERMS_ACTION_PUBLISH_ALL . '">publish all</a>.</p>
			</div>', $count, ($count > 1 ? 'terms are' : 'term is'));
        }

        $cookie = new Cookie();
        $cookie_data = $cookie->getData();
        if (!empty($cookie_data['msg'])) {
            $text .= '<div class="updated">' . $cookie_data['msg'] . '</div>';
            $cookie->clear();
        }

        self::$panelNotification = $text;
    }

    public static function getPanelNotification() {
        $text = self::$panelNotification;
        echo $text;
    }

    public static function showPanelNotification() {
        self::preparePanelNotification();
        add_action('admin_notices', array(__CLASS__, 'getPanelNotification'));
    }

    public static function registerActions() {
        add_action('manage_posts_custom_column', array(__CLASS__, 'displayEmail'), 10, 2);
        add_action('transition_post_status', array(__CLASS__, 'statusObserver'), 10, 3);
    }

    public static function addPostRowAction($actions, $post) {
        if ($post->post_type == 'glossary' && $post->post_status != 'publish') {
            /*
             * Adding a custom row action used to publish a term
             */
            $actions['publish'] = '<a href=\'' . admin_url('edit.php?cmttct_action=' . CMTooltipCommunityTerms::COMMUNITYTERMS_ACTION_PUBLISH . '&post_id=' . $post->ID) . '\'>Publish</a>';
        }
        return $actions;
    }

    public static function cmttct_restrict_manage_posts($options) {
        $status = '';
        if (!empty($options)) {
            return array_merge($options, array('pending' => 'Pending'));
        } else {
            return '<option value="pending" ' . (( $status == 'pending' ) ? ' selected="selected"' : '') . ' >' . 'Pending' . '</option>';
        }
    }

    public static function publishAll() {
        $pending_posts = get_posts(array('numberposts' => 10000, 'post_status' => 'pending', 'post_type' => 'glossary'));
        if (!empty($pending_posts)) {
            foreach ($pending_posts as $post) {
                self::statusObserver('publish', 'pending', $post);
                wp_update_post(array('ID' => $post->ID, 'post_status' => 'publish'));
            }

            $cookie = new Cookie();
            $cookie->msg = self::COMMUNITYTERMS_PUBLISH_ALL_MSG;
            $cookie->ref = wp_get_referer();
            $cookie->save();

            wp_redirect(wp_get_referer());
            exit;
        }
    }

    public static function publishTerm($post_id) {
        $post = get_post($post_id);
        self::statusObserver('publish', 'pending', $post);
        wp_update_post(array('ID' => $post_id, 'post_status' => 'publish'));

        $cookie = new Cookie();
        $cookie->msg = self::COMMUNITYTERMS_PUBLISH_TERM_MSG;
        $cookie->save();

        wp_redirect(wp_get_referer());
        exit;
    }

    /**
     * Add email column to post list.
     */
    public static function addEmailColumn($columns) {
        return array_merge($columns, array('email' => 'Email'));
    }

    /**
     *  Display email column
     */
    public static function displayEmail($column, $post_id) {
        if ($column == 'email') {
            $post = get_post_custom($post_id);
            if (!empty($post['cmttct_anonymous_email'])) {
                echo $post['cmttct_anonymous_email'][0];
            } else {
                $post = get_post($post_id);
                $user = get_userdata($post->post_author);
                echo $user->user_email;
            }
        }
    }

    public static function statusObserver($new_status, $old_status, $post) {
        if ($post->post_type === 'glossary' && $old_status == 'pending' && $new_status == 'publish') {
            $settings = CMTooltipCommunityTerms::getMyTermsSettings(array(
                        'title'      => $post->post_title,
                        'old_status' => \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_OLD_STATUS, 'pending'),
                        'new_status' => \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_NEW_STATUS, 'publish')
            ));

            if (!empty($settings['user_notification'])) {
                $user = get_user_by('id', $post->post_author);
                $post_meta = get_post_meta($post->ID);

                if (!empty($post_meta["cmttct_anonymous_email"])) {
                    $email = $post_meta["cmttct_anonymous_email"][0];
                } else {
                    $email = $user->user_email;
                }

                /*
                 * Notification
                 */
                $notify = new CMTooltipCommunityTermsNotification();
                $notify->setEmail($email);
                $notify->setNotificationSubject($settings['user_notification_subject']);
                $notify->setContent(!empty($settings['user_notification_text']) ? $settings['user_notification_text'] : self::CMTCT_MYTERMS_USER_NOTIFICATION_DEFAULT_TEXT );

                if (empty($settings['notification_text'])) {
                    $notify->setContentData(array($post->title, $old_status, $new_status));
                }

                $notify->send();
            }
        }
    }

}
