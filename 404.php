<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package immanence
 */
get_header();
wp_enqueue_script( '404-script' );
wp_localize_script( '404-script', 'phpData', array(
		'image404' => get_theme_mod('immanence_set_404_image', get_template_directory_uri() . '/images/404.jpg'),
		'urlHome' => home_url()
));
?>
<body <?php body_class(); ?>>
	<div class="bigpic-single"></dive>
		<div class="title-single error">Page not found
			<div class="subtitle-single">but still the Universe is magnificent</div>
		</div>
<?php get_footer(); ?>