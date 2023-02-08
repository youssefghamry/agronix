<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/*
Plugin Name: Bdevs Toolkit
Plugin URI: http://bdevs.net/
Description: Bdevs Toolkit Plugin
Version: 1.0.1
Author: theme_pure
Author URI: http://bdevs.net
 */

define( 'BDEVS_TOOLKIT_VER', '1.0.1' );
define( 'BDEVS_TOOLKIT_DIR', plugin_dir_path( __FILE__ ) );
define( 'BDEVS_TOOLKIT_URL', plugin_dir_url( __FILE__ ) );

define( 'BDEVS_TOOLKIT_METABOX_ACTIVED', in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

final class Bdevs_toolkit {

    private static $instance;

    function __construct() {

        require_once BDEVS_TOOLKIT_DIR . '/inc/custom-post.php';

        require_once BDEVS_TOOLKIT_DIR . '/inc/acf-meta-field.php';
        require_once BDEVS_TOOLKIT_DIR . '/inc/class-ocdi-importer.php';
        /**
         * widgets
         */
        require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-service-list.php';
        require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-latest-posts-sidebar.php';
        require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-services-form-widget.php';
        require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-subscriber-widget.php';
        require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-latest-posts-footer.php';

        add_filter( 'template_include', [ $this, '_custom_template_include' ] );
    }

    public static function instance() {

        if ( !isset( self::$instance ) && !( self::$instance instanceof Bdevs_toolkit ) ) {
            self::$instance = new Bdevs_toolkit;
        }
        return self::$instance;
    }

    public function _custom_template_include( $template ) {
        $post_types = bdevs_custom_post_types();
        foreach ( $post_types as $post_type => $fields ) {
            if ( is_singular( $post_type ) ) {
                return $this->_get_custom_template( 'single-' . $post_type . '.php' );
            }
        }
        return $template;

    }

    public function _get_custom_template( $template ) {
        if ( $theme_file = locate_template( [ $template ] ) ) {
            $file = $theme_file;
        } else {
            $file = BDEVS_TOOLKIT_DIR . 'template/' . $template;
        }
        return apply_filters( __FUNCTION__, $file, $template );
    }

}

function Bdevs_toolkit() {

    return Bdevs_toolkit::instance();
}

Bdevs_toolkit();

/**
 *
 */
function bdevs_custom_post_types() {

    $agronix_sv_slug = get_theme_mod('agronix_sv_slug','ourservices');
    $agronix_port_slug = get_theme_mod('agronix_port_slug','ourportfolio');


    return [
        'bdevs-services' => [ 'title' => 'Service', 'plural_title' => 'Service', 'rewrite' => $agronix_sv_slug, 'menu_icon' => 'dashicons-admin-generic' ],
        'bdevs-portfolio'    => [ 'title' => 'Portfolio', 'plural_title' => 'Portfolio', 'rewrite' => $agronix_port_slug, 'menu_icon' => 'dashicons-format-image' ],
    ];
}

add_filter( 'custom_bdevs_post_types', 'bdevs_custom_post_types' );

/**
 *
 */
function bdevs_custom_taxonomies() {
    return [
        'service-categories' => [
            'title'        => 'Services Category',
            'plural_title' => 'Services Categories',
            'rewrite'      => 'services-cat',
            'post_type'    => 'bdevs-services',
        ],
        'portfolio-categories'   => [
            'title'        => 'Portfolio Category',
            'plural_title' => 'Portfolio Categories',
            'rewrite'      => 'portfolio-cat',
            'post_type'    => 'bdevs-portfolio',
        ],
    ];
}

add_filter( 'custom_bdevs_taxonomies', 'bdevs_custom_taxonomies' );

function bdevs_custom_tags() {
    return [
        'services-tags' => [
            'title'        => 'Services Tag',
            'plural_title' => 'Services Tags',
            'rewrite'      => 'services-tag',
            'post_type'    => 'bdevs-services',
        ],
    ];
}

add_filter( 'custom_bdevs_tags', 'bdevs_custom_tags' );

/**
 * taxonomy category
 */
function bdevs_get_terms( $id, $tax ) {
    $terms = get_the_terms( get_the_ID(), $tax );
    $list = '';
    if ( $terms && !is_wp_error( $terms ) ):
        $i = 1;
        $cats_count = count( $terms );
        foreach ( $terms as $term ) {
            $exatra = ( $cats_count > $i ) ? ', ' : '';
            $list .= $term->name . $exatra;
            $i++;
        }
    endif;
    return trim( $list, ',' );
}


// Load textdomain
function tp_load_plugin_textdomain() {
    load_plugin_textdomain( 'bdevs-toolkit', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'tp_load_plugin_textdomain' );


// shop_search_callback
function shop_search_callback() {
    ob_start(); ?>
    <div class="sidebar__widget-content"><div class="sidebar__search-wrapper">
        <form class="sidebar-widget-form" action="<?php print esc_url(home_url('/courses')); ?>" method="get">
            <input type="text" value="<?php print esc_attr( get_search_query() ) ?>" required name="s" placeholder="<?php echo esc_html__('Search','agronix'); ?>">
            <button type="submit"> <i class="fal fa-search"></i>  </button>
        </form>
    </div></div>
    <?php return ob_get_clean();
}
add_shortcode( 'get_shop_search_shortcode', 'shop_search_callback' );
