<?php
/**
 * The custom template for displaying comments.
 * @package immanence
 */

/*
** If the current post is protected by a password and
** the visitor has not yet entered the password it
** returns early without loading the comments.
*/
if ( post_password_required() )
{
	return;
}
if ( is_singular() ) 
{
	wp_enqueue_script( "comment-reply" );
}
?>
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments(); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'immanence' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'immanence' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'immanence' ) ); ?></div>
		</nav>
		<?php endif; ?>
	<?php endif;  ?>
	<?php custom_comments(); ?>
