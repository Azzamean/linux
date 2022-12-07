<?php
if (!class_exists('CMTooltipCommunityTerms')) {

    class CMTooltipCommunityTerms {

        const COMMUNITYTERMS_SHORTTAG_PAGE_TITLE = 'Suggest a term';
        const COMMUNITYTERMS_ACTION_PUBLISH_ALL = 'cmttct_publish_all';
        const COMMUNITYTERMS_ACTION_PUBLISH = 'cmttct_publish_term';

        /**
         * instance
         * @var CMTooltipCommunityTerms
         */
        protected static $instance = NULL;

        /**
         * Called class name.
         * @var string
         */
        private static $calledClassName;

        /**
         * Singleton
         * @return CMTooltipCommunityTerms
         */
        static public function getInstance() {
            if (empty(self::$instance)) {
                self::$instance = new CMTooltipCommunityTerms();
            } else {
                return self::$instance;
            }
        }

        /**
         * Actions executing on plugin activation.
         */
        static public function activate() {
            self::install();
        }

        /**
         * Safe wrapper for Settings
         * @param type $key
         * @param type $default
         * @return type
         */
        public static function get($key, $default = '') {
            $result = '';
            /*
             * Only for Tooltip 4.0.0+
             */
            if (class_exists('\CM\CMTT_Settings')) {
                $result = \CM\CMTT_Settings::get($key, $default);
            } else {
                $result = get_option($key, $default);
            }
            return $result;
        }

        /**
         * Display Terms Shortcodes Description
         * @since v1.1.5
         * */
        public static function displayShortcodesDesc() {
            $CMTCTshortcodes = '';
            if (class_exists('CMTooltipCommunityTerms')) {
                $CMTCTshortcodes .= '<li><strong>Community Terms Dashboard</strong> - [' . CMTooltipCommunityTermsDashboardFrontend::COMMUNITYTERMS_SHORT_CODE . ']</li>';

                if (class_exists('CMTooltipCommunityTermsFrontend')) {
                    $CMTCTshortcodes .= '<li><strong>Suggest a Term</strong> - [' . CMTooltipCommunityTermsFrontend::COMMUNITYTERMS_SHORT_CODE . ']';
                }
            }

            echo $CMTCTshortcodes;
        }

        /**
         * Construct the plugin object
         */
        public function __construct() {
            global $cmtct_isLicenseOk;

            // register init action
            add_action('admin_init', array(__CLASS__, 'checkForBase'));

            add_action('cmtt_glossary_supported_shortcodes', array(__CLASS__, 'displayShortcodesDesc'));

            // register init hook
            add_action('init', array(__CLASS__, 'init'));

            if ($cmtct_isLicenseOk) {
                if (!is_admin()) {
                    // register scripts
                    CMTooltipCommunityTermsFrontend::registerScripts();
                }
                // register add form shortcode
                CMTooltipCommunityTermsFrontend::registerShortCode();

                // register ajax
                CMTooltipCommunityTermsFrontend::registerAjax();
            }

            // register filter actions
            CMTooltipCommunityTermsFrontend::registerFilterActions();

            // New Tab for myTerms option
            add_filter('cmtt-settings-tabs-array', array(__CLASS__, 'addSettingsTab'));

            // Move plugin to be executed in the end
            if (!empty($_GET['page']) && strstr($_GET['page'], "cmtt_settings")) {
                CMTooltipCommunityTerms::putMeOnEnd();
            }
        }

        /**
         * Initialize some actions.
         */
        public static function init() {

            // Saving form when POST vars exists
            // CMTooltipCommunityTermsFrontend::handlePost();

            if (is_admin()) {

                $anonymous = username_exists('TooltipAnonymousUser');
                $isAnonymousSecured = CMTooltipCommunityTerms::get('cmttct_anonymous_user_secured', FALSE);
                if (!empty($anonymous) && $isAnonymousSecured < 2) {
                    wp_update_user(array(
                        'ID'         => $anonymous,
                        'user_login' => 'TooltipAnonymousUser',
                        'user_pass'  => md5(mt_rand()),
                    ));
                    CM\CMTT_Settings::set('cmttct_anonymous_user_secured', 2);
                }

                if (is_user_logged_in()) {
                    if (!empty($_GET['cmttct_action'])) {
                        self::doAction($_GET['cmttct_action']);
                    }
                }

                $settings = CMTooltipCommunityTerms::getMyTermsSettings();
                if (!empty($settings['panel_notification'])) {
                    CMTooltipCommunityTermsBackend::showPanelNotification();
                }
            }
            
            // Register backend actions
            CMTooltipCommunityTermsBackend::registerFilterActions();

            // Adding a hook for search by author option in Glossary Index Page
            add_filter('cmtt_search_form_options', array(__CLASS__, 'addSearchOption'), 10, 1);

            add_filter('cmtt_search_where_arr', array(__CLASS__, 'searchByAuthor'), 10, 4);
        }

        /**
         * Check if base plugin is instaled.
         */
        public static function checkForBase() {
            if (!defined('CMTT_NAME')) {
                add_action('admin_notices', array(__CLASS__, '__showProMessage'));
            }
        }

        /**
         * Shows the message about Pro versions on activate
         */
        public static function __showProMessage() {
            /*
             * Only show to admins
             */
            if (current_user_can('manage_options')) {
                ?>
                <div id="message" class="updated fade">
                    <p>
                        <strong>&quot;<?php echo CMTCT_NAME ?>&quot;</strong> plugin requires <strong>&quot; CM Tooltip Glossary &quot;</strong> plugin to be activated! <br/>
                        <i>For more information about extending &quot; CM Tooltip Glossary &quot; please visit <a href="http://tooltip.cminds.com/"  target="_blank"> this page.</a></i>
                    </p>
                </div>
                <?php
                delete_option('cmtt_afterActivation');
            }
        }

        /**
         * Move plugin to the end of plugins execution list.
         */
        public static function putMeOnEnd() {
            $plugin_list = get_option('active_plugins');
            $me = plugin_basename(constant('CMTCT_PLUGIN_FILE'));
            $my_plugin_position = array_search($me, $plugin_list);

            if ($my_plugin_position) {
                array_splice($plugin_list, $my_plugin_position, 1);
                array_push($plugin_list, $me);
                update_option('active_plugins', $plugin_list);
            }
        }

        /**
         * Load html for given view
         *
         * @param unknown $view
         * @param string $html
         * @return string
         */
        public static function loadView($view, $data = null, $html = false) {
            $content = '';
            ob_start();
            if (!empty($data)) {
                extract($data);
            }
            if (!file_exists(CMTCT_PLUGIN_DIR_VIEWS_PATH . $view)) {
                throw new Exception('View file does not exist');
            } else {
                include CMTCT_PLUGIN_DIR_VIEWS_PATH . $view;
            }
            $content .= ob_get_clean();

            if ($html) {
                return $content;
            } else {
                echo $content;
            }
        }

        /**
         * Install needed elments of the plugin.
         */
        private static function install() {
            // Add anonymous user to bind not logged users terms
            $anonymous = username_exists('TooltipAnonymousUser');
            if (empty($anonymous)) {
                $id = wp_insert_user(array(
                    'user_login'    => 'TooltipAnonymousUser',
                    'user_pass'     => md5(mt_rand()),
                    'user_nickname' => 'Tooltip Anonymous Users',
                    'role'          => 'editor'
                ));

                if (is_int($id)) {
                    add_option('cmttct_TooltipAnonymousUserId', $id);
                }
            }

            $page = get_page_by_title(self::COMMUNITYTERMS_SHORTTAG_PAGE_TITLE);
            $page2 = get_page(CMTooltipCommunityTerms::get('cmttct_form_page_id'));
            if (empty($page) && empty($page2)) {
                // Add page with short tag
                $post = array(
                    'post_type'    => 'page',
                    'post_content' => '[' . CMTooltipCommunityTermsFrontend::COMMUNITYTERMS_SHORT_CODE . ']', // The full text of the post.
                    'post_name'    => self::COMMUNITYTERMS_SHORTTAG_PAGE_TITLE, // The name (slug) for your post
                    'post_title'   => self::COMMUNITYTERMS_SHORTTAG_PAGE_TITLE, // The title of your post.
                    'post_status'  => 'publish',
                    'post_author'  => get_current_user_id()
                );
                $post_id = wp_insert_post($post);

                /*
                 * Update form page_id
                 */
                CM\CMTT_Settings::set(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PAGE_ID, $post_id);
            }
        }

        /**
         * Add new Tooltip configuration tab
         *
         * @return type
         */
        public static function addSettingsTab($tabs) {
            if (!in_array('SKINS', $tabs)) {
                $tabs += array('10' => 'Community Terms');
            }
            add_filter('cmtt-custom-settings-tab-content-10', array(__CLASS__, 'addSettingsTabContent'));
            /*
             * Legacy
             */
            add_filter('cmmt-custom-settings-tab-content-10', array(__CLASS__, 'addSettingsTabContent'));

            return $tabs;
        }

        /**
         * Adds the content to the appropriate settings tab
         * @return type
         */
        public static function addSettingsTabContent($content) {
            ob_start();

            $data = CMTooltipCommunityTermsBackend::getSettings();
            extract($data);

            require_once CMTCT_PLUGIN_DIR_VIEWS_PATH . 'backend/myTerms_settings.php';
            $content .= ob_get_contents();
            ob_end_clean();

            return $content;
        }

        public static function getDefaultValue($option) {
            $value = false;

            switch ($option) {
                case CMTooltipCommunityTermsBackend::COMMUNITYTERMS_NOTIFICATION_TEXT:
                    $value = 'New term: [term] has been added to the glossary.';
                    break;
                case CMTooltipCommunityTermsBackend::COMMUNITYTERMS_USER_NOTIFICATION_TEXT:
                    $value = 'The status of the term: [term] has been changed from [old] to [new].';
                    break;
                default:
                    $value = false;
                    break;
            }

            return $value;
        }

        public static function getMyTermsSettings($data = array()) {
            $notification_text = CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_NOTIFICATION_TEXT, self::getDefaultValue(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_NOTIFICATION_TEXT));
            $user_notification_text = CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_USER_NOTIFICATION_TEXT, self::getDefaultValue(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_USER_NOTIFICATION_TEXT));

            $data = array(
                'captcha'                             => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_CAPTCHA),
                'captcha_key'                         => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_CAPTCHA_KEY),
                'captcha_private_key'                 => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_CAPTCHA_PRIVATE_KEY),
                'moderation'                          => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_MODERATION),
                'allow_roles'                         => (array) CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_ROLES),
                'notification'                        => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ADMIN_NOTIFICATION),
                'notification_text'                   => (!empty($data['title']) && strstr($notification_text, CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_TERM)) ? str_replace(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_TERM, $data['title'], $notification_text) : $notification_text,
                'notification_subject'                => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_NOTIFICATION_SUBJECT),
                'user_notification'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_USER_NOTIFICATION),
                'user_notification_text'              => self::_prepareUserNotification($data, $user_notification_text),
                'user_notification_subject'           => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_USER_NOTIFICATION_SUBJECT),
                'panel_notification'                  => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_PANEL_NOTIFICATION),
                'form_title_text'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TITLE_TEXT),
                'form_title_placeholder'              => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TITLE_PLACEHOLDER),
                'form_description_text'               => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_DESCRIPTION_TEXT),
                'form_private_text'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PRIVATE_TEXT),
                'form_description_placeholder'        => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_DESCRIPTION_PLACEHOLDER),
                'form_email_text'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_EMAIL_TEXT),
                'form_email_placeholder'              => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_EMAIL_PLACEHOLDER),
                'form_captcha_text'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_CAPTCHA_TEXT),
                'form_button_text'                    => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_BUTTON_TEXT),
                'form_button_text_update'             => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_BUTTON_TEXT_UPDATE),
                'form_page_id'                        => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PAGE_ID),
                'form_page_id_text'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PAGE_ID_TEXT),
                'cmttct_settings_saved'               => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_SAVED),
                'cmttct_settings_moderation'          => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_MODERATION),
                'cmttct_settings_published'           => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_PUBLISHED),
                'cmttct_settings_no_terms'            => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_NO_TERMS),
                'cmttct_settings_not_allowed_suggest' => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_NOT_ALLOWED_TO_SUGGEST),
                'cmttct_settings_not_logged_in'       => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_NOT_LOGGED_IN),
                'cmttct_settings_error_text'          => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_ERROR_TEXT),
                'cmttct_settings_error_captcha_text'  => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_ERROR_CAPTCHA),
                'cmttct_settings_updated'             => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_UPDATED),
                'cmttct_settings_empty_fields'        => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_EMPTY_FIELDS),
                'cmttct_settings_editing_disabled'    => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_EDITING_DISABLED),
                'anonymous_email_permit'              => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_ANONYMOUS_EMAIL),
                'disable_wp_editor'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_DISABLE_WP_EDITOR),
                'allow_edit_term'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_EDIT_TERM),
                'allow_delete_term'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_DELETE_TERM),
                'allow_private_term'                  => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_PRIVATE_TERM),
                'form_term_title'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_TITLE),
                'form_term_update'                    => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_UPDATE),
                'form_term_create'                    => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_CREATE),
                'form_term_edit'                      => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_EDIT),
                'form_term_delete'                    => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TERM_DELETE),
                /* Star-Rating */
                'cmttct_star_rating'                  => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_ENABLE_RATING),
                'cmttct_star_rating_numerical'        => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_ENABLE_RATING_NUMERICAL),
                'cmttct_star_rating_label'            => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_STAR_RATING_LABEL),
                'cmttct_star_rating_display_top'      => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_STAR_RATING_DISPLAY_TOP),
                'cmttct_star_rating_display_count'    => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SETTINGS_STAR_RATING_DISPLAY_COUNT),
                /* New fields */
                'form_show_field_excerpt'             => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_FIELD_EXCERPT),
                'form_show_field_categories'          => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_FIELD_CATEGORIES),
                'form_show_field_tags'                => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_FIELD_TAGS),
                'form_show_field_image'               => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_FIELD_IMAGE),
                'form_show_field_synonyms'            => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_FIELD_SYNONYMS),
                'form_show_field_variations'          => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_FIELD_VARIATIONS),
                'form_show_field_abbreviations'       => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_SHOW_FIELD_ABBREVIATIONS),
                'form_excerpt_text'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_EXCERPT_TEXT),
                'all_selection_text'                  => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALL_SELECTION),
                'form_excerpt_placeholder'            => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_EXCERPT_PLACEHOLDER),
                'form_categories_text'                => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_CATEGORIES_TEXT),
                'form_categories_placeholder'         => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_CATEGORIES_PLACEHOLDER),
                'form_tags_text'                      => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TAGS_TEXT),
                'form_tags_placeholder'               => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_TAGS_PLACEHOLDER),
                'form_image_text'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_IAMGE_TEXT),
                'form_image_placeholder'              => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_IAMGE_PLACEHOLDER),
                'form_image_upload'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_IAMGE_UPLOAD),
                'form_image_upload_new'               => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_IAMGE_UPLOAD_NEW),
                'form_image_view'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_IAMGE_VIEW),
                'form_image_remove'                   => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_IAMGE_REMOVE),
                'form_synonyms_text'                  => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_SYNONYMS_TEXT),
                'form_synonyms_placeholder'           => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_SYNONYMS_PLACEHOLDER),
                'form_variations_text'                => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_VARIATIONS_TEXT),
                'form_variations_placeholder'         => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_VARIATIONS_PLACEHOLDER),
                'form_abbreviations_text'             => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_ABBREVIATIONS_TEXT),
                'form_abbreviations_placeholder'      => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_ABBREVIATIONS_PLACEHOLDER),
                'form_old_status'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_OLD_STATUS),
                'form_new_status'                     => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_NEW_STATUS),
                'form_please_wait_text'               => CMTooltipCommunityTerms::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PLEASE_WAIT_TEXT, 'Please wait'),
            );

            if ($data['captcha']) {
                CMTCT_Recaptcha::init();
            }

            return $data;
        }

        /**
         * Prepare user notification text send by email.
         *
         * @param array $data
         * @param string $user_notification_text
         * @return mixed
         */
        private static function _prepareUserNotification($data, $user_notification_text) {
            if (!empty($data['title']) && strstr($user_notification_text, CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_TERM)) {
                $user_notification_text = str_replace(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_TERM, $data['title'], $user_notification_text);
            }

            if (!empty($data['old_status']) && strstr($user_notification_text, CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_POST_OLD_STATUS)) {
                $user_notification_text = str_replace(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_POST_OLD_STATUS, $data['old_status'], $user_notification_text);
            }

            if (!empty($data['new_status']) && strstr($user_notification_text, CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_POST_NEW_STATUS)) {
                $user_notification_text = str_replace(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG_POST_NEW_STATUS, $data['new_status'], $user_notification_text);
            }

            return $user_notification_text;
        }

        public static function doAction($action) {
            if (!empty($action)) {
                switch ($action) {
                    case self::COMMUNITYTERMS_ACTION_PUBLISH_ALL: CMTooltipCommunityTermsBackend::publishAll();
                        break;
                    case self::COMMUNITYTERMS_ACTION_PUBLISH : CMTooltipCommunityTermsBackend::publishTerm($_GET['post_id']);
                        break;
                }

                wp_redirect('edit.php?post_type=glossary');
                exit;
            }
        }

        public static function addSearchOption($search_options) {
            $search_options += array(
                3 => 'Author'
            );
            return $search_options;
        }

        public static function searchByAuthor($whereArr, $term, $wp_query, $checkbox) {
            global $wpdb;

            foreach ($checkbox as $checked) {
                if ($checked == '3') {
                    $termAuthor = $wpdb->get_results("SELECT ID FROM $wpdb->users WHERE display_name LIKE '%$term%'");
                    foreach ($termAuthor as $author) {
                        $whereArr[] = $wpdb->posts . '.post_author LIKE "%' . $author->ID . '%"';
                    }
                }
            }
            return $whereArr;
        }

    }

}
