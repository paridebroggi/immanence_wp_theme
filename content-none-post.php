<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package immanence
 */
?>
<section class="wrapper-content">
	<div class="content <?php post_class('content'); ?>" >
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="title"> No post found </div>
			<div class='info'></div>
<?php 
		if ( is_home() && current_user_can( 'publish_posts' ) )
		{
			printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'immanence' ), esc_url( admin_url( 'post-new.php' ) ) );
		}
		else
		{
			_e( 'Opps, can\'t find the post. ', 'immanence' );
		}
	?>
		</article>
	</div><!-- no-content -->