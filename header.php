<?php
/**
 * The header for the theme.
 * Displays all of the <head> section.
 *
 * @package immanence
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="apple-touch-icon" href="<?php echo esc_url( get_theme_mod( 'immanence_set_apple_icon_touch', get_template_directory_uri() . '/images/apple-icon-touch.png' ) ); ?>">
		<link rel="icon" href="<?php echo esc_url( get_theme_mod( 'immanence_set_favicon', get_template_directory_uri() . '/images/favicon.ico' ) ); ?>">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo esc_url(  get_theme_mod( 'immanence_set_favicon', get_template_directory_uri() . '/images/favicon.ico' ) ); ?>">
		<![endif]-->
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php wp_head(); ?>
	</head>