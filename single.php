<?php
/**
 * The template for displaying all single posts.
 *
 * @package immanence
 */
get_header();
wp_enqueue_script( 'swipebox-script' ); 
?>
<body <?php body_class(); ?>>
		<?php immanence_back_to_top_button(); ?>
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
				<?php if ( ( $format = get_post_format() ) ) : get_template_part( 'single', $format ); ?>
				<?php else : ?>
					<div class="bigpic-single">
						<div class="overlay-single"></div>
						<?php  if ( !get_post_meta($post->ID, 'hidetitle', true) ) : ?>
							<div class="title-single"> <?php the_title(); ?>
								<div class="subtitle-single"> <?php echo esc_html( get_post_meta($post->ID, 'subtitle', true) );?></div>
							</div>
						<?php  endif; ?>
					</div>
					<section class="wrapper-content">
						<div <?php post_class('content'); ?> >
							<?php immanence_post_meta(); ?>
							<div class="ajax-content">
								<article id="post-<?php the_ID(); ?>">
									<?php the_content(); ?>
									<?php edit_post_link('edit'); ?>
								</article>
							</div>
							<?php immanence_post_nav( get_post_meta($post->ID, 'showtags', true) ); ?>
							<?php immanence_post_toolbar(); ?>
				<?php endif; ?>
			<?php else: get_template_part( 'content', 'none-post' ); ?>
			<?php endif; ?>
		</div><!-- content -->
<?php immanence_widgetbar(); ?>
<?php get_footer(); ?>