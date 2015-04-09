<?php

/**

 * Twenty Twelve functions and definitions

 *

 * Sets up the theme and provides some helper functions, which are used

 * in the theme as custom template tags. Others are attached to action and

 * filter hooks in WordPress to change core functionality.

 *

 * When using a child theme (see http://codex.wordpress.org/Theme_Development and

 * http://codex.wordpress.org/Child_Themes), you can override certain functions

 * (those wrapped in a function_exists() call) by defining them first in your child theme's

 * functions.php file. The child theme's functions.php file is included before the parent

 * theme's file, so the child theme functions would be used.

 *

 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached

 * to a filter or action hook.

 *

 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API

 *

 * @package WordPress

 * @subpackage Twenty_Twelve

 * @since Twenty Twelve 1.0

 */



// Set up the content width value based on the theme's design and stylesheet.

if ( ! isset( $content_width ) )

	$content_width = 625;



/**

 * Twenty Twelve setup.

 *

 * Sets up theme defaults and registers the various WordPress features that

 * Twenty Twelve supports.

 *

 * @uses load_theme_textdomain() For translation/localization support.

 * @uses add_editor_style() To add a Visual Editor stylesheet.

 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,

 * 	custom background, and post formats.

 * @uses register_nav_menu() To add support for navigation menus.

 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.

 *

 * @since Twenty Twelve 1.0

 */

function twentytwelve_setup() {

	/*

	 * Makes Twenty Twelve available for translation.

	 *

	 * Translations can be added to the /languages/ directory.

	 * If you're building a theme based on Twenty Twelve, use a find and replace

	 * to change 'twentytwelve' to the name of your theme in all the template files.

	 */

	load_theme_textdomain( 'umh-community', get_template_directory() . '/languages' );



	// This theme styles the visual editor with editor-style.css to match the theme style.

	add_editor_style();



	// Adds RSS feed links to <head> for posts and comments.

	add_theme_support( 'automatic-feed-links' );



	// This theme supports a variety of post formats.

	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menu( 'primary', __( 'Primary Menu', 'umh-community' ) );



	/*

	 * This theme supports custom background color and image,

	 * and here we also set up the default background color.

	 */

	add_theme_support( 'custom-background', array(

		'default-color' => 'e6e6e6',

	) );



	// This theme uses a custom image size for featured images, displayed on "standard" posts.

	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

}

add_action( 'after_setup_theme', 'twentytwelve_setup' );



/**

 * Add support for a custom header image.

 */

require( get_template_directory() . '/inc/custom-header.php' );



/**

 * Return the Google font stylesheet URL if available.

 *

 * The use of Open Sans by default is localized. For languages that use

 * characters not supported by the font, the font can be disabled.

 *

 * @since Twenty Twelve 1.2

 *

 * @return string Font stylesheet or empty string if disabled.

 */

function twentytwelve_get_font_url() {

	$font_url = '';



	/* translators: If there are characters in your language that are not supported

	 * by Open Sans, translate this to 'off'. Do not translate into your own language.

	 */

	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'umh-community' ) ) {

		$subsets = 'latin,latin-ext';



		/* translators: To add an additional Open Sans character subset specific to your language,

		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.

		 */

		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'umh-community' );



		if ( 'cyrillic' == $subset )

			$subsets .= ',cyrillic,cyrillic-ext';

		elseif ( 'greek' == $subset )

			$subsets .= ',greek,greek-ext';

		elseif ( 'vietnamese' == $subset )

			$subsets .= ',vietnamese';



		$protocol = is_ssl() ? 'https' : 'http';

		$query_args = array(

			'family' => 'Open+Sans:400italic,700italic,400,700',

			'subset' => $subsets,

		);

		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );

	}



	return $font_url;

}



/**

 * Enqueue scripts and styles for front-end.

 *

 * @since Twenty Twelve 1.0

 *

 * @return void

 */

function twentytwelve_scripts_styles() {

	global $wp_styles;



	/*

	 * Adds JavaScript to pages with the comment form to support

	 * sites with threaded comments (when in use).

	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );



	// Adds JavaScript for handling the navigation menu hide-and-show behavior.

	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );



	$font_url = twentytwelve_get_font_url();

	if ( ! empty( $font_url ) )

		wp_enqueue_style( 'twentytwelve-fonts', esc_url_raw( $font_url ), array(), null );



	// Loads our main stylesheet.

	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );



	// Loads the Internet Explorer specific stylesheet.

	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );

	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );

}

add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );



/**

 * Filter TinyMCE CSS path to include Google Fonts.

 *

 * Adds additional stylesheets to the TinyMCE editor if needed.

 *

 * @uses twentytwelve_get_font_url() To get the Google Font stylesheet URL.

 *

 * @since Twenty Twelve 1.2

 *

 * @param string $mce_css CSS path to load in TinyMCE.

 * @return string Filtered CSS path.

 */

function twentytwelve_mce_css( $mce_css ) {

	$font_url = twentytwelve_get_font_url();



	if ( empty( $font_url ) )

		return $mce_css;



	if ( ! empty( $mce_css ) )

		$mce_css .= ',';



	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );



	return $mce_css;

}

add_filter( 'mce_css', 'twentytwelve_mce_css' );



/**

 * Filter the page title.

 *

 * Creates a nicely formatted and more specific title element text

 * for output in head of document, based on current view.

 *

 * @since Twenty Twelve 1.0

 *

 * @param string $title Default title text for current view.

 * @param string $sep Optional separator.

 * @return string Filtered title.

 */

function twentytwelve_wp_title( $title, $sep ) {

	global $paged, $page;



	if ( is_feed() )

		return $title;



	// Add the site name.

	$title .= get_bloginfo( 'name' );



	// Add the site description for the home/front page.

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		$title = "$title $sep $site_description";



	// Add a page number if necessary.

	if ( $paged >= 2 || $page >= 2 )

		$title = "$title $sep " . sprintf( __( 'Page %s', 'umh-community' ), max( $paged, $page ) );



	return $title;

}

add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );



/**

 * Filter the page menu arguments.

 *

 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.

 *

 * @since Twenty Twelve 1.0

 */

function twentytwelve_page_menu_args( $args ) {

	if ( ! isset( $args['show_home'] ) )

		$args['show_home'] = true;

	return $args;

}

add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );



/**

 * Register sidebars.

 *

 * Registers our main widget area and the front page widget areas.

 *

 * @since Twenty Twelve 1.0

 */

function twentytwelve_widgets_init() {

	register_sidebar( array(

		'name' => __( 'Left Sidebar', 'umh-community' ),

		'id' => 'sidebar-1',

		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );



	register_sidebar( array(

		'name' => __( 'Header Logo Widget Area', 'umh-community' ),

		'id' => 'logo-sidebar',

		'description' => __( 'Appears on Header for Logo', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );

	

	register_sidebar( array(

		'name' => __( 'Header Tagline Widget Area', 'umh-community' ),

		'id' => 'header-tagline',

		'description' => __( 'Appears on Header for Tagline', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );



	register_sidebar( array(

		'name' => __( 'Header Social Widget Area', 'umh-community' ),

		'id' => 'header-social',

		'description' => __( 'Appears on Header for Social Icons', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );

	

		register_sidebar( array(

		'name' => __( 'Header Print Widget Area', 'umh-community' ),

		'id' => 'header-print',

		'description' => __( 'Appears on Header for Print and Font Resize Icons', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );



		register_sidebar( array(

		'name' => __( 'Map And Directions Widget', 'umh-community' ),

		'id' => 'map-directions',

		'description' => __( 'Appears next to slider for take a tour short form', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );

	

		register_sidebar( array(

		'name' => __( 'Home Content Bottom Box One', 'umh-community' ),

		'id' => 'home-page-bottom-one',

		'description' => __( 'Appears on home page to display bottom content left side', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );

	

	register_sidebar( array(

		'name' => __( 'Home Content Bottom Box Two', 'umh-community' ),

		'id' => 'home-page-bottom-two',

		'description' => __( 'Appears on home page to display bottom content middle', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );	

	

	register_sidebar( array(

		'name' => __( 'Home Content Bottom Box Three', 'umh-community' ),

		'id' => 'home-page-bottom-three',

		'description' => __( 'Appears on home page to display bottom content right side', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );



/*

		register_sidebar( array(

		'name' => __( 'Home Footer Top', 'umh-community' ),

		'id' => 'home-footer-top',

		'description' => __( 'Appears on home page above footer', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );

*/	

		register_sidebar( array(

		'name' => __( 'Footer Sidebar Widget Area', 'umh-community' ),

		'id' => 'footer-sidebar',

		'description' => __( 'Appears in footer', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );

	

		register_sidebar( array(

		'name' => __( 'Footer Copyrights Widget Area', 'umh-community' ),

		'id' => 'footer-copyrights',

		'description' => __( 'Appears below footer widgets', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );	

		register_sidebar( array(

		'name' => __( 'Inner Sidebar', 'umh-community' ),

		'id' => 'sidebar-inner',

		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );
	
	register_sidebar( array(

		'name' => __( 'Events Sidebar', 'umh-community' ),

		'id' => 'sidebar-events',

		'description' => __( 'Appears on Events Page, which has its own widgets', 'umh-community' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );


				

}

add_action( 'widgets_init', 'twentytwelve_widgets_init' );



if ( ! function_exists( 'twentytwelve_content_nav' ) ) :

/**

 * Displays navigation to next/previous pages when applicable.

 *

 * @since Twenty Twelve 1.0

 */

function twentytwelve_content_nav( $html_id ) {

	global $wp_query;



	$html_id = esc_attr( $html_id );



	if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">

			<h3 class="assistive-text"><?php _e( 'Post navigation', 'umh-community' ); ?></h3>

			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'umh-community' ) ); ?></div>

			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'umh-community' ) ); ?></div>

		</nav><!-- #<?php echo $html_id; ?> .navigation -->

	<?php endif;

}

endif;



if ( ! function_exists( 'twentytwelve_comment' ) ) :

/**

 * Template for comments and pingbacks.

 *

 * To override this walker in a child theme without modifying the comments template

 * simply create your own twentytwelve_comment(), and that function will be used instead.

 *

 * Used as a callback by wp_list_comments() for displaying the comments.

 *

 * @since Twenty Twelve 1.0

 *

 * @return void

 */

function twentytwelve_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case 'pingback' :

		case 'trackback' :

		// Display trackbacks differently than normal comments.

	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<p><?php _e( 'Pingback:', 'umh-community' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'umh-community' ), '<span class="edit-link">', '</span>' ); ?></p>

	<?php

			break;

		default :

		// Proceed with normal comments.

		global $post;

	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<header class="comment-meta comment-author vcard">

				<?php

					echo get_avatar( $comment, 44 );

					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',

						get_comment_author_link(),

						// If current post author is also comment author, make it known visually.

						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'umh-community' ) . '</span>' : ''

					);

					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',

						esc_url( get_comment_link( $comment->comment_ID ) ),

						get_comment_time( 'c' ),

						/* translators: 1: date, 2: time */

						sprintf( __( '%1$s at %2$s', 'umh-community' ), get_comment_date(), get_comment_time() )

					);

				?>

			</header><!-- .comment-meta -->



			<?php if ( '0' == $comment->comment_approved ) : ?>

				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'umh-community' ); ?></p>

			<?php endif; ?>



			<section class="comment-content comment">

				<?php comment_text(); ?>

				<?php edit_comment_link( __( 'Edit', 'umh-community' ), '<p class="edit-link">', '</p>' ); ?>

			</section><!-- .comment-content -->



			<div class="reply">

				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'umh-community' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

			</div><!-- .reply -->

		</article><!-- #comment-## -->

	<?php

		break;

	endswitch; // end comment_type check

}

endif;



if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :

/**

 * Set up post entry meta.

 *

 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.

 *

 * Create your own twentytwelve_entry_meta() to override in a child theme.

 *

 * @since Twenty Twelve 1.0

 *

 * @return void

 */

function twentytwelve_entry_meta() {

	// Translators: used between list items, there is a space after the comma.

	$categories_list = get_the_category_list( __( ', ', 'umh-community' ) );



	// Translators: used between list items, there is a space after the comma.

	$tag_list = get_the_tag_list( '', __( ', ', 'umh-community' ) );



	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',

		esc_url( get_permalink() ),

		esc_attr( get_the_time() ),

		esc_attr( get_the_date( 'c' ) ),

		esc_html( get_the_date() )

	);



	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',

		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),

		esc_attr( sprintf( __( 'View all posts by %s', 'umh-community' ), get_the_author() ) ),

		get_the_author()

	);



	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.

	if ( $tag_list ) {

		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'umh-community' );

	} elseif ( $categories_list ) {

		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'umh-community' );

	} else {

		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'umh-community' );

	}



	printf(

		$utility_text,

		$categories_list,

		$tag_list,

		$date,

		$author

	);

}

endif;



/**

 * Extend the default WordPress body classes.

 *

 * Extends the default WordPress body class to denote:

 * 1. Using a full-width layout, when no active widgets in the sidebar

 *    or full-width template.

 * 2. Front Page template: thumbnail in use and number of sidebars for

 *    widget areas.

 * 3. White or empty background color to change the layout and spacing.

 * 4. Custom fonts enabled.

 * 5. Single or multiple authors.

 *

 * @since Twenty Twelve 1.0

 *

 * @param array $classes Existing class values.

 * @return array Filtered class values.

 */

function twentytwelve_body_class( $classes ) {

	$background_color = get_background_color();

	$background_image = get_background_image();



	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )

		$classes[] = 'full-width';



	if ( is_page_template( 'page-templates/front-page.php' ) ) {

		$classes[] = 'template-front-page';

		if ( has_post_thumbnail() )

			$classes[] = 'has-post-thumbnail';

		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )

			$classes[] = 'two-sidebars';

	}



	if ( empty( $background_image ) ) {

		if ( empty( $background_color ) )

			$classes[] = 'custom-background-empty';

		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )

			$classes[] = 'custom-background-white';

	}



	// Enable custom font class only if the font CSS is queued to load.

	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )

		$classes[] = 'custom-font-enabled';



	if ( ! is_multi_author() )

		$classes[] = 'single-author';



	return $classes;

}

add_filter( 'body_class', 'twentytwelve_body_class' );



/**

 * Adjust content width in certain contexts.

 *

 * Adjusts content_width value for full-width and single image attachment

 * templates, and when there are no active widgets in the sidebar.

 *

 * @since Twenty Twelve 1.0

 *

 * @return void

 */

function twentytwelve_content_width() {

	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {

		global $content_width;

		$content_width = 960;

	}

}

add_action( 'template_redirect', 'twentytwelve_content_width' );



/**

 * Register postMessage support.

 *

 * Add postMessage support for site title and description for the Customizer.

 *

 * @since Twenty Twelve 1.0

 *

 * @param WP_Customize_Manager $wp_customize Customizer object.

 * @return void

 */

function twentytwelve_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}

add_action( 'customize_register', 'twentytwelve_customize_register' );



/**

 * Enqueue Javascript postMessage handlers for the Customizer.

 *

 * Binds JS handlers to make the Customizer preview reload changes asynchronously.

 *

 * @since Twenty Twelve 1.0

 *

 * @return void

 */

function twentytwelve_customize_preview_js() {

	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );

}

add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );



class BlogWidget extends WP_Widget {

    /** constructor */

    function BlogWidget() {

		$widget_ops = array('classname' => 'blog blogwidget', 'description' => 'Displays Latest Blog' );

		$this->WP_Widget('BlogWidget',"BLOG", $widget_ops);	

    }

    /** @see WP_Widget::widget */

    function widget($args, $instance) {		

      extract( $args );

		$title = esc_attr($instance['title']);				

		$num_blogs = esc_attr($instance['num_blogs']);

		//$readmore = esc_attr($instance['readmore']);

		 if(empty($num_blogs))

		 {

		 $num_blogs=3;

		 }

     ?>

     <?php echo $before_widget; ?>



     <?php if ( $title ){

                 echo $before_title;
				 ?>
				 <a href="<?php echo network_site_url(); ?>blog">
				 <?php echo $title; ?>
                 </a>
                 <?php echo $after_title;
                 

	   					}

                  ?>

                  <?php

			global $switched;

			switch_to_blog(1); ?>

          <?php

					$args=array(post_type=>'post',posts_per_page=>$num_blogs,order => DESC);

					query_posts( $args );

					?>

					<div class="box_wrapper_blogs">

					 <?php if(have_posts()) : ?>

					<?php while(have_posts()) : the_post(); ?>

						<div class="box">

                        	<div class="thumb-img">

                            <?php //Featured Image Code

								if(has_post_thumbnail())

								{

								 $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");

								}

			                 	?>

       						  <img src="<?php echo $thumbnail[0];?>" alt="<?php the_title();?>" />

                            </div>

							<div class="title">

                            <div class="date"><?php the_time('n/j/y') ?></div>

                            <a target="_blank" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                            </div>

							<div class="clrs"></div>

						</div> <!-- .box -->

           		<?php endwhile; ?>

                <?php endif; ?>	

				 <?php wp_reset_query();?>

				 </div>

                 <?php restore_current_blog();?>

         <?php echo $after_widget; ?>

        <?php

    }

    /** @see WP_Widget::update */

    function update($new_instance, $old_instance) {				

	$instance = $old_instance;

	$instance['title'] = strip_tags($new_instance['title']);

	$instance['num_blogs'] = strip_tags($new_instance['num_blogs']);

     return $instance;

    }

    /** @see WP_Widget::form */

    function form($instance) {

		$title = esc_attr($instance['title']);				

		$num_blogs = esc_attr($instance['num_blogs']);

		 if(empty($num_blogs))

		 {

		 $num_blogs=3;

		 }

    ?>

<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

<p><label for="<?php echo $this->get_field_id('num_blogs'); ?>">No of Blog Posts<input class="widefat" id="<?php echo $this->get_field_id('num_blogs'); ?>" name="<?php echo $this->get_field_name('num_blogs'); ?>" type="text" value="<?php echo $num_blogs; ?>" /></label></p>

<?php 

}

}

add_action('widgets_init', create_function('', 'return register_widget("BlogWidget");'));





class LogoWidget extends WP_Widget {

    /** constructor */

    function LogoWidget() {

		$widget_ops = array('classname' => 'logowidget', 'description' => 'Displays Logo' );

		$this->WP_Widget('LogoWidget',"Logo", $widget_ops);	

    }

    /** @see WP_Widget::widget */

    function widget($args, $instance) {		

      extract( $args );

		$logourl = esc_attr($instance['logourl']);

		$logoalt = esc_attr($instance['logoalt']);

     ?>

     <?php echo $before_widget; ?>

		  	<img src="<?php bloginfo('url'); ?>/<?php echo $logourl; ?>" alt="<?php echo $logoalt; ?>" />

         <?php echo $after_widget; ?>

        <?php

    }

    /** @see WP_Widget::update */

    function update($new_instance, $old_instance) {				

	$instance = $old_instance;

	$instance['logourl'] = strip_tags($new_instance['logourl']);

	$instance['logoalt'] = strip_tags($new_instance['logoalt']);

     return $instance;

    }

    /** @see WP_Widget::form */

    function form($instance) {

		$logourl = esc_attr($instance['logourl']);

		$logoalt = esc_attr($instance['logoalt']);

    ?>

<p><label for="<?php echo $this->get_field_id('logourl'); ?>">Logo Image URL<input class="widefat" id="<?php echo $this->get_field_id('logourl'); ?>" name="<?php echo $this->get_field_name('logourl'); ?>" type="text" value="<?php echo $logourl; ?>" /></label></p>

<p><label for="<?php echo $this->get_field_id('logoalt'); ?>">Logo Alt Text<input class="widefat" id="<?php echo $this->get_field_id('logoalt'); ?>" name="<?php echo $this->get_field_name('logoalt'); ?>" type="text" value="<?php echo $logoalt; ?>" /></label></p>

<?php 

}

}

/* To display the full TinyMCE text editor so you have access to all of the advanced features  */
function enable_more_buttons($buttons) {

$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'styleselect';
$buttons[] = 'backcolor';
$buttons[] = 'cut';
$buttons[] = 'copy';
$buttons[] = 'charmap';
$buttons[] = 'hr';

return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons");

/* To keep the kitchen sink always on */

add_filter( 'tiny_mce_before_init', 'myformatTinyMCE' );
function myformatTinyMCE( $in ) {

$in['wordpress_adv_hidden'] = FALSE;

return $in;
}

function upcoming_events_code(){
dynamic_sidebar('sidebar-events');
}

add_action( 'tribe_events_before_the_title', 'upcoming_events_code' );

/*
add_action( 'init', 'events_post_type' );
function events_post_type() {
	register_post_type( 'events-post',
		array(
			'labels' => array(
			'name' => __( 'Events'),
			'singular_name' => __( 'Event'),
			'add_new' => __('Add Event'),
		    'add_new_item' => __('Add New Event'),
			'edit_item' => __('Edit Event'),
		    'new_item' => __('New Event'),
		    'all_items' => __('All Events'),
		    'view_item' => __('View Event')
			),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true,
	'menu_position' => 5, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false,
    'rewrite' => array('slug' => 'events'),
    'supports' => array('title','editor','thumbnail','excerpt','custom-fields'),
    ));
    flush_rewrite_rules();
}

add_action( 'admin_menu', 'my_remove_menu_pages' );

function my_remove_menu_pages() {
    remove_menu_page('edit.php');
}

class EventsWidget extends WP_Widget {
    function EventsWidget() {
		$widget_ops = array('classname' => 'widget_events', 'description' => 'Displays Upcoming Events' );
		$this->WP_Widget('EventsWidget',"Events Widget", $widget_ops);	
    }
    function widget($args, $instance) {		
      extract( $args );
		$title = esc_attr($instance['title']);				
     ?>
     <?php echo $before_widget; ?>
      <?php echo $before_title . $title . $after_title; ?>
      		<div class="events-wrapper">
			            <?php
							$blogtime = date('Y');
							$prev_limit_year = $blogtime - 1;
							$prev_month = '';
							$prev_year = '';
							$args = array(
									'post_type'	=> 'events-post',
									'posts_per_page' => 2,
									'post_status' => 'future',
									'order' => 'ASC'
									  );
							$postsbymonth = new WP_Query($args);
							while($postsbymonth->have_posts()) {
								$postsbymonth->the_post();
								
								if(get_the_time('F') != $prev_month || get_the_time('Y') != $prev_year && get_the_time('Y') == $prev_limit_year) {
									   #echo "<h2>".get_the_time('F')."</h2>\n\n";
								}
							   $mykey_values1 = get_post_custom_values('event_date');
							   if($mykey_values1 != '') {
							   foreach ( $mykey_values1 as $key => $value1 ) {
								$eventDate = DateTime::createFromFormat('Ymd', $value1);
								$current_date = strtotime( $value1 );
							   }  
							   }
								//$currentDate = new DateTime();
								$currentDate = date('M d, Y');
 								$currentDate = strtotime( $currentDate );
								if ($current_date > $currentDate){
								?>
							<div class="evennts_post">
                            <div class="event_title">&#149; <a href="<?php the_permalink(); ?>"><?php the_time('l, F jS'); ?> - <?php the_title(); ?></a></div>
                            <div class="event_details"><?php the_content(); ?></div>
						<div class="clrs"></div>
                        </div>
							<?php
								}
								$prev_month = get_the_time('F');
								$prev_year = get_the_time('Y');
							}
							wp_reset_query();
        ?>	            
        <div class="moreevents"><a class="more" href="<?php bloginfo('url'); ?>/events">Click Here For More Events</a></div>
		<div class="clrs"></div>
       </div>
         <?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
     return $instance;
    }

    function form($instance) {
		$title = esc_attr($instance['title']);				
        ?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
   <?php 
    }
}
add_action('widgets_init', create_function('', 'return register_widget("EventsWidget");'));
*/