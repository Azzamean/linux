<?php

namespace com\cminds\searchwidget\plugin\frontend\ajax;

class DataFeedEntry {

    public $post_title;
    public $post_content;
    public $url;
    private $_post_title;
    private $_post_content;
    private $_search = '';

    public function setSearch($s) {
        $this->_search = $s;
        $this->_post_title && $this->setPostTitle($this->_post_title);
        $this->_post_content && $this->setPostContent($this->_post_content);
    }

    public function setPostTitle($s) {
        $this->_post_title = $s;
        $this->post_title = preg_replace('/(' . preg_quote($this->_search) . ')/i', '<strong class="cmsw-match">${1}</strong>', $s);
    }

    public function setPostContent($s) {
        $this->_post_content = wp_strip_all_tags($this->fixHTML($s));
        $this->post_content = $this->_post_content;
//        $s = wp_strip_all_tags($s);
//        $s = strip_shortcodes($s);
//        $this->post_content = preg_replace('/(' . preg_quote($this->_search) . ')/i', '<strong class="cmsw-match">${1}</strong>', $s);
    }

    public function setUrl($s) {
        $this->url = $s;
    }

    private function fixHTML($s) {
        $s = preg_replace('/\<\/div\>/', '</div> ', $s);
        return $s;
    }

}
