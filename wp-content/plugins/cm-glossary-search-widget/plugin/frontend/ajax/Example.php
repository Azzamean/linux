<?php

namespace com\cminds\searchwidget\plugin\frontend\ajax;

class Example extends DataFeedAbstract {

    const AJAX_ACTION = 'cmsw_sw_search';

    public function __construct() {
        parent::__construct();
    }

    public function actionAjaxAction() {
        $s = $_POST['s'];
        $args = array(
            'post_status' => 'publish',
            'posts_per_page' => 10,
            's' => $s);
        $query = new \WP_Query($args);
        $data = array();
        foreach ($query->posts as &$item) {
            $entry = new DataFeedEntry();
            $entry->setUrl(get_permalink($item));
            $entry->setPostContent($item->post_content);
            $entry->setPostTitle($item->post_title);
            $entry->setSearch($s);
            $data[] = $entry;
        }
        wp_send_json($data);
    }

}
