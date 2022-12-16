<?php
/**
 * Plugin Name: Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 */

function register_search_slider_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/search-slider-widget.php' );
	require_once( __DIR__ . '/widgets/property-slider-widget.php' );
	require_once( __DIR__ . '/widgets/my-form-widget.php' );
	require_once( __DIR__ . '/widgets/user_registration_form_widget.php' );
	require_once( __DIR__ . '/widgets/user_login_form.php' );


	$widgets_manager->register( new \Elementor_Search_Slider_Widget() );
	$widgets_manager->register( new \Elementor_Property_Slider_Widget() );
	$widgets_manager->register( new \Elementor_My_Form_Widget() );
	$widgets_manager->register( new \Elementor_User_Registration_Form_Widget() );
	$widgets_manager->register( new \Elementor_User_Login_Form() );
	

	

}
add_action( 'elementor/widgets/register', 'register_search_slider_widget' );