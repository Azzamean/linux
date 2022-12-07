<?php

class CMTooltipCommunityTermsDashboardFrontend {

    const COMMUNITYTERMS_SHORT_CODE = 'terms_dashboard';

    protected static $instance = NULL;

    function __construct() {
        add_shortcode( self::COMMUNITYTERMS_SHORT_CODE, array( __CLASS__, 'loadTermDashboard' ) );
        add_action( 'template_redirect', array( __CLASS__, 'delAndRedirect' ) );
    }

    public static function delAndRedirect() {
        if ( isset( $_GET[ 'del_term' ] ) ) {
            $get_delete_option = \CM\CMTT_Settings::get( CMTooltipCommunityTermsBackend::COMMUNITYTERMS_ALLOW_DELETE_TERM );

            if ( 1 == $get_delete_option ) {
                global $post;
                $slug = get_post( $post )->post_name;

                wp_delete_post( $_GET[ 'term_id' ], false );
                wp_redirect( site_url() . '/' . $slug, 302 );
                exit;
            }
        }
    }

    public static function getTaxonomyTerms( $data ) {
        $output = '';

        $allTerms = get_terms( $data );
        if ( !empty( $data[ 'term_id' ] ) ) {
            $data[ 'taxonomy_terms' ] = wp_get_object_terms( $data[ 'term_id' ], $data[ 'taxonomy' ], array( 'orderby' => 'name', 'order' => 'ASC' ) );
        }
        $output .= self::outputAsDropdown( $data, $allTerms );

        return $output;
    }

    public static function outputAsDropdown( $data, $terms = array() ) {
        $output    = '';
        $all_value = 'all';
        $current   = !empty( $data[ 'taxonomy_terms' ] ) ? $data[ 'taxonomy_terms' ] : '';

        if ( is_wp_error( $terms ) ) {
            return '';
        }

        if ( !empty( $current ) && is_array( $current ) ) {
            $current = reset( $current )->slug;
        }

        $r = array(
            'show_option_all'   => '',
            'show_option_none'  => '',
            'orderby'           => 'id',
            'order'             => 'ASC',
            'show_count'        => 0,
            'hide_empty'        => 1,
            'child_of'          => 0,
            'exclude'           => '',
            'echo'              => 1,
            'selected'          => $current,
            'hierarchical'      => 0,
            'name'              => 'cat',
            'id'                => '',
            'class'             => 'postform',
            'depth'             => 0,
            'tab_index'         => 0,
            'taxonomy'          => $data[ 'taxonomy' ],
            'hide_if_empty'     => false,
            'option_none_value' => -1,
            'value_field'       => 'slug',
            'required'          => false,
        );

        $output .= '<select name="' . esc_attr( $data[ 'field_slug' ] ) . '" id="' . esc_attr( $data[ 'field_slug' ] ) . '" class="cmttct-filter-input-select">';
        $output .= '<option class="level-0" value="' . esc_attr( $all_value ) . '" ' . selected( $current, $all_value, false ) . '>' . esc_html( $data['all_selection_text'] ) . '</option>';
        $output .= walk_category_dropdown_tree( $terms, 0, $r );
        $output .= '</select>';

        return $output;
    }

    static public function getInstance() {
        if ( empty( self::$instance ) ) {
            self::$instance = new CMTooltipCommunityTermsDashboardFrontend();
        } else {
            return self::$instance;
        }
    }

    public static function loadTermDashboard() {
        $data = array(
            'user_id' => get_current_user_id(),
            'terms'   => array(),
        );

        $query_args = array(
            'post_type'   => 'glossary',
            'author'      => get_current_user_id(),
            'post_status' => array( 'pending', 'publish' ),
            'numberposts' => 100,
        );

        $get_user_terms = new WP_query( $query_args );

        if ( $get_user_terms->have_posts() ) {
            $data[ 'haveposts' ] = 1;

            while ( $get_user_terms->have_posts() ) {
                $get_user_terms->the_post();
                $id = get_the_ID();

                $tmp = array(
                    'post_id'    => $id,
                    'post_title' => get_the_title(),
                    'permalink'  => get_the_permalink(),
                    'date'       => get_the_date(),
                    'modify'     => get_the_modified_time() . ', ' . get_the_modified_date(),
                    'status'     => get_post_status( $id ),
                );

                $data[ 'terms' ][ get_the_ID() ] = $tmp;
            }
        } else {
            $data[ 'haveposts' ] = 0;
        }

        return CMTooltipCommunityTerms::loadView( 'frontend/term_dashboard.php', $data, true );
    }

    /**
     *
     * @since v1.1.5
     * */
    public static function cmtgct_isPending( $id ) {
        $isPending   = get_post_status( $id );
        $post_status = 'pending' == $isPending ? 1 : 0;
        return $post_status;
    }

    public static function loadEditView( $view, $data = null, $html = false ) {
        $content = '';
        ob_start();
        //  if( !empty($data) ) extract($data);
        require_once CMTCT_PLUGIN_DIR_VIEWS_PATH . $view;
        $content .= ob_get_contents();
        ob_end_clean();

        if ( $html ) {
            return $content;
        } else {
            echo $content;
        }
    }

}
