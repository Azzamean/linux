<?php

namespace com\cminds\wp\common\upload_helper\v_1_0_2\controller;

use com\cminds\wp\common\upload_helper\v_1_0_2\model\Attachment;
use com\cminds\wp\common\upload_helper\v_1_0_2\model\AttachmentImage;

/**
 *
 *
 */
class UploadController extends BaseController {

    protected $uploadDir;
    protected $fieldName;
    protected $labels = [
        'upload' => 'Upload',
        'upload_new' => 'Upload new',
        'view' => 'View',
        'remove' => 'Remove',
    ];

    function __construct($pluginFile, $pluginPrefix) {
        parent::__construct($pluginFile, $pluginPrefix);
        $this->setUploadDir($pluginPrefix . DIRECTORY_SEPARATOR . 'media');
    }

    function setUploadDir($uploadDir) {
        $this->uploadDir = $uploadDir;
        return $this;
    }

    function setFieldName($fieldName) {
        $this->fieldName = $fieldName;
        return $this;
    }

    function setLabels($labels) {
        $this->labels = $labels;
        return $this;
    }

    function getEditView(array $attachmentsIds, $allowedFiles = null) {
        $this->embedAssets();
        $fieldName = $this->fieldName;
        $pluginPrefix = $this->pluginPrefix;
        $labels = $this->labels;
        $nonce = wp_create_nonce($this->getAjaxAction());
        $attachmentIds = (!empty($attachmentsIds) ? Attachment::getAll(array('include' => $attachmentsIds)) : array());
        $defaultIcon = $this->url('asset/img/file-icon.png');
        $attachments = array();
        return $this->loadView($this->getEditViewPath(), compact('labels', 'fieldName', 'nonce', 'pluginPrefix', 'attachments', 'defaultIcon', 'attachmentIds', 'allowedFiles'));
    }

    function setupAjaxHandler($public = false) {
        $ajaxAction = $this->getAjaxAction();
        add_action('wp_ajax_' . $ajaxAction, array($this, 'ajaxHandler'));
        if ($public) {
            add_action('wp_ajax_nopriv_' . $ajaxAction, array($this, 'ajaxHandler'));
        }
    }

    function ajaxHandler() {
        $response = array('success' => false, 'msg' => $this->__('An error occurred.'));
        $nonce = filter_input(INPUT_POST, 'nonce');
        if (wp_verify_nonce($nonce, $this->getAjaxAction())) {

            foreach ($_FILES as $file) {
                try {

                    $filePath = Attachment::upload($file, $this->uploadDir);

                    $parentPostId = 0;
                    $fileId = Attachment::create($filePath, $file['type'], $parentPostId);
                    $attachment = Attachment::getInstance($fileId);

                    $result = array('id' => $fileId, 'url' => $attachment->getUrl());
                    if ($attachment->isImage() AND $image = AttachmentImage::getInstance($fileId)) {
                        $result['thumb'] = $image->getImageUrl(Attachment::IMAGE_SIZE_THUMB);
                        $result['imageUrl'] = $image->getImageUrl();
                    }

                    $response['files'][] = $result;
                } catch (\Exception $e) {
                    $response['msg'] = $this->__($e->getMessage());
                }
            }

            if (!empty($response['files'])) {
                $response['msg'] = $this->__('File has been uploaded.');
                $response['success'] = true;
            }
        }

        header('content-type: application/json');
        echo json_encode($response);
        exit;
    }

    function __($msg) {
        return $msg;
    }

    function getAjaxAction() {
        return $this->pluginPrefix . '_' . $this->fieldName . '_upload';
    }

    function getEditViewPath() {
        return $this->path('view/edit.php');
    }

    function embedAssets() {
        $ver = $this->getLibraryVersion();
        wp_enqueue_script($this->prefix('-upload-helper'), $this->url('asset/js/upload-helper.js'), array('jquery'), $ver, $in_footer = true);
        wp_enqueue_style($this->prefix('-upload-helper'), $this->url('asset/css/upload-helper.css'), array(), $ver);
        wp_localize_script($this->prefix('-upload-helper'), 'CM_UploadHelper_Settings', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce($this->getAjaxAction()),
            'action' => $this->getAjaxAction(),
        ));
    }

}
