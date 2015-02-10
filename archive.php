<?php
/**
 * The template for displaying search results pages.
 *
 * @package immanence
 */
$noContent = false;
get_header();
wp_enqueue_script( 'search-result-script' );
?>
<body <?php body_class(); ?>>
<?php immanence_navmenu(); ?>
<div class="keywords"><?php printf( __( 'Archives', 'immanence' ) ); ?></div>
<section class="wrapper-content">
	<div class='content'>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="title search-title"> <a href='<?php the_permalink(); ?>'> <?php the_title(); ?> </a> </div>
					<div class='info'><?php echo esc_html( get_the_date() ); ?> | <?php echo esc_html( immanence_reading_time() ); ?> min read</div>
					<?php the_excerpt(); ?>
				</article>
				<div class="search-result-separator"></div>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none-search' ); $noContent = true;?>
		<?php endif; ?>
	</div><!-- content -->
<?php if ($noContent) immanence_widgetbar(); ?>
<?php get_footer(); ?>