<?php
function mytheme_scripts()
{
    /**style files */
    wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.css');
    wp_enqueue_style('owl.theme', get_template_directory_uri() . '/assets/owl-carousel/owl.theme.css');
    wp_enqueue_style('mytheme-bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css');
    wp_enqueue_style('mytheme-custom', get_template_directory_uri() . '/assets/slitslider/css/custom.css');
    wp_enqueue_style('mytheme-style1', get_template_directory_uri() . '/assets/slitslider/css/style.css');
    wp_enqueue_style('mytheme-style', get_template_directory_uri() . '/assets/style.css');
    wp_enqueue_style('om-javascript-range-slider', get_template_directory_uri() . '/assets/om-javascript-range-slider.css');

    /** script files*/
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.js', array('jquery'), false, true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.js', array('jquery'), false, true);
    wp_enqueue_script('jquery-ba-cond-min', get_template_directory_uri() . '/assets/slitslider/js/jquery.ba-cond.min.js', array('jquery'), false, true);
    wp_enqueue_script('jquery-slitslider', get_template_directory_uri() . '/assets/slitslider/js/jquery.slitslider.js', array('jquery'), false, true);
    wp_enqueue_script('modernizr-custom-79639', get_template_directory_uri() . '/assets/slitslider/js/modernizr.custom.79639.js', array('jquery'), false, true);
    wp_enqueue_script('om-javascript-range-slider', get_template_directory_uri() . '/assets/om-javascript-range-slider.js', array('jquery'), false, false);
    wp_enqueue_script('mytheme-script', get_template_directory_uri() . '/assets/script.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'mytheme_scripts');
/*custom post type function code files*/
require_once (get_template_directory()) . '/inc/utilities.php';

// Add theme support for Featured Images
function setup_mytheme_features() {
    add_theme_support( 'menus' );
    add_theme_support('post-thumbnails', array(
        'post',
        'page',
        'property',
    ));
}
add_action( 'init', 'setup_mytheme_features' );


function register_my_menus() {
    register_nav_menus(
      array(
        'header-menu' => __( 'Header Menu' ),
        'extra-menu' => __( 'Extra Menu' )
       )
     );
   }
   add_action( 'init', 'register_my_menus' );


