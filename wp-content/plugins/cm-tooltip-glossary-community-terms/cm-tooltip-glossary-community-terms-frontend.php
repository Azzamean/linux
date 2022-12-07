<?php

use com\cminds\wp\common\upload_helper\v_1_0_2\controller\UploadController;
use com\cminds\wp\common\upload_helper\v_1_0_2\model\Attachment;

class CMTooltipCommunityTermsFrontend {

    const CMTCT_MYTERMS_META_KEY = 'cmttct_anonymous_email';
    const CMTCT_MYTERMS_NOTIFICATION_DEFAULT_TEXT = 'A user %s have added a new term "%s" to the Tooltip Glossary.';
    const COMMUNITYTERMS_EMAIL_NOTIFICATION_TAG = '[term]';
    const COMMUNITYTERMS_SHORT_CODE = 'community_terms_form';

    /**
     *
     * @var UploadController
     */
    static public $upload;

    /**
     * Register shortcode.
     */
    public static function registerShortCode() {
        add_shortcode(self::COMMUNITYTERMS_SHORT_CODE, array(__CLASS__, 'loadMyTermsForm'));
    }

    /**
     * Register ajax method
     *
     */
    public static function registerAjax() {
        add_action('wp_ajax_handlePost', array(__CLASS__, 'handlePost'));
        add_action('wp_ajax_cmtt_handle_post', array(__CLASS__, 'handlePost'));
        add_action('wp_ajax_nopriv_cmtt_handle_post', array(__CLASS__, 'handlePost'));

        $data = CMTooltipCommunityTerms::getMyTermsSettings();
        $labels = array(
            'upload'     => $data['form_image_upload'],
            'upload_new' => $data['form_image_upload_new'],
            'view'       => $data['form_image_view'],
            'remove'     => $data['form_image_remove'],
        );
        static::$upload = new UploadController(CMTCT_PLUGIN_FILE, CMTCT_PLUGIN_PREFIX);
        static::$upload->setFieldName('communityTerms_image');
        static::$upload->setLabels($labels);
        static::$upload->setupAjaxHandler();
    }

    public static function registerFilterActions() {
        add_filter('cmtt_glossary_term_after_content', array(__CLASS__, 'addLinkToForm'), 5, 2);
        add_filter('cmtt_glossary_index_before_listnav_content', array(__CLASS__, 'addLinkToForm'), 5, 3);
    }

    public static function addLinkToForm($content) {
        $link = '';
        $page_id = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PAGE_ID);

        $data = self::checkAllowAddTerms(CMTooltipCommunityTerms::getMyTermsSettings());

        if (!empty($page_id) && $data['allowAddTerms']) {
            $link = '<div id="communityTerms_suggest_button_wrapper"><a class="btn btn-default" style="margin-top: 5px;" href="' . get_permalink($page_id) . '">' . \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PAGE_ID_TEXT) . '</a></div>';
        }

        return $link . $content;
    }

    /**
     * Show myTerms form.
     *
     * @return string
     */
    public static function loadMyTermsForm($atts = array()) {

        $atts = shortcode_atts(array('category' => FALSE), $atts, self::COMMUNITYTERMS_SHORT_CODE);

        $data = CMTooltipCommunityTerms::getMyTermsSettings();
        $data['loggedIn'] = false;
        $data['allowAddTerms'] = false;
        $data = self::checkAllowAddTerms($data);
        $data['editor_settings'] = array(
            'media_buttons' => false,
            'textarea_name' => 'cmtct[description]',
            'teeny'         => true,
        );
        $data['editor_settings_excerpt'] = array(
            'media_buttons' => false,
            'textarea_name' => 'cmtct[description]',
            'teeny'         => true,
        );

        if (isset($_GET['term_id'])) {
            $post = get_post($_GET['term_id']);

            $data['term_id'] = $post->ID;
            $data['form_title_value'] = $post->post_title;
            $data['form_title_placeholder'] = $post->post_title;
            $data['form_description_placeholder'] = $post->post_content;
            $data['form_excerpt_placeholder'] = $post->post_excerpt;

            $data['form_page_id_text'] = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_PAGE_ID_TEXT);
            $data['form_button_text'] = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_BUTTON_TEXT_UPDATE);
            $data['form_update_button_text'] = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_FORM_BUTTON_TEXT_UPDATE);
            /*
             * TODO: Load the values of the fields when edit
             */
            $data['form_synonyms_value'] = get_post_meta($post->ID, 'cmtt_synonyms', true);
            $data['form_variations_value'] = get_post_meta($post->ID, 'cmtt_variations', true);
            $data['form_abbreviations_value'] = get_post_meta($post->ID, 'cmtt_abbreviations', true);
            $data['form_is_private'] = get_post_meta($post->ID, 'cmtt_private', true);
        }

        // Add category
        $data['category'] = $atts['category'];

        if (!empty($_GET['cminds_debug'])) {
            var_dump($data);

            ob_start();
            ?>
            Testing ob_start();
            <?php
            echo ob_get_clean();
        }

        return CMTooltipCommunityTerms::loadView('frontend' . DIRECTORY_SEPARATOR . 'cmttct_form.php', array('data' => $data), true);
    }

    public static function checkAllowAddTerms($data) {
        // Is logged in user
        if (is_user_logged_in()) {
            $user = get_userdata(get_current_user_id());
            $data['user_id'] = $user->ID;
            $data['loggedIn'] = true;

            // Check who can add terms when users is logged in
            $data['allowAddTerms'] = self::checkRoles($user->roles, $data['allow_roles']);
        } else {
            // Check if anonymous user can add terms
            $data['allowAddTerms'] = self::checkRoles(array('anonymous', 'Anonymous'), $data['allow_roles']);
        }

        return $data;
    }

    /**
     * Register JS & CSS scripts.
     */
    public static function enqueueScripts() {
        // Register and enqueue validation script
        // 		wp_register_script('jquery-validation-plugin', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js', array('jquery'));
        // 		wp_enqueue_script('jquery-validation-plugin');
        wp_register_script('myterms_js', CMTCT_PLUGIN_DIR_FRONTEND_SCRIPT_PATH . 'js/myTerms.js', array('jquery'));
        wp_enqueue_script('myterms_js');

        self::insert_php_js();

        // Style for form
        wp_enqueue_style('myTerms-css', CMTCT_PLUGIN_DIR_FRONTEND_SCRIPT_PATH . 'css/myTerms.css');
        // wp_enqueue_style('bootstrap-css', CMTCT_PLUGIN_DIR_FRONTEND_SCRIPT_PATH . 'css/bootstrap.min.css');
    }

    /**
     * Register enqueue script action.
     */
    public static function registerScripts() {
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueueScripts'));
    }

    public static function handlePost() {
        if (!empty($_POST['cmtct'])) {
            $data = $_POST['cmtct'];
            $validate_captcha = false;
            $valid_captcha = false;

            $settings = CMTooltipCommunityTerms::getMyTermsSettings($data);

            $user = wp_get_current_user();
            $email = $user->user_email;

            if (!empty($settings['captcha'])) {
                $validate_captcha = true;
                $private_key = \CM\CMTT_Settings::get(CMTooltipCommunityTermsBackend::COMMUNITYTERMS_CAPTCHA_PRIVATE_KEY);
                if (empty($private_key)) {
                    wp_send_json(array('status' => 'warning', 'code' => 1, 'msg' => __('Captcha enabled but the key was invalid. Please contact the administrator.', 'cmt_community_terms')));
                    exit;
                }

                $captcha = CMTCT_Recaptcha::verify($data["recaptcha_response_field"]);
                $valid_captcha = $captcha;
            }

            if (0 == $settings['anonymous_email_permit'] && !isset($data['email']) && empty($data['logged_in'])) {
                wp_send_json(array('status' => 'warning', 'code' => 1, 'msg' => __('Please enter e-mail address.', 'cmt_community_terms')));
                exit;
            }

            // Update term
            if (!empty($data['term_id'])) {
                if (!empty($data['title']) && !empty($data['description'])) {
                    $checkEditing = \CM\CMTT_Settings::get('cmttct_allow_edit_term');

                    if ($checkEditing) {
                        $post = array(
                            'ID'           => $data['term_id'],
                            'post_title'   => $data['title'],
                            'post_content' => $data['description'],
                            'post_excerpt' => $data['excerpt'],
                                // TODO: Add the new fields
                        );

                        $update_post = wp_update_post($post);

                        if (!empty($data['categories'])) {
                            wp_set_object_terms($data['term_id'], $data['categories'], 'glossary-categories');
                        }
                        $autoCategories = CM\CMTT_Settings::get('cmttct_auto_categories', []);
                        if (!empty($autoCategories)) {
                            $autoCategoriesIds = array();
                            foreach ($autoCategories as $number) {
                                $autoCategoriesIds[] = (int) $number;
                            }
                            wp_set_object_terms($data['term_id'], $autoCategoriesIds, 'glossary-categories', true);
                        }
                        if (!empty($data['tags'])) {
                            wp_set_object_terms($data['term_id'], $data['tags'], 'glossary-tags');
                        }
                        if (!empty($data['synonyms'])) {
                            update_post_meta($data['term_id'], 'cmtt_synonyms', $data['synonyms']);
                        }
                        if (!empty($data['variations'])) {
                            update_post_meta($data['term_id'], 'cmtt_variations', $data['variations']);
                        }
                        if (!empty($data['abbreviations'])) {
                            update_post_meta($data['term_id'], 'cmtt_abbreviations', $data['abbreviations']);
                        }
                        if (isset($data['private'])) {
                            update_post_meta($data['term_id'], 'cmtt_private', $data['private']);
                        }
                        if (!empty($data['image'])) {
                            $image_id = reset(array_filter(explode(',', $data['image'])));
                            set_post_thumbnail($data['term_id'], $image_id);
                        }

                        $uploaddir = wp_upload_dir();
                        $file = $_FILES['communityTerms_image'];
                        if (!empty($file)) {
                            $uploadfile = $uploaddir['path'] . '/' . basename($file);

                            move_uploaded_file($file, $uploadfile);
                            $filename = basename($uploadfile);

                            $wp_filetype = wp_check_filetype(basename($filename), null);

                            $attachment = array(
                                'post_mime_type' => $wp_filetype['type'],
                                'post_title'     => preg_replace('/\.[^.]+$/', '', $filename),
                                'post_content'   => '',
                                'post_status'    => 'inherit',
                                'menu_order'     => $_i + 1000
                            );
                            $attach_id = wp_insert_attachment($attachment, $uploadfile);
                            set_post_thumbnail($data['term_id'], $attach_id);
                        }

                        // notification: term updated
                        wp_send_json(array('status' => 'success', 'code' => 2, 'msg' => __('Term has been updated.', 'text-cmt_community_terms'),));
                    } else {
                        // notification: editing is not allowed
                        wp_send_json(array('status' => 'warning', 'code' => 1, 'msg' => __('Editing terms is not allowed.', 'cmt_community_terms')));
                    }// if editing allowed
                } else {
                    // notification: title or description are empty
                    wp_send_json(array('status' => 'warning', 'code' => 1, 'msg' => __($settings['cmttct_settings_error_text'], 'Wrong title or description.'), 'cmt_community_terms'));
                }// if fields filed
            } else {
                if (($validate_captcha && $valid_captcha) || !$validate_captcha) {
                    if (!empty($data['title']) && !empty($data['description'])) {
                        // Prepare new post (term) data
                        $post = array(
                            'post_type'    => 'glossary',
                            'post_content' => $data['description'], // The full text of the post.
                            'post_excerpt' => (!empty($data['excerpt']) ? $data['excerpt'] : ''),
                            'post_name'    => $data['title'], // The name (slug) for your post
                            'post_title'   => $data['title'], // The title of your post.
                            'post_status'  => !empty($settings['moderation']) ? 'pending' : 'publish',
                            'post_author'  => (!empty($data['user_id']) ? $data['user_id'] : \CM\CMTT_Settings::get('cmttct_TooltipAnonymousUserId'))
                                // TODO: Add the new fields
                        );

                        $post_id = wp_insert_post($post);
                        if ($post_id && !is_user_logged_in() && $data['email']) {
                            self::saveAnonymousEmail($data['email'], $post_id);
                            $email = $data['email'];
                        }

                        if (!empty($data['categories']) && $data['categories'] !== 'all') {
                            wp_set_object_terms($post_id, $data['categories'], 'glossary-categories');
                        }
                        if (!empty($data['tags'])) {
                            wp_set_object_terms($post_id, $data['tags'], 'glossary-tags');
                        }
                        $autoCategories = CM\CMTT_Settings::get('cmttct_auto_categories', []);
                        if (!empty($autoCategories)) {
                            $autoCategoriesIds = array();
                            foreach ($autoCategories as $number) {
                                $autoCategoriesIds[] = (int) $number;
                            }
                            wp_set_object_terms($post_id, $autoCategoriesIds, 'glossary-categories', true);
                        }
                        if (!empty($data['synonyms'])) {
                            update_post_meta($post_id, 'cmtt_synonyms', $data['synonyms']);
                        }
                        if (!empty($data['variations'])) {
                            update_post_meta($post_id, 'cmtt_variations', $data['variations']);
                        }
                        if (!empty($data['abbreviations'])) {
                            update_post_meta($post_id, 'cmtt_abbreviations', $data['abbreviations']);
                        }

                        if (!empty($data['private'])) {
                            update_post_meta($data['term_id'], 'cmtt_private', $data['private']);
                        }

                        if (!empty($data['image'])) {
                            $image_id = reset(array_filter(explode(',', $data['image'])));
                            set_post_thumbnail($post_id, $image_id);
                        }

                        $uploaddir = wp_upload_dir();
                        $file = $_FILES['communityTerms_image'];
                        if (!empty($file)) {
                            $uploadfile = $uploaddir['path'] . '/' . basename($file);

                            move_uploaded_file($file, $uploadfile);
                            $filename = basename($uploadfile);

                            $wp_filetype = wp_check_filetype(basename($filename), null);

                            $attachment = array(
                                'post_mime_type' => $wp_filetype['type'],
                                'post_title'     => preg_replace('/\.[^.]+$/', '', $filename),
                                'post_content'   => '',
                                'post_status'    => 'inherit',
                                'menu_order'     => $_i + 1000
                            );
                            $attach_id = wp_insert_attachment($attachment, $uploadfile);
                            set_post_thumbnail($data['term_id'], $attach_id);
                        }

                        // Notification
                        if (!empty($settings['notification'])) {
                            $notify = new CMTooltipCommunityTermsNotification();
                            $notify->setNotificationSubject($settings['notification_subject']);
                            $notify->setEmail($email);
                            $notify->setContent(!empty($settings['notification_text']) ? $settings['notification_text'] : self::CMTCT_MYTERMS_NOTIFICATION_DEFAULT_TEXT );

                            // Used by default notification text
                            if (empty($settings['notification_text'])) {
                                $notify->setContentData(array($user->user_login, $data['title']));
                            }

                            $notify->send();
                        }
                    } else {
                        wp_send_json(array('status' => 'warning', 'code' => 1, 'msg' => __('Wrong title or description.', 'cmt_community_terms')));
                    }

                    wp_send_json(array('status' => 'success', 'code' => 2, 'msg' => __($settings['cmttct_settings_saved'], 'cmt_community_terms') . (!empty($settings['moderation']) ? ' ' . __($settings['cmttct_settings_moderation'], 'cmt_community_terms') : ' ' . __($settings['cmttct_settings_published'], 'cmt_community_terms'))));
                } else {
                    $message = __('Wrong Captcha.', 'cmt_community_terms');
                    if (!empty($_GET['cminds_debug']) && $_GET['cminds_debug'] == sha1('4219d660d5c48fce07c3779327eb925a72e3a9f6')) {
                        $message .= CMTCT_Recaptcha::$response;
                    }
                    wp_send_json(array('status' => 'warning', 'code' => 1, 'msg' => $message));
                }
            } // insert/update
        }
    }

    /**
     * Check if given roles can add term.
     *
     * @param array $usersRoles
     * @param array $allowRoles
     * @return boolean
     */
    private static function checkRoles($usersRoles, $allowRoles) {
        $allow = false;

        if ($usersRoles && $allowRoles) {
            foreach ($usersRoles as $role) {
                if (in_array($role, $allowRoles)) {
                    $allow = true;
                }
            }
        }

        return $allow;
    }

    /**
     * Localize (add options) the JS script
     */
    public static function insert_php_js() {
        $data = array();
        $data['ajaxurl'] = admin_url('admin-ajax.php');

        wp_localize_script('myterms_js', 'cmttct_data', $data);
    }

    /**
     * Saving anonymous user email
     *
     * @param unknown $email
     * @param unknown $post_id
     */
    public static function saveAnonymousEmail($email, $post_id) {
        add_post_meta($post_id, self::CMTCT_MYTERMS_META_KEY, $email);
    }

}
