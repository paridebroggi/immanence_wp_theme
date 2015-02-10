<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package immanence
 */
get_header();
wp_enqueue_script( 'home-script' );
wp_localize_script( 'home-script', 'phpData', array( 'headerImage' => get_header_image() ));
?>

<body <?php body_class(); ?>>
	<?php immanence_navmenu(); ?>
	<div class="bigpic-home">
		<div class="overlay-home"></div>
	</div>
	<div id="blog-description"><?php bloginfo( 'description' ); ?></div>
	<section class="wrapper-content">
		<div class='content'>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="title"> <a href='<?php the_permalink(); ?>'> <?php the_title(); ?> </a> </div>
						<div class='info'><?php echo esc_html( get_the_date() ); ?> | <?php echo esc_html( immanence_reading_time() ); ?> min read | <?php the_category(' &middot; '); ?> </div>
						<?php the_excerpt(); ?>
						<?php edit_post_link('edit'); ?>
					</article>
				<?php endwhile; ?>		
			<?php else : get_template_part( 'content', 'none-post' ); ?>
			<?php endif; ?>
				<?php immanence_paging_nav(); ?>
		</div><!-- content -->
	<?php get_footer(); ?>