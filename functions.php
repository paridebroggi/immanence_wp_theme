<?php

/**
 * immanence functions and definitions
 *
 * @package immanence
 */

/*
** Hide the administration bar in the front end of the website.
*/
show_admin_bar( false );

/*
** Set the content width based on the theme's design and stylesheet.
*/
if ( ! isset( $content_width ) )
{
	$content_width = 700;
}

if ( ! function_exists( 'immanence_setup' ) ) :
/*
** Sets up theme defaults and registers support for various WordPress features.
** Note that this function is hooked into the after_setup_theme hook, which
** runs before the init hook. The init hook is too late for some features, such
** as indicating support for post thumbnails.
*/
function immanence_setup()
{
	/*
	** Make theme available for translation.
	** Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain( 'immanence', get_template_directory() . '/languages' );

	/*
	** Add default posts and comments RSS feed links to head.
	*/
	add_theme_support( 'automatic-feed-links' );

	/*
	** Let WordPress manage the document title.
	*/
	add_theme_support( 'title-tag' );

	/*
	** Enable support for Post Thumbnails on posts and pages.
	*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 500, 500, true );

	/*
	** Custom Header
	*/
	$args = array
	(
		'flex-width'    => true,
		'width'         => 1920,
		'flex-height'   => true,
		'height'        => 1080,
		'uploads'       => true,
		'default-image' => get_template_directory_uri() . '/images/header.jpg'
	);
	add_theme_support( 'custom-header', $args );

	/*
	** Enable Navigation Menu feature.
	*/
	function register_immanence_menu()
	{
		register_nav_menu( 'immanence-navmenu', __( 'immanence Navigation Bar', 'immanence' ) );
		if (!wp_get_nav_menu_object('immanence Navigation Bar'))
		{
			$menu_id = wp_create_nav_menu('immanence Navigation Bar'); 
			$locations = get_theme_mod('nav_menu_locations');
			$locations['immanence-navmenu'] = $menu_id;
			set_theme_mod('nav_menu_locations', $locations); 
		}
	}
	add_action( 'init', 'register_immanence_menu' );

	/*
	** Customize Search Form in Navigation Menu
	** to output valid HTML5.
	*/
	function add_search_form($items, $args)
	{
		if( $args->theme_location === 'immanence-navmenu')
		{
			$items .= get_search_form( false );
		}
		return $items;
	}
	add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);

	/*
	** Switch default core markup for search form, comment form, and comments
	** to output valid HTML5.
	*/
	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
}

endif; /* immanence_setup */
add_action( 'after_setup_theme', 'immanence_setup' );

/*
** Calculate article's estimate reading time.
*/
function immanence_reading_time()
{
	return ceil(str_word_count(get_post()->post_content) / 130);
}

/*
** Enqueue scripts.
*/
function immanence_scripts()
{
	// Load Julian Shapiros's velocity.js library for smoother animations
	wp_enqueue_script( 'velocity', get_template_directory_uri() . '/inc/velocity/velocity.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'velocity-ui', get_template_directory_uri() . '/inc/velocity/velocity.ui.min.js', array('jquery', 'velocity'), '1.0', true);
	// Deafut-script handles navigation menu animations over all website pages
	wp_enqueue_script( 'default-script', get_template_directory_uri() . '/js/default.js', array('jquery', 'velocity', 'velocity-ui'), '1.0', true);
	// home-script handles index.php JavaScript
	wp_register_script( 'home-script', get_template_directory_uri() . '/js/home.js', array('jquery'), '1.0', true);
	// single-script handles post JavaScript
	wp_register_script( 'single-script', get_template_directory_uri() . '/js/single.js', array('jquery', 'velocity', 'velocity-ui'), '1.0', true);
	// search-result-script handles the search results JavaScript
	wp_register_script( 'search-result-script', get_template_directory_uri() . '/js/search-result.js', array('jquery'), '1.0', true);
	// 404-script handles error 404 page JavaScript
	wp_register_script( '404-script', get_template_directory_uri() . '/js/404.js', array('jquery'), '1.0', true);
	// bio-page-script handles javascript for the about /bio page template
	wp_register_script( 'page-bio-script', get_template_directory_uri() . '/js/page-bio.js', array('jquery', 'velocity', 'velocity-ui'), '1.0', true);
	// enable swipebox script
	wp_register_script( 'swipebox-script', get_template_directory_uri() . '/inc/swipebox/src/js/jquery.swipebox.min.js', array('jquery'), false);
}
add_action( 'wp_enqueue_scripts', 'immanence_scripts' );

/*
** Enqueue stylesheets.
*/
function immanence_styles()
{
	wp_enqueue_style( 'immanence-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri() . '/inc/fontawesome/css/font-awesome.min.css');
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400');
	wp_enqueue_style( 'swipebox-css', get_template_directory_uri() . '/inc/swipebox/src/css/swipebox.min.css', array(), '1.0', 'screen' );
}
add_action( 'wp_enqueue_scripts', 'immanence_styles' );

/*
** Register widget area.
*/
function immanence_widgets_init()
{
	register_sidebar( array(
		'name' => __( 'Immanence Main Sidebar', 'immanence' ),
		'id' => 'immanence-main-sidebar',
		'description' => __( 'Widgets in this area will be shown on all posts, search result page and archives pages.', 'immanence' ),
		'before_widget' => '<aside id="%1$s" class="man-c-1-3 widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'immanence_widgets_init' );

/*
** Set the "recent posts", "categories", "archives" as default widgets.
*/
function immanence_set_default_widgets ()
{
	$immanence_default_widgets =  array (
		'wp_inactive_widgets' => array (),
		'immanence-main-sidebar' => array (
			0 => 'recent-posts-2',
			1 => 'archives-2',
			2 => 'categories-2',
		), 
		'array_version' => 3
	);
	update_option( 'sidebars_widgets', $immanence_default_widgets );
}
add_action('after_switch_theme', 'immanence_set_default_widgets');

/*
** Customize comment form.
*/
function custom_comments()
{
	$commenter = wp_get_current_commenter();
	
	$fields =  array 
	(
		'author' => '<p class="comment-form-author">' .
					'<input id="comment-author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . 
					'" size="30" placeholder="' . __( 'Name', 'immanence' ) . '*"/></p>',

		'email'  => '<p class="comment-form-email">' .
					'<input id="comment-email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . 
					'" size="30" placeholder="' . __( 'Email', 'immanence' ) . '*"/></p>',

		'url'    => '<p class="comment-form-url">' .
					'<input id="comment-url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . 
					'" size="30" placeholder="'.__( 'Website', 'immanence' ).'" /></p>',
	);

	$comments_args = array
	(
		'fields' =>  $fields,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'comment_field' => '<p class="comment-form-comment">'. 
							'<textarea id="comment" name="comment" aria-required="true" cols="50" rows="10" placeholder="' .
							 _x( 'Comment', 'noun', 'immanence' ) .'*"  ></textarea></p>'
	);

	comment_form($comments_args);
}

/*
** Custom excerpt "more" link on homepage.
*/
function immanence_excerpt_more($more)
{
	global $post;
	return '<a class="moretag" href="' . get_permalink($post->ID) . '"> &nbsp; &raquo;</a>';
}
add_filter('excerpt_more', 'immanence_excerpt_more');

/*
** Custom excerpt length.
*/
function immanence_excerpt_length($length)
{
	return 55;
}
add_filter('excerpt_length', 'immanence_excerpt_length');

/*
** Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-elements.php';
require get_template_directory() . '/inc/template-dashboard.php';