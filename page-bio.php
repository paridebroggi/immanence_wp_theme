<?php
/**
 * Template Name: Bio / About page Template
 *
 * This template add a twitter link and a profile picture with some animation
 * to the classic template for all pages
 *
 * @package immanence
 */
get_header(); ?>
<body <?php body_class(); ?>>
		<?php immanence_navmenu(); ?>
			<?php if ( have_posts() ) : the_post(); ?>
<?php
/*
** php code that is common to all single-post types.
*/
		$twitter = get_theme_mod('immanence_set_twitter');
		$featuredImage = has_post_thumbnail($post->ID) ? wp_get_attachment_url(get_post_thumbnail_id($post->ID)) : get_header_image();
		wp_enqueue_script( 'page-bio-script' );
		wp_localize_script( 'page-bio-script', 'phpData', array(
			'featuredImage' => $featuredImage, 
			'titleColor' => get_post_meta($post->ID, 'titlecolor', true),
			'twitter' => $twitter,
			'excerpt' => get_the_excerpt(),
		));
?>
		<div class="bigpic-single">
			<div class="overlay"></div>
		</div>
		<img class="avatar" src="<?php echo esc_url( get_theme_mod( 'immanence_set_profile_image', get_template_directory_uri() . '/images/profile.jpg') ); ?> "/>
		<section class="wrapper-content">
			<div class="content <?php post_class('content'); ?>" >
					<div class="twitter-link-bio"> <a href="http://www.twitter.com/<?php echo esc_attr($twitter); ?>" target='blank'>@<?php echo esc_html($twitter); ?></a></div>
					<article id="post-<?php the_ID(); ?>">
						<?php the_content(); ?>
						<?php edit_post_link('edit'); ?>
					</article>
				<?php immanence_post_toolbar(); ?>
		<?php else: get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div><!-- content -->
<?php get_footer(); ?>
