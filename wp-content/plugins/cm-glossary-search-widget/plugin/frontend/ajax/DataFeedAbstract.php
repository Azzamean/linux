<?php

namespace com\cminds\searchwidget\plugin\frontend\ajax;

use com\cminds\searchwidget\App;
use com\cminds\searchwidget\plugin\options\Options;

abstract class DataFeedAbstract {

    const AJAX_ACTION = '';

    public function __construct() {
        add_action( sprintf( 'wp_ajax_%s', static::AJAX_ACTION ), array( $this, 'actionAjaxAction' ) );
        add_action( sprintf( 'wp_ajax_nopriv_%s', static::AJAX_ACTION ), array( $this, 'actionAjaxAction' ) );
        if (Options::getOption('pass_query_by_reference') == 1) {
            add_filter( 'posts_where', array( $this, 'filterPostWhereRef' ), 10, 2 );
        } else {
            add_filter( 'posts_where', array( $this, 'filterPostWhere' ), 10, 2 );
        }
    }

    public function actionAjaxAction() {

    }

    public function filterPostWhereRef( $where, $wp_query ) {
        global $wpdb;
        $like1 = $wp_query->get( sprintf( '%s_post_title_like', App::PREFIX ) );
        $whereArr = array();
        if ( $like1 ) {
//            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $like1 ) ) . '%\'';
            $whereArr[] = $wpdb->posts . '.post_title LIKE "%' . esc_sql( $wpdb->esc_like( $like1 ) ) . '%"';
        }
        $like2 = $wp_query->get( sprintf( '%s_post_title_or_content_like', App::PREFIX ) );
        if ( $like2 ) {
//            $where .= ' AND (' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%\' OR ' . $wpdb->posts . '.post_content LIKE \'%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%\')';
            $whereArr[] = $wpdb->posts . '.post_title LIKE "%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%"';
            $whereArr[] = $wpdb->posts . '.post_content LIKE "%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%"';
        }
        if ( $like1 || $like2 ) {
            do_action( 'cmtt_glossary_doing_search', array(), array() );
            $like     = !empty( $like1 ) ? $like1 : $like2;
            $whereArr = apply_filters('cmtt_search_where_arr', $whereArr, $like, $wp_query, array());
            if ( !empty( $whereArr ) ) {
                $where .= ' AND ( ' . implode( ' OR ', $whereArr ) . ' )';
            }
        }
        return $where;
    }

    public function filterPostWhere( $where, \WP_Query $wp_query ) {
        global $wpdb;
        $like1 = $wp_query->get( sprintf( '%s_post_title_like', App::PREFIX ) );
        $whereArr = array();
        if ( $like1 ) {
//            $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $like1 ) ) . '%\'';
            $whereArr[] = $wpdb->posts . '.post_title LIKE "%' . esc_sql( $wpdb->esc_like( $like1 ) ) . '%"';
        }
        $like2 = $wp_query->get( sprintf( '%s_post_title_or_content_like', App::PREFIX ) );
        if ( $like2 ) {
//            $where .= ' AND (' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%\' OR ' . $wpdb->posts . '.post_content LIKE \'%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%\')';
            $whereArr[] = $wpdb->posts . '.post_title LIKE "%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%"';
            $whereArr[] = $wpdb->posts . '.post_content LIKE "%' . esc_sql( $wpdb->esc_like( $like2 ) ) . '%"';
        }
        if ( $like1 || $like2 ) {
            do_action( 'cmtt_glossary_doing_search', array(), array() );
            $like     = !empty( $like1 ) ? $like1 : $like2;
            $whereArr = apply_filters( 'cmtt_search_where_arr', $whereArr, $like, $wp_query, array() );
            if ( !empty( $whereArr ) ) {
                $where .= ' AND ( ' . implode( ' OR ', $whereArr ) . ' )';
            }
        }
        return $where;
    }

}
