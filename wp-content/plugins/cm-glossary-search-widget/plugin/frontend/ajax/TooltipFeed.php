<?php

namespace com\cminds\searchwidget\plugin\frontend\ajax;

use com\cminds\searchwidget\plugin\options\Options;

class TooltipFeed extends DataFeedAbstract {

    const AJAX_ACTION = 'cmsw_sw_search';

    public function __construct() {
        parent::__construct();

//        add_action('init', function() {
//            $_POST['s'] = 'c';
//            $this->actionAjaxAction();
//        }, 1);
    }

    public function actionAjaxAction() {
        $s = $_POST['s'];
        $args = array(
            'post_type' => 'glossary',
            'post_status' => 'publish',
            'posts_per_page' => intval(Options::getOption('number_of_results')),
            'cmsw_post_title_like' => $s,
            'order' => 'ASC',
            'orderby' => 'title'
        );
        $args = apply_filters( 'cmtt_glossary_index_query_args', $args, array('search_term' => $s) );
        $query = new \WP_Query($args);
        $data = array();
        foreach ($query->posts as &$item) {
            $entry = new DataFeedEntry();

            $entry->setUrl(get_permalink($item));

            $content = apply_filters('cmtt_term_tooltip_content', '', $item);
            $content = apply_filters('cmtt_3rdparty_tooltip_content', $content, $item, false);
            $content = html_entity_decode($content);
            $entry->setPostContent($content);

            $entry->setPostTitle($item->post_title);

            $entry->setSearch($s);

            $data[] = $entry;
        }
        wp_send_json($data);
    }

}
