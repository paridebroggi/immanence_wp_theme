<?php
/**
 * Create a custom menu in the appeareance section.
 * It lets the user set his twitter account,
 * profile image and error 404 image.
 *
 * @package immanence
 */

function immanence_settings_manager( $wp_customize )
{
	$wp_customize->add_section( 'immanence_settings', array(
				'title'		=> 'immanence Theme Settings',
				'priority'	=> 1,
	) );

	// Twitter
	$wp_customize->add_setting( 'immanence_set_twitter', array(
				'default'	=> '',
				'capability'=> 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'immanence_set_twitter', array(
				'label'		=> 'Twitter Account (without the @)',
				'section'	=> 'immanence_settings',
				'type'		=> 'text'
	) );

	// Profile Image
	$wp_customize->add_setting( 'immanence_set_profile_image', array(
				'default'	=> get_template_directory_uri() . '/images/profile.jpg',
				'capability'=> 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'immanence_set_profile_image', array(
				'label'		=> 'Profile image',
				'section'	=> 'immanence_settings',
				'settings'	=> 'immanence_set_profile_image'
	) ) );
	
	// Error 404 image
	$wp_customize->add_setting( 'immanence_set_404_image', array(
				'default'	=> get_template_directory_uri() . '/images/404.jpg',
				'capability'=> 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'immanence_set_404_image', array(
				'label'		=> 'Error 404 image',
				'section'	=> 'immanence_settings',
				'settings'	=> 'immanence_set_404_image'
	) )	);

	// Favicon
	$wp_customize->add_setting( 'immanence_set_favicon', array(
				'default'	=> get_template_directory_uri() . '/images/favicon.ico',
				'capability'=> 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'immanence_set_favicon', array(
				'label'		=> 'Favicon',
				'section'	=> 'immanence_settings',
				'settings'	=> 'immanence_set_favicon'
	) ) );

	// Apple Icon Touch
	$wp_customize->add_setting( 'immanence_set_apple_icon_touch', array(
				'default'	=> get_template_directory_uri() . '/images/apple-icon-touch.png',
				'capability'=> 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'immanence_set_apple_icon_touch', array(
				'label'		=> 'Apple Icon Touch',
				'section'	=> 'immanence_settings',
				'settings'	=> 'immanence_set_apple_icon_touch'
	) ) );
}
add_action( 'customize_register', 'immanence_settings_manager' );
?>