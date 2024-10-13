<?php
/**
 * Plugin Name: Cf Plugin
 * Plugin URI: https://devzet.com
 * Description: Custom plugin for Axiusweb.com
 * Version: 3.1.0
 * Author: Devzet
 * Author URI: https://devzet.com
 * Text Domain: cf-plugin
 */

if( ! defined( 'ABSPATH' ) ) {
    die( 'Please do not access directly!' );
};

define ( 'CF_ASSETS_URI', plugin_dir_url( __FILE__ ) . 'assets' );
define ( 'CF_VERSION', '3.1.0' );

// Home Latest post shortcode
require_once( __DIR__ . '/includes/shortcodes/latest-posts.php');
require_once( __DIR__ . '/includes/shortcodes/case-studies.php');

// Post Counter
require_once( __DIR__ . '/includes/shortcodes/view-counter.php');

// Post Categroy page
require_once( __DIR__ . '/includes/shortcodes/categories-post.php');
require_once( __DIR__ . '/includes/shortcodes/searched-posts.php');



// Single Post page shortcode
require_once( __DIR__ . '/includes/shortcodes/single-post-title.php');
require_once( __DIR__ . '/includes/shortcodes/single-post-feature-img.php');
require_once( __DIR__ . '/includes/shortcodes/single-post-categories.php');
require_once( __DIR__ . '/includes/shortcodes/single-post-search.php');
require_once( __DIR__ . '/includes/shortcodes/single-most-popular-posts.php');
require_once( __DIR__ . '/includes/shortcodes/single-post-category.php');
require_once( __DIR__ . '/includes/shortcodes/single-post-content.php');
require_once( __DIR__ . '/includes/shortcodes/single-post-date-time.php');
require_once( __DIR__ . '/includes/shortcodes/single-post-comments-box.php');
require_once( __DIR__ . '/includes/shortcodes/social-post-share.php');
require_once( __DIR__ . '/includes/shortcodes/blog-post.php');



function cf_elementor_addon( $widgets_manager ) {
	require_once( __DIR__ . '/includes/widgets/button-spiner.php' );
	require_once( __DIR__ . '/includes/widgets/testimonials.php' );
	require_once( __DIR__ . '/includes/widgets/nav-menu.php' );
	require_once( __DIR__ . '/includes/widgets/terms-nav.php' );
	require_once( __DIR__ . '/includes/widgets/single-post-categories.php' );
	require_once( __DIR__ . '/includes/widgets/popular-posts.php' );
	require_once( __DIR__ . '/includes/widgets/case-studies.php' );
	require_once( __DIR__ . '/includes/widgets/case-studies-categories.php' );
	$widgets_manager->register( new \Elementor_animated_circle());
	$widgets_manager->register( new \Elementor_testimonial());
	$widgets_manager->register( new \Elementor_nav_menu());
	$widgets_manager->register( new \Elementor_terms_nav());
	$widgets_manager->register( new \Elementor_single_post_categories());
	$widgets_manager->register( new \Elementor_most_popular_posts());
	$widgets_manager->register( new \Elementor_case_studies());
	$widgets_manager->register( new \Elementor_case_studies_categories());
}
add_action( 'elementor/widgets/register', 'cf_elementor_addon' );


// Register all css file
function render_style(){
    wp_register_style( 'latest_posts_style', CF_ASSETS_URI .'/css/latest-posts.css');
    wp_register_style( 'case-studies_style', CF_ASSETS_URI .'/css/case-studies.css');
    wp_register_style( 'most_popular_post', CF_ASSETS_URI .'/css/single-most-popular-post.css');
    wp_register_style( 'testimonial_style', CF_ASSETS_URI .'/css/testimonials.css');
    wp_register_script( 'testimonial_script', CF_ASSETS_URI .'/js/testimonials.js', array('testimonial_swiper_slider_script'), CF_VERSION,  true);

    // Widget style and script
    wp_register_style('testimonial_swiper_slider_style', CF_ASSETS_URI .'/css/swiper-bundle.min.css' );
	wp_register_script( 'testimonial_swiper_slider_script', CF_ASSETS_URI .'/js/swiper-bundle.min.js', array('jquery-core'), CF_VERSION,  true );
}

add_action( 'wp_enqueue_scripts', 'render_style' );

/**
 * Only searches posts and case studies
 *
 * @param [type] $query
 * @return void
 */
function cf_plugin_filter_search_post_types( $query ) {
    if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
        $query->set( 'post_type', array( 'post', 'case-study' ) );
    }
}
add_action( 'pre_get_posts', 'cf_plugin_filter_search_post_types' );