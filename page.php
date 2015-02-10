<?php
/**
 * This is the template that displays all pages by default.
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
		wp_enqueue_script( 'single-script' );
		wp_localize_script( 'single-script', 'phpData', array(
			'featuredImage' => $featuredImage, 
			'titleColor' => get_post_meta($post->ID, 'titlecolor', true),
			'twitter' => $twitter,
			'excerpt' => get_the_excerpt(),
		));
?>
		<div class="bigpic-single">
			<div class="overlay"></div>
			<div class="title-single"> <?php the_title(); ?>
				<div class="subtitle-single"> <?php echo esc_html( get_post_meta($post->ID, 'subtitle', true) ); ?></div>
			</div>
		</div>
		<section class="wrapper-content">
			<div class="content <?php post_class('content'); ?>" >
			<?php immanence_post_meta(); ?>
					<article id="post-<?php the_ID(); ?>">
						<?php the_content(); ?>
						<?php edit_post_link('edit'); ?>
					</article>
				<?php immanence_post_toolbar(); ?>
		<?php else: get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div><!-- content -->
<?php get_footer(); ?>
