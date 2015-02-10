<?php
/**
 * Custom template tags for this theme.
 * @package immanence
 */

/*
** Display navigation menu bar in all pages.
*/
if ( ! function_exists( 'immanence_navmenu' ) ) :
function immanence_navmenu()
{
	$navmenuParameters = array(
		'theme_location'	=> 'immanence-navmenu',
		'container'			=> 'nav',
		'container_class'	=> 'navmenu',
		'echo'				=> false,
		'depth'				=> 0,
	);
	echo strip_tags(wp_nav_menu( $navmenuParameters ), '<a> <nav> <form> <input> <button> <i>' )
	. "<div class='menu-button'><i class='fa fa-ellipsis-v'></i></div>";
	if ( is_user_logged_in() )
	{
		echo "<div class='dashboard-button'><a href='" . admin_url() . "'><i class='fa fa-cogs'></i></a></div>";
	}
}
endif;

/*
** Display navigation to next/previous page of posts in homepage.
*/
if ( ! function_exists( 'immanence_paging_nav' ) ) :
function immanence_paging_nav()
{
	if ( $GLOBALS['wp_query']->max_num_pages < 2 )
	{
		return;
	}
	echo "<nav class='nav-pagination'>";
	next_posts_link("<i class='fa fa-chevron-left'></i>");
	previous_posts_link("<i class='fa fa-chevron-right'></i>");
	echo "</nav>";
}
endif;

/*
** Display navigation to next/previous post when applicable.
*/
if ( ! function_exists( 'immanence_post_nav' ) ) :
function immanence_post_nav($showtags)
{
	global $numpages;

	if ( $numpages > 1 || $showtags )
	{
		echo "<nav class='single-post-pages-tags-nav'>";
		if ( $numpages > 1 )
		{
			wp_link_pages( array('before' => "<div class='ajax-nav'><div class='post-pages'>", 'after' => "</div></div>") );
		}
		if ( $showtags )
		{
			echo "<div class='post-tags'><div><i class='fa fa-file-text post-tags'></i> ";
			the_category(' &middot; ');
			echo "</div>";
			the_tags('<div><i class="fa fa-tags post-tags"></i> ', '', '</div>');
			echo "</div>";
		}
		echo "</nav>";
	}
}
endif;

/*
** Prints HTML with meta information for the current post: author, date/time and estimated reading time.
*/
if ( ! function_exists( 'immanence_post_meta' ) ) :
function immanence_post_meta()
{
	echo "<div class='info info-single'>";
	the_author();
	echo ", ";
	the_date();
	echo " | " . esc_html( immanence_reading_time() ) . " min read</div>";
}
endif;

/*
** Prints HTML with meta information for the toolbar of the current post.
** It contains previous/next post, sharing option (twitter, facebook, google+, mail) and comments template.
*/
if ( ! function_exists( 'immanence_post_toolbar' ) ) :
function immanence_post_toolbar()
{
	echo "<nav class='post-toolbar'>";
	if ( !is_page() ) previous_post_link('%link', "<i class='fa fa-chevron-left'></i>");
	echo "<a href='#' id='share-button'>SHARE</a>
			<a id='twitter' class='sharing' href='' target='_blank'> <i class='fa fa-twitter'></i> </a>
			<a id='facebook' class='sharing' href='' target='_blank'> <i class='fa fa-facebook'></i> </a>
			<a id='googleplus' class='sharing' href='' target='_blank'> <i class='fa fa-google'></i> </a>
			<a id='email' class='sharing' href=''> <i class='fa fa-envelope'></i> </a>";
	if ( comments_open() )
	{
		echo "<a href='#' id='comment-button'>COMMENT</a>";
		if ( !is_page() ) next_post_link('%link', "<i class='fa fa-chevron-right'></i>");
		echo "</nav>";
		echo "<div class='comments-custom-template'>";
		comments_template('/comments.php');
		echo "</div>";
	}
	else
	{
		if ( !is_page() ) next_post_link('%link', "<i class='fa fa-chevron-right'></i>");
		echo "</nav>";
	}
}
endif;

/*
** Display the widgetbar.
*/
if ( ! function_exists( 'immanence_widgetbar' ) ) :
function immanence_widgetbar()
{
	if ( is_active_sidebar('immanence-main-sidebar') )
	{
		echo "<section class='widget-area'>";
		dynamic_sidebar('immanence-main-sidebar');
		echo "</section>";
	}
}
endif;

/*
** Display a back-to-top button on long posts.
*/
if ( ! function_exists( 'immanence_back_to_top_button' ) ) :
function immanence_back_to_top_button()
{
	echo "<i class='fa fa-chevron-up back-to-top-button'></i>";
}
endif;