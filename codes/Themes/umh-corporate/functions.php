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

	load_theme_textdomain( 'umh-corporate', get_template_directory() . '/languages' );



	// This theme styles the visual editor with editor-style.css to match the theme style.

	add_editor_style();



	// Adds RSS feed links to <head> for posts and comments.

	add_theme_support( 'automatic-feed-links' );



	// This theme supports a variety of post formats.

	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menu( 'primary', __( 'Primary Menu', 'umh-corporate' ) );



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

	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'umh-corporate' ) ) {

		$subsets = 'latin,latin-ext';



		/* translators: To add an additional Open Sans character subset specific to your language,

		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.

		 */

		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'umh-corporate' );



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

		$title = "$title $sep " . sprintf( __( 'Page %s', 'umh-corporate' ), max( $paged, $page ) );



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

		'name' => __( 'Community Sidebar', 'umh-corporate' ),

		'id' => 'sidebar-1',

		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );



	register_sidebar( array(

		'name' => __( 'Header Tagline Widget Area', 'umh-corporate' ),

		'id' => 'header-tagline',

		'description' => __( 'Appears on Header for Tagline', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );



	register_sidebar( array(

		'name' => __( 'Header Social Widget Area', 'umh-corporate' ),

		'id' => 'header-social',

		'description' => __( 'Appears on Header for Social Icons', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );

	

		register_sidebar( array(

		'name' => __( 'Header Print Widget Area', 'umh-corporate' ),

		'id' => 'header-print',

		'description' => __( 'Appears on Header for Print and Font Resize Icons', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );



		register_sidebar( array(

		'name' => __( 'Take A Tour Form Widget', 'umh-corporate' ),

		'id' => 'take-a-tour-form',

		'description' => __( 'Appears next to slider for take a tour short form', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );

	

		register_sidebar( array(

		'name' => __( 'Home Page Content Top Widget', 'umh-corporate' ),

		'id' => 'home-page-top',

		'description' => __( 'Appears on home page to display top content', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h1 class="widget-title">',

		'after_title' => '</h1>',

	) );



		register_sidebar( array(

		'name' => __( 'Home Content Bottom Box One', 'umh-corporate' ),

		'id' => 'home-page-bottom-one',

		'description' => __( 'Appears on home page to display bottom content left side', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );

	

	register_sidebar( array(

		'name' => __( 'Home Content Bottom Box Two', 'umh-corporate' ),

		'id' => 'home-page-bottom-two',

		'description' => __( 'Appears on home page to display bottom content middle', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );	

	

	register_sidebar( array(

		'name' => __( 'Home Content Bottom Box Three', 'umh-corporate' ),

		'id' => 'home-page-bottom-three',

		'description' => __( 'Appears on home page to display bottom content right side', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );

		register_sidebar( array(

		'name' => __( 'Home Footer Top', 'umh-corporate' ),

		'id' => 'home-footer-top',

		'description' => __( 'Appears on home page above footer', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );

	

		register_sidebar( array(

		'name' => __( 'Footer Sidebar Widget Area', 'umh-corporate' ),

		'id' => 'footer-sidebar',

		'description' => __( 'Appears in footer', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<h2 class="widget-title">',

		'after_title' => '</h2>',

	) );

	

		register_sidebar( array(

		'name' => __( 'Footer Copyrights Widget Area', 'umh-corporate' ),

		'id' => 'footer-copyrights',

		'description' => __( 'Appears below footer widgets', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );	

		register_sidebar( array(

		'name' => __( 'Inner Sidebar', 'umh-corporate' ),

		'id' => 'sidebar-inner',

		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

	) );
	
		register_sidebar( array(

		'name' => __( 'Blog Sidebar', 'umh-corporate' ),

		'id' => 'sidebar-blog',

		'description' => __( 'Appears on Blog and associate templates, which has its own widgets', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div class="widget-title">',

		'after_title' => '</div>',

	) );
	
	register_sidebar( array(

		'name' => __( 'Map Sidebar', 'umh-corporate' ),

		'id' => 'sidebar-map',

		'description' => __( 'Appears on Community page for map', 'umh-corporate' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget' => '</aside>',

		'before_title' => '<div style="display: none;" class="widget-title">',

		'after_title' => '</div>',

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

			<h3 class="assistive-text"><?php _e( 'Post navigation', 'umh-corporate' ); ?></h3>

			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'umh-corporate' ) ); ?></div>

			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'umh-corporate' ) ); ?></div>

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

		<p><?php _e( 'Pingback:', 'umh-corporate' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'umh-corporate' ), '<span class="edit-link">', '</span>' ); ?></p>

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

						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'umh-corporate' ) . '</span>' : ''

					);

					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',

						esc_url( get_comment_link( $comment->comment_ID ) ),

						get_comment_time( 'c' ),

						/* translators: 1: date, 2: time */

						sprintf( __( '%1$s at %2$s', 'umh-corporate' ), get_comment_date(), get_comment_time() )

					);

				?>

			</header><!-- .comment-meta -->



			<?php if ( '0' == $comment->comment_approved ) : ?>

				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'umh-corporate' ); ?></p>

			<?php endif; ?>



			<section class="comment-content comment">

				<?php comment_text(); ?>

				<?php edit_comment_link( __( 'Edit', 'umh-corporate' ), '<p class="edit-link">', '</p>' ); ?>

			</section><!-- .comment-content -->



			<div class="reply">

				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'umh-corporate' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

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

	$categories_list = get_the_category_list( __( ', ', 'umh-corporate' ) );



	// Translators: used between list items, there is a space after the comma.

	$tag_list = get_the_tag_list( '', __( ', ', 'umh-corporate' ) );



	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',

		esc_url( get_permalink() ),

		esc_attr( get_the_time() ),

		esc_attr( get_the_date( 'c' ) ),

		esc_html( get_the_date() )

	);



	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',

		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),

		esc_attr( sprintf( __( 'View all posts by %s', 'umh-corporate' ), get_the_author() ) ),

		get_the_author()

	);



	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.

	if ( $tag_list ) {

		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'umh-corporate' );

	} elseif ( $categories_list ) {

		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'umh-corporate' );

	} else {

		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'umh-corporate' );

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
                 <?php
				$posts_page_id = get_option( 'page_for_posts');
				$posts_page = get_page( $posts_page_id);
				$posts_page_title = $posts_page->post_title;
				$posts_page_url = get_page_uri($posts_page_id  );
				?>
				 <a href="<?php echo $posts_page_url; ?>">
				 <?php echo $title; ?>
                 </a>
                 <?php echo $after_title;
                 

	   					}

                  ?>

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

                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                            </div>

							<div class="clrs"></div>

						</div> <!-- .box -->

           		<?php endwhile; ?>

                <?php endif; ?>	

				 <?php wp_reset_query();?>

				 </div>

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



class FullServiceCommunityWidget extends WP_Widget {
    function FullServiceCommunityWidget() {
		$widget_ops = array('classname' => 'communitywidget', 'description' => 'Displays Full Service Community Information' );
		$this->WP_Widget('FullServiceCommunityWidget',"Full Service Communities", $widget_ops);	
    }
    function widget($args, $instance) {		
      extract( $args );
		$title = esc_attr($instance['title']);				
		$community_name = esc_attr($instance['community_name']);
		$county_name = esc_attr($instance['county_name']);
		$city_name = esc_attr($instance['city_name']);
		$phone_no = esc_attr($instance['phone_no']);
		$county_url = esc_attr($instance['county_url']);
     ?>
     <?php echo $before_widget; ?>
					<div class="box_wrapper_communities">
						<div class="community_wrapper">
                        	<div class="community">
                            	<?php if($county_url){ ?>
									<a href="<?php echo $county_url; ?>">
										<?php echo $community_name; ?>
                                    </a>
                                 <?php } ?>   
                                  <span> <?php echo $county_name; ?></span>
                            </div>
                            <div class="city">
                            	<?php echo $city_name; ?>
                            </div>
                            <div class="phoneno">
                            	<?php echo $phone_no; ?>
                                <?php if($county_url){ ?>
                                <a class="bulltet-rights" href="<?php echo $county_url; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/blue-bullet.png" /></a>
                           <div class="clrs"></div>
                           <?php } ?>
                           </div>
                        </div>
				 </div>
         <?php echo $after_widget; ?>
        <?php
    }
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['community_name'] = strip_tags($new_instance['community_name']);
	$instance['county_name'] = strip_tags($new_instance['county_name']);
	$instance['city_name'] = strip_tags($new_instance['city_name']);
	$instance['phone_no'] = strip_tags($new_instance['phone_no']);
	$instance['county_url'] = strip_tags($new_instance['county_url']);
    return $instance;
    }
    function form($instance) {
		$title = esc_attr($instance['title']);				
		$community_name = esc_attr($instance['community_name']);
		$county_name = esc_attr($instance['county_name']);
		$city_name = esc_attr($instance['city_name']);
		$phone_no = esc_attr($instance['phone_no']);
		$county_url = esc_attr($instance['county_url']);
    ?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('community_name'); ?>">Community Name:<input class="widefat" id="<?php echo $this->get_field_id('community_name'); ?>" name="<?php echo $this->get_field_name('community_name'); ?>" type="text" value="<?php echo $community_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('county_name'); ?>">County Name:<input class="widefat" id="<?php echo $this->get_field_id('county_name'); ?>" name="<?php echo $this->get_field_name('county_name'); ?>" type="text" value="<?php echo $county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('city_name'); ?>">City Name:<input class="widefat" id="<?php echo $this->get_field_id('city_name'); ?>" name="<?php echo $this->get_field_name('city_name'); ?>" type="text" value="<?php echo $city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('phone_no'); ?>">Phone No:<input class="widefat" id="<?php echo $this->get_field_id('phone_no'); ?>" name="<?php echo $this->get_field_name('phone_no'); ?>" type="text" value="<?php echo $phone_no; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('county_url'); ?>">County Link:<input class="widefat" id="<?php echo $this->get_field_id('county_url'); ?>" name="<?php echo $this->get_field_name('county_url'); ?>" type="text" value="<?php echo $county_url; ?>" /></label></p>
<?php 
}
}
add_action('widgets_init', create_function('', 'return register_widget("FullServiceCommunityWidget");'));

class AffordableHousingCommunityWidget extends WP_Widget {
    function AffordableHousingCommunityWidget() {
		$widget_ops = array('classname' => 'affordablecommunitywidget', 'description' => 'Displays Affordable Housing Community Information' );
		$this->WP_Widget('AffordableHousingCommunityWidget',"Affordable Housing Communities", $widget_ops);	
    }
    function widget($args, $instance) {		
      extract( $args );
		$title = esc_attr($instance['title']);				
		$community_name = esc_attr($instance['community_name']);
		$county_name = esc_attr($instance['county_name']);
		$city_name = esc_attr($instance['city_name']);
		$phone_no = esc_attr($instance['phone_no']);
		$county_url = esc_attr($instance['county_url']);
     ?>
     <?php echo $before_widget; ?>
					<div class="box_wrapper_communities affordable">
						<div class="community_wrapper">
                        	<div class="community">
                            	<?php if($county_url){ ?>
									<a href="<?php echo $county_url; ?>">
										<?php echo $community_name; ?>
                                    </a>
                                 <?php } ?>   
                                    <span> <?php echo $county_name; ?></span>
                            </div>
                            <div class="city">
                            	<?php echo $city_name; ?>
                            </div>
                            <div class="phoneno">
                            	<?php echo $phone_no; ?>
                                <?php if($county_url){ ?>
                                <a class="bulltet-rights" href="<?php echo $county_url; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/red-bullet.png" /></a>
                           <div class="clrs"></div>
                           <?php } ?>
                            </div>
                        </div>
				 </div>
         <?php echo $after_widget; ?>
        <?php
    }
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['community_name'] = strip_tags($new_instance['community_name']);
	$instance['county_name'] = strip_tags($new_instance['county_name']);
	$instance['city_name'] = strip_tags($new_instance['city_name']);
	$instance['phone_no'] = strip_tags($new_instance['phone_no']);
	$instance['county_url'] = strip_tags($new_instance['county_url']);
    return $instance;
    }
    function form($instance) {
		$title = esc_attr($instance['title']);				
		$community_name = esc_attr($instance['community_name']);
		$county_name = esc_attr($instance['county_name']);
		$city_name = esc_attr($instance['city_name']);
		$phone_no = esc_attr($instance['phone_no']);
		$county_url = esc_attr($instance['county_url']);
    ?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('community_name'); ?>">Community Name:<input class="widefat" id="<?php echo $this->get_field_id('community_name'); ?>" name="<?php echo $this->get_field_name('community_name'); ?>" type="text" value="<?php echo $community_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('county_name'); ?>">County Name:<input class="widefat" id="<?php echo $this->get_field_id('county_name'); ?>" name="<?php echo $this->get_field_name('county_name'); ?>" type="text" value="<?php echo $county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('city_name'); ?>">City Name:<input class="widefat" id="<?php echo $this->get_field_id('city_name'); ?>" name="<?php echo $this->get_field_name('city_name'); ?>" type="text" value="<?php echo $city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('phone_no'); ?>">Phone No:<input class="widefat" id="<?php echo $this->get_field_id('phone_no'); ?>" name="<?php echo $this->get_field_name('phone_no'); ?>" type="text" value="<?php echo $phone_no; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('county_url'); ?>">County Link:<input class="widefat" id="<?php echo $this->get_field_id('county_url'); ?>" name="<?php echo $this->get_field_name('county_url'); ?>" type="text" value="<?php echo $county_url; ?>" /></label></p>
<?php 
}
}
add_action('widgets_init', create_function('', 'return register_widget("AffordableHousingCommunityWidget");'));


class CommunityMapWidget extends WP_Widget {
    function CommunityMapWidget() {
		$widget_ops = array('classname' => 'communitymapwidget', 'description' => 'Displays Community Map Information' );
		$this->WP_Widget('CommunityMapWidget',"Communities Map", $widget_ops);	
    }
    function widget($args, $instance) {		
      extract( $args );
		$title = esc_attr($instance['title']);	
					
		$newton_alt = esc_attr($instance['newton_alt']);
		$newton_link = esc_attr($instance['newton_link']);
		$newton_county_name = esc_attr($instance['newton_county_name']);
		$newton_city_name = esc_attr($instance['newton_city_name']);
		$newton_phone = esc_attr($instance['newton_phone']);
		
		$collingswood_alt = esc_attr($instance['collingswood_alt']);
		$collingswood_link = esc_attr($instance['collingswood_link']);
		$collingswood_county_name = esc_attr($instance['collingswood_county_name']);
		$collingswood_city_name = esc_attr($instance['collingswood_city_name']);
		$collingswood_phone = esc_attr($instance['collingswood_phone']);

		$east_orange_alt = esc_attr($instance['east_orange_alt']);
		$east_orange_link = esc_attr($instance['east_orange_link']);
		$east_orange_county_name = esc_attr($instance['east_orange_county_name']);
		$east_orange_city_name = esc_attr($instance['east_orange_city_name']);
		$east_orange_phone = esc_attr($instance['east_orange_phone']);

		$montclair_alt = esc_attr($instance['montclair_alt']);
		$montclair_link = esc_attr($instance['montclair_link']);
		$montclair_county_name = esc_attr($instance['montclair_county_name']);
		$montclair_city_name = esc_attr($instance['montclair_city_name']);
		$montclair_phone = esc_attr($instance['montclair_phone']);
		
		$ocean_city_alt = esc_attr($instance['ocean_city_alt']);
		$ocean_city_link = esc_attr($instance['ocean_city_link']);
		$ocean_city_county_name = esc_attr($instance['ocean_city_county_name']);
		$ocean_city_city_name = esc_attr($instance['ocean_city_city_name']);
		$ocean_city_phone = esc_attr($instance['ocean_city_phone']);

		$ocean_city_red_alt = esc_attr($instance['ocean_city_red_alt']);
		$ocean_city_red_link = esc_attr($instance['ocean_city_red_link']);
		$ocean_city_red_county_name = esc_attr($instance['ocean_city_red_county_name']);
		$ocean_city_red_city_name = esc_attr($instance['ocean_city_red_city_name']);
		$ocean_city_red_phone = esc_attr($instance['ocean_city_red_phone']);

		$ocean_grove_alt = esc_attr($instance['ocean_grove_alt']);
		$ocean_grove_link = esc_attr($instance['ocean_grove_link']);
		$ocean_grove_county_name = esc_attr($instance['ocean_grove_county_name']);
		$ocean_grove_city_name = esc_attr($instance['ocean_grove_city_name']);
		$ocean_grove_phone = esc_attr($instance['ocean_grove_phone']);
		
		$pitman_alt = esc_attr($instance['pitman_alt']);
		$pitman_link = esc_attr($instance['pitman_link']);
		$pitman_county_name = esc_attr($instance['pitman_county_name']);
		$pitman_city_name = esc_attr($instance['pitman_city_name']);
		$pitman_phone = esc_attr($instance['pitman_phone']);
		
		$plainfield_alt = esc_attr($instance['plainfield_alt']);
		$plainfield_link = esc_attr($instance['plainfield_link']);
		$plainfield_county_name = esc_attr($instance['plainfield_county_name']);
		$plainfield_city_name = esc_attr($instance['plainfield_city_name']);
		$plainfield_phone = esc_attr($instance['plainfield_phone']);
		
		$red_bank_alt = esc_attr($instance['red_bank_alt']);
		$red_bank_link = esc_attr($instance['red_bank_link']);
		$red_bank_county_name = esc_attr($instance['red_bank_county_name']);
		$red_bank_city_name = esc_attr($instance['red_bank_city_name']);
		$red_bank_phone = esc_attr($instance['red_bank_phone']);		
     ?>
     <?php echo $before_widget; ?>
			<div id="mapinfo">
                        <img src="<?php bloginfo('template_url'); ?>/images/location-map.png" id="new-jersey" usemap="#new-jersey" alt="" height="683" width="407">
                          <map name="new-jersey">
                            <area shape="poly" coords="274,52,205,14,201,13,198,15,193,15,191,16,188,20,184,20,182,21,182,25,179,26,176,29,173,32,172,35,171,39,168,42,166,44,166,47,168,49,165,53,164,56,162,59,159,62,157,65,155,69,150,71,146,75,142,78,139,79,138,83,142,82,185,129,189,130,191,130,194,128,196,131,200,134,203,133,207,131,212,128,216,123,215,120,215,117,215,116,274,53" href="#" alt="<?php echo $newton_alt; ?>">
                            <area shape="poly" coords="193,445,162,477,160,475,157,472,156,468,156,462,153,458,150,455,146,455,143,454,140,452,137,450,134,448,131,446,130,445,130,442,130,440,127,436,125,432,121,428,118,425,114,422,116,419,116,417,116,415,113,412,109,407,105,404,107,400,107,398,105,395,104,391,105,388,107,384,111,383,114,383,118,380,121,377,123,376,125,376,128,375,131,377,132,380,130,383,131,387,133,390,136,390,141,390,139,393,138,394,142,395,144,398,148,402,151,406,152,411,153,418,155,425,156,430,159,433,163,432,166,431,172,431,176,431,181,435,186,441" href="#" alt="<?php echo $collingswood_alt; ?>">
                            <area shape="poly" coords="162,478,157,474,155,471,155,468,155,464,155,461,151,457,149,455,145,455,140,454,138,452,135,449,132,447,130,445,129,440,126,437,124,433,120,429,117,425,115,422,115,417,114,414,110,410,105,406,103,405,101,407,99,406,94,405,93,407,90,410,85,412,81,414,76,414,71,415,69,415,64,413,61,414,56,418,50,423,45,425,45,429,44,430,46,431,47,433,45,436,47,438,50,440,52,441,52,444,52,446,53,448,55,449,56,450,58,451,61,452,62,454,63,456,66,457,69,457,71,457,74,459,77,459,79,461,81,463,83,465,87,464,90,464,138,503" href="#" alt="<?php echo $pitman_alt; ?>">
                            <area shape="poly" coords="210,562,206,563,203,564,202,564,200,563,199,563,196,561,195,560,191,562,189,562,188,560,185,560,182,558,178,559,174,559,172,557,168,556,165,555,163,557,161,559,161,563,160,566,160,571,159,576,157,579,153,580,152,581,152,584,151,587,153,590,154,594,159,599,159,601,161,605,160,608,159,611,159,616,157,619,155,623,154,627,152,630,150,632,148,635,147,639,146,642,145,645,144,647,144,651,144,655,143,659,148,660,153,658,161,656,156,655,156,652,160,652,158,650,160,647,162,645,166,643,170,645,171,648,168,650,166,651,166,654,170,651,173,648,177,645,181,641,180,639,179,637,179,635,179,632,181,630,184,629,185,627,185,624,185,621,182,620,180,617,181,614,184,613,187,613,189,614,190,618,189,620,189,621,191,622,191,624,188,627,189,629,193,624,195,619,198,615,198,614,195,613,194,613,193,611,191,609,193,607,195,606,196,603,198,602,199,605,202,603,205,600,209,595,210,592,209,590,208,587,211,586,212,584,216,583,219,580,221,576,223,573,227,570,230,568,234,566,233,563,231,564,228,565,225,566,223,568,221,571,220,573,218,575,216,574,216,571,218,568,218,565,213,565" href="#" alt="<?php echo $ocean_city_alt; ?>">
                            <area shape="poly" coords="324,192,321,191,316,192,313,192,312,189,310,186,306,186,303,185,299,183,295,181,291,184,289,184,286,183,284,182,279,179,276,176,267,184,264,187,260,190,257,192,255,195,258,198,262,196,266,196,267,198,267,201,266,205,265,208,262,210,255,214,264,214,272,214,282,213,288,211,290,213,292,215,294,216,297,216,300,214,304,212,310,213,310,210,311,205,311,203,314,201,318,200,320,200,323,196" href="#" alt="<?php echo $plainfield_alt; ?>">
                            <area shape="poly" coords="364,284,361,288,357,290,356,290,353,289,351,287,353,284,357,282,360,280,361,278,359,276,355,276,352,278,349,279,346,281,344,281,343,279,343,277,347,276,350,274,354,270,357,270,360,272,361,270,359,267,358,266,354,265,350,265,346,264,341,261,337,259,332,257,329,254,326,254,324,256,322,256,320,254,317,254,314,257,313,258,309,259,308,256,306,255,302,257,303,262,302,267,286,282,272,296,270,298,269,301,261,305,254,307,251,306,249,311,246,312,241,315,239,316,236,319,234,321,232,325,227,325,225,326,222,324,221,327,236,352,260,334,264,330,267,328,276,329,281,329,288,329,297,329,299,329,301,334,304,337,304,340,303,342,306,345,309,345,311,343,315,343,317,344,320,345,323,348,333,338,338,342,339,345,340,347,342,348,344,347,345,346,351,346,350,343,351,339,351,335,353,332,353,328,351,329,348,328,344,326,343,323,346,323,350,323,354,324,357,318,361,302,363,292" href="#" alt="<?php echo $red_bank_alt; ?>">
                            <area shape="poly" coords="327,155,315,147,310,143,305,140,303,137,301,139,299,138,297,136,295,136,293,134,291,132,288,133,286,132,282,133,283,136,281,138,283,141,286,143,285,145,285,149,285,153,283,156,281,159,277,160,276,162,275,165,275,169,276,173,277,176,280,178,283,181,286,183,291,185,294,180,297,181,300,183,304,184,306,184,309,185,311,186,313,189,315,191,317,191,319,190,323,190,324,192,328,188,329,185,330,182,331,179,330,177,328,176,325,177,324,177,322,177,320,177,319,175,319,173,319,171,323,167,327,160" href="#" alt="<?php echo $east_orange_alt; ?>">
                            <area shape="poly" coords="334,141,331,139,328,136,328,132,328,129,327,127,326,127,326,124,326,123,324,122,327,119,324,115,322,113,318,115,314,114,307,112,303,109,300,105,297,101,310,72,276,53,247,83,249,86,249,87,247,91,246,94,247,98,248,97,250,95,253,93,254,92,257,92,259,93,261,95,261,99,264,100,265,100,267,100,272,103,274,105,276,104,278,103,281,105,284,106,288,106,291,106,292,109,291,110,293,113,295,114,296,116,296,119,295,122,295,124,293,125,294,128,299,130,298,133,297,134,300,138,302,136,325,153,329,156,331,154,330,152,329,149,329,147,331,145" href="#" alt="<?php echo $montclair_alt; ?>">
                          </map>

                            <a href="<?php echo $newton_link; ?>">
	                            <img alt="<?php echo $newton_alt; ?>s" class="newton-img pins" src='<?php bloginfo('template_url'); ?>/images/newton.png' />
    						</a>
                            <a href="<?php echo $collingswood_link; ?>">
                           	 <img alt="<?php echo $collingswood_alt; ?>s" class="collingswood-img pins" src='<?php bloginfo('template_url'); ?>/images/collingswood.png' />
                            </a>
                            <a href="<?php echo $east_orange_link; ?>">
                            <img alt="<?php echo $east_orange_alt; ?>s" class="east-orange-img pins" src='<?php bloginfo('template_url'); ?>/images/east-orange.png' />
                            </a>
                            <a href="<?php echo $montclair_link; ?>">
	                            <img alt="<?php echo $montclair_alt; ?>s" class="montclair-img pins" src='<?php bloginfo('template_url'); ?>/images/montclair.png' />
    						</a>
                            <a href="<?php echo $ocean_city_link; ?>">
                            	<img alt="<?php echo $ocean_city_alt; ?>s" class="ocean-city-img pins" src='<?php bloginfo('template_url'); ?>/images/ocean-city.png' />
                            </a>
                            <a href="<?php echo $ocean_city_red_link; ?>">
                            	<img alt="<?php echo $ocean_city_red_alt; ?>s" class="ocean-city-img ocean-city-red-img pins" src='<?php bloginfo('template_url'); ?>/images/ocean-city-red.png' />
                            </a>
                            <a href="<?php echo $ocean_grove_link; ?>">
                            	<img alt="<?php echo $ocean_grove_alt; ?>s" class="ocean-grove-img pins" src='<?php bloginfo('template_url'); ?>/images/ocean-grove.png' />
                            </a>
                            <a href="<?php echo $pitman_link; ?>">
                            	<img alt="<?php echo $pitman_alt; ?>s" class="pitman-img pins" src='<?php bloginfo('template_url'); ?>/images/pitman.png' />
                            </a>
                            <a href="<?php echo $plainfield_link; ?>">
                            	<img alt="<?php echo $plainfield_alt; ?>s" class="plainfield-img pins" src='<?php bloginfo('template_url'); ?>/images/plainfield.png' />
                            </a>
                            <a href="<?php echo $red_bank_link; ?>">
                            <img alt="<?php echo $red_bank_alt; ?>s" class="ocean-grove-img red-bank-img pins" src='<?php bloginfo('template_url'); ?>/images/red-bank.png' />
                            </a>
                            
                            
                            <div class="mapcontent">
                            <div class="newton" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $newton_county_name; ?></div>
                            <div class="city-name"><?php echo $newton_city_name; ?></div>
                            <div class="phone-number"><?php echo $newton_phone; ?></div>
                            </div>
                            <div class="collingswood" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $collingswood_county_name; ?></div>
                            <div class="city-name"><?php echo $collingswood_city_name; ?></div>
                            <div class="phone-number"><?php echo $collingswood_phone; ?></div>
                            </div>
                            <div class="east-orange" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $east_orange_county_name; ?></div>
                            <div class="city-name"><?php echo $east_orange_city_name; ?></div>
                            <div class="phone-number"><?php echo $east_orange_phone; ?></div>
                            </div>
                            <div class="montclair" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $montclair_county_name; ?></div>
                            <div class="city-name"><?php echo $montclair_city_name; ?></div>
                            <div class="phone-number"><?php echo $montclair_phone; ?></div>
                            </div>
                            <div class="ocean-city" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $ocean_city_county_name; ?></div>
                            <div class="city-name"><?php echo $ocean_city_city_name; ?></div>
                            <div class="phone-number"><?php echo $ocean_city_phone; ?></div>
                            </div>
                            <div class="ocean-city ocean-city-red" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $ocean_city_red_county_name; ?></div>
                            <div class="city-name"><?php echo $ocean_city_red_city_name; ?></div>
                            <div class="phone-number"><?php echo $ocean_city_red_phone; ?></div>
                            </div>
                            <div class="red-bank ocean-grove" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $ocean_grove_county_name; ?></div>
                            <div class="city-name"><?php echo $ocean_grove_city_name; ?></div>
                            <div class="phone-number"><?php echo $ocean_grove_phone; ?></div>
                            </div>
                            <div class="pitman" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $pitman_county_name; ?></div>
                            <div class="city-name"><?php echo $pitman_city_name; ?></div>
                            <div class="phone-number"><?php echo $pitman_phone; ?></div>
                            </div>
                            <div class="plainfield" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $plainfield_county_name; ?></div>
                            <div class="city-name"><?php echo $plainfield_city_name; ?></div>
                            <div class="phone-number"><?php echo $plainfield_phone; ?></div>
                            </div>
                            <div class="red-bank" id="maps" style="display: none;">
                            <div class="county-name"><?php echo $red_bank_county_name; ?></div>
                            <div class="city-name"><?php echo $red_bank_city_name; ?></div>
                            <div class="phone-number"><?php echo $red_bank_phone; ?></div>
                            </div>
                            </div>
                            
                            <!-- For Pins -->
                            
                            <div class="mapcontent">
                            <div class="newtons" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $newton_county_name; ?></div>
                            <div class="city-name"><?php echo $newton_city_name; ?></div>
                            <div class="phone-number"><?php echo $newton_phone; ?></div>
                            </div>
                            <div class="collingswoods" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $collingswood_county_name; ?></div>
                            <div class="city-name"><?php echo $collingswood_city_name; ?></div>
                            <div class="phone-number"><?php echo $collingswood_phone; ?></div>
                            </div>
                            <div class="east-oranges" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $east_orange_county_name; ?></div>
                            <div class="city-name"><?php echo $east_orange_city_name; ?></div>
                            <div class="phone-number"><?php echo $east_orange_phone; ?></div>
                            </div>
                            <div class="montclairs" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $montclair_county_name; ?></div>
                            <div class="city-name"><?php echo $montclair_city_name; ?></div>
                            <div class="phone-number"><?php echo $montclair_phone; ?></div>
                            </div>
                            <div class="ocean-citys" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $ocean_city_county_name; ?></div>
                            <div class="city-name"><?php echo $ocean_city_city_name; ?></div>
                            <div class="phone-number"><?php echo $ocean_city_phone; ?></div>
                            </div>
                            <div class="ocean-city-affors" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $ocean_city_red_county_name; ?></div>
                            <div class="city-name"><?php echo $ocean_city_red_city_name; ?></div>
                            <div class="phone-number"><?php echo $ocean_city_red_phone; ?></div>
                            </div>
                            <div class="ocean-groves" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $ocean_grove_county_name; ?></div>
                            <div class="city-name"><?php echo $ocean_grove_city_name; ?></div>
                            <div class="phone-number"><?php echo $ocean_grove_phone; ?></div>
                            </div>
                            <div class="pitmans" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $pitman_county_name; ?></div>
                            <div class="city-name"><?php echo $pitman_city_name; ?></div>
                            <div class="phone-number"><?php echo $pitman_phone; ?></div>
                            </div>
                            <div class="plainfields" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $plainfield_county_name; ?></div>
                            <div class="city-name"><?php echo $plainfield_city_name; ?></div>
                            <div class="phone-number"><?php echo $plainfield_phone; ?></div>
                            </div>
                            <div class="red-banks" id="maps1" style="display: none;">
                            <div class="county-name"><?php echo $red_bank_county_name; ?></div>
                            <div class="city-name"><?php echo $red_bank_city_name; ?></div>
                            <div class="phone-number"><?php echo $red_bank_phone; ?></div>
                            </div>
                            </div>
                            
                            
                            <div class="clrs"></div>
                            </div>
                            <div class="comm-labels">
                            	<div class="full-comm">FULL SERVICE COMMUNITIES</div>
                                <div class="affor-comm">SENIOR HOUSING</div>
                            </div>
							<script src="<?php bloginfo('template_url'); ?>/js/ios-orientationchange-fix.js" type="text/javascript"></script>
                            <script src="<?php bloginfo('template_url'); ?>/js/jquery.rwdImageMaps.js" type="text/javascript"></script> 
                            <script type="text/javascript">
                            jQuery(document).ready(function() {
                            jQuery('img[usemap]').rwdImageMaps();
                                var cityn;
                                jQuery("area").hover(function () {
                                cityn = jQuery(this).attr("alt");
                                var myClass = [];
                                jQuery("#mapinfo #maps").each(function() {
                                myClass = jQuery(this).attr("class");
                                });
                                if(jQuery.inArray(cityn,myClass) < 0){
                                jQuery('.'+cityn).css("display","block");
                                }
                                },function(){
                                jQuery('.'+cityn).css("display","none");
                            });
                                jQuery(".pins").hover(function () {
                                cityn = jQuery(this).attr("alt");
                                var myClass = [];
                                jQuery("#mapinfo #maps1").each(function() {
                                myClass = jQuery(this).attr("class");
                                });
                                if(jQuery.inArray(cityn,myClass) < 0){
                                jQuery('.'+cityn).css("display","block");
                                }
                               },function(){
                                jQuery('.'+cityn).css("display","none");
                            });
                            });
                            </script>
					

     <?php echo $after_widget; ?>
        <?php
    }
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	
	$instance['newton_alt'] = strip_tags($new_instance['newton_alt']);
	$instance['newton_link'] = strip_tags($new_instance['newton_link']);
	$instance['newton_county_name'] = strip_tags($new_instance['newton_county_name']);
	$instance['newton_city_name'] = strip_tags($new_instance['newton_city_name']);
	$instance['newton_phone'] = strip_tags($new_instance['newton_phone']);
	
	$instance['collingswood_alt'] = strip_tags($new_instance['collingswood_alt']);
	$instance['collingswood_link'] = strip_tags($new_instance['collingswood_link']);
	$instance['collingswood_county_name'] = strip_tags($new_instance['collingswood_county_name']);
	$instance['collingswood_city_name'] = strip_tags($new_instance['collingswood_city_name']);
	$instance['collingswood_phone'] = strip_tags($new_instance['collingswood_phone']);
	
	$instance['east_orange_alt'] = strip_tags($new_instance['east_orange_alt']);
	$instance['east_orange_link'] = strip_tags($new_instance['east_orange_link']);
	$instance['east_orange_county_name'] = strip_tags($new_instance['east_orange_county_name']);
	$instance['east_orange_city_name'] = strip_tags($new_instance['east_orange_city_name']);
	$instance['east_orange_phone'] = strip_tags($new_instance['east_orange_phone']);
	
	$instance['montclair_alt'] = strip_tags($new_instance['montclair_alt']);
	$instance['montclair_link'] = strip_tags($new_instance['montclair_link']);
	$instance['montclair_county_name'] = strip_tags($new_instance['montclair_county_name']);
	$instance['montclair_city_name'] = strip_tags($new_instance['montclair_city_name']);
	$instance['montclair_phone'] = strip_tags($new_instance['montclair_phone']);
	
	$instance['ocean_city_alt'] = strip_tags($new_instance['ocean_city_alt']);
	$instance['ocean_city_link'] = strip_tags($new_instance['ocean_city_link']);
	$instance['ocean_city_county_name'] = strip_tags($new_instance['ocean_city_county_name']);
	$instance['ocean_city_city_name'] = strip_tags($new_instance['ocean_city_city_name']);
	$instance['ocean_city_phone'] = strip_tags($new_instance['ocean_city_phone']);
	
	$instance['ocean_city_red_alt'] = strip_tags($new_instance['ocean_city_red_alt']);
	$instance['ocean_city_red_link'] = strip_tags($new_instance['ocean_city_red_link']);
	$instance['ocean_city_red_county_name'] = strip_tags($new_instance['ocean_city_red_county_name']);
	$instance['ocean_city_red_city_name'] = strip_tags($new_instance['ocean_city_red_city_name']);
	$instance['ocean_city_red_phone'] = strip_tags($new_instance['ocean_city_red_phone']);
	
	$instance['ocean_grove_alt'] = strip_tags($new_instance['ocean_grove_alt']);
	$instance['ocean_grove_link'] = strip_tags($new_instance['ocean_grove_link']);
	$instance['ocean_grove_county_name'] = strip_tags($new_instance['ocean_grove_county_name']);
	$instance['ocean_grove_city_name'] = strip_tags($new_instance['ocean_grove_city_name']);
	$instance['ocean_grove_phone'] = strip_tags($new_instance['ocean_grove_phone']);
	
	$instance['pitman_alt'] = strip_tags($new_instance['pitman_alt']);
	$instance['pitman_link'] = strip_tags($new_instance['pitman_link']);
	$instance['pitman_county_name'] = strip_tags($new_instance['pitman_county_name']);
	$instance['pitman_city_name'] = strip_tags($new_instance['pitman_city_name']);
	$instance['pitman_phone'] = strip_tags($new_instance['pitman_phone']);
	
	$instance['plainfield_alt'] = strip_tags($new_instance['plainfield_alt']);
	$instance['plainfield_link'] = strip_tags($new_instance['plainfield_link']);
	$instance['plainfield_county_name'] = strip_tags($new_instance['plainfield_county_name']);
	$instance['plainfield_city_name'] = strip_tags($new_instance['plainfield_city_name']);
	$instance['plainfield_phone'] = strip_tags($new_instance['plainfield_phone']);
	
	$instance['red_bank_alt'] = strip_tags($new_instance['red_bank_alt']);
	$instance['red_bank_link'] = strip_tags($new_instance['red_bank_link']);
	$instance['red_bank_county_name'] = strip_tags($new_instance['red_bank_county_name']);
	$instance['red_bank_city_name'] = strip_tags($new_instance['red_bank_city_name']);
	$instance['red_bank_phone'] = strip_tags($new_instance['red_bank_phone']);
	
    return $instance;
    }
    function form($instance) {
		$title = esc_attr($instance['title']);			
		
		$newton_alt = esc_attr($instance['newton_alt']);
		$newton_link = esc_attr($instance['newton_link']);
		$newton_county_name = esc_attr($instance['newton_county_name']);
		$newton_city_name = esc_attr($instance['newton_city_name']);
		$newton_phone = esc_attr($instance['newton_phone']);
		
		$collingswood_alt = esc_attr($instance['collingswood_alt']);
		$collingswood_link = esc_attr($instance['collingswood_link']);
		$collingswood_county_name = esc_attr($instance['collingswood_county_name']);
		$collingswood_city_name = esc_attr($instance['collingswood_city_name']);
		$collingswood_phone = esc_attr($instance['collingswood_phone']);
		
		$east_orange_alt = esc_attr($instance['east_orange_alt']);
		$east_orange_link = esc_attr($instance['east_orange_link']);
		$east_orange_county_name = esc_attr($instance['east_orange_county_name']);
		$east_orange_city_name = esc_attr($instance['east_orange_city_name']);
		$east_orange_phone = esc_attr($instance['east_orange_phone']);
		
		$montclair_alt = esc_attr($instance['montclair_alt']);
		$montclair_link = esc_attr($instance['montclair_link']);
		$montclair_county_name = esc_attr($instance['montclair_county_name']);
		$montclair_city_name = esc_attr($instance['montclair_city_name']);
		$montclair_phone = esc_attr($instance['montclair_phone']);
		
		$ocean_city_alt = esc_attr($instance['ocean_city_alt']);
		$ocean_city_link = esc_attr($instance['ocean_city_link']);
		$ocean_city_county_name = esc_attr($instance['ocean_city_county_name']);
		$ocean_city_city_name = esc_attr($instance['ocean_city_city_name']);
		$ocean_city_phone = esc_attr($instance['ocean_city_phone']);
		
		$ocean_city_red_alt = esc_attr($instance['ocean_city_red_alt']);
		$ocean_city_red_link = esc_attr($instance['ocean_city_red_link']);
		$ocean_city_red_county_name = esc_attr($instance['ocean_city_red_county_name']);
		$ocean_city_red_city_name = esc_attr($instance['ocean_city_red_city_name']);
		$ocean_city_red_phone = esc_attr($instance['ocean_city_red_phone']);
		
		$ocean_grove_alt = esc_attr($instance['ocean_grove_alt']);
		$ocean_grove_link = esc_attr($instance['ocean_grove_link']);
		$ocean_grove_county_name = esc_attr($instance['ocean_grove_county_name']);
		$ocean_grove_city_name = esc_attr($instance['ocean_grove_city_name']);
		$ocean_grove_phone = esc_attr($instance['ocean_grove_phone']);
		
		$pitman_alt = esc_attr($instance['pitman_alt']);
		$pitman_link = esc_attr($instance['pitman_link']);
		$pitman_county_name = esc_attr($instance['pitman_county_name']);
		$pitman_city_name = esc_attr($instance['pitman_city_name']);
		$pitman_phone = esc_attr($instance['pitman_phone']);
		
		$plainfield_alt = esc_attr($instance['plainfield_alt']);
		$plainfield_link = esc_attr($instance['plainfield_link']);
		$plainfield_county_name = esc_attr($instance['plainfield_county_name']);
		$plainfield_city_name = esc_attr($instance['plainfield_city_name']);
		$plainfield_phone = esc_attr($instance['plainfield_phone']);
		
		$red_bank_alt = esc_attr($instance['red_bank_alt']);
		$red_bank_link = esc_attr($instance['red_bank_link']);
		$red_bank_county_name = esc_attr($instance['red_bank_county_name']);
		$red_bank_city_name = esc_attr($instance['red_bank_city_name']);
		$red_bank_phone = esc_attr($instance['red_bank_phone']);
		
    ?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

<p><label for="Newton"><strong>Newton Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('newton_alt'); ?>">Newton Alt:<input class="widefat" id="<?php echo $this->get_field_id('newton_alt'); ?>" name="<?php echo $this->get_field_name('newton_alt'); ?>" type="text" value="<?php echo $newton_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('newton_link'); ?>">Newton Link:<input class="widefat" id="<?php echo $this->get_field_id('newton_link'); ?>" name="<?php echo $this->get_field_name('newton_link'); ?>" type="text" value="<?php echo $newton_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('newton_county_name'); ?>">Newton County Name:<input class="widefat" id="<?php echo $this->get_field_id('newton_county_name'); ?>" name="<?php echo $this->get_field_name('newton_county_name'); ?>" type="text" value="<?php echo $newton_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('newton_city_name'); ?>">Newton City Name:<input class="widefat" id="<?php echo $this->get_field_id('newton_city_name'); ?>" name="<?php echo $this->get_field_name('newton_city_name'); ?>" type="text" value="<?php echo $newton_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('newton_phone'); ?>">Newton Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('newton_phone'); ?>" name="<?php echo $this->get_field_name('newton_phone'); ?>" type="text" value="<?php echo $newton_phone; ?>" /></label></p>


<p><label for="Collingswood"><strong>Collingswood Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('collingswood_alt'); ?>">Collingswood Alt:<input class="widefat" id="<?php echo $this->get_field_id('collingswood_alt'); ?>" name="<?php echo $this->get_field_name('collingswood_alt'); ?>" type="text" value="<?php echo $collingswood_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('collingswood_link'); ?>">Collingswood Link:<input class="widefat" id="<?php echo $this->get_field_id('collingswood_link'); ?>" name="<?php echo $this->get_field_name('collingswood_link'); ?>" type="text" value="<?php echo $collingswood_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('collingswood_county_name'); ?>">Collingswood County Name:<input class="widefat" id="<?php echo $this->get_field_id('collingswood_county_name'); ?>" name="<?php echo $this->get_field_name('collingswood_county_name'); ?>" type="text" value="<?php echo $collingswood_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('collingswood_city_name'); ?>">Collingswood City Name:<input class="widefat" id="<?php echo $this->get_field_id('collingswood_city_name'); ?>" name="<?php echo $this->get_field_name('collingswood_city_name'); ?>" type="text" value="<?php echo $collingswood_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('collingswood_phone'); ?>">Collingswood Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('collingswood_phone'); ?>" name="<?php echo $this->get_field_name('collingswood_phone'); ?>" type="text" value="<?php echo $collingswood_phone; ?>" /></label></p>

<p><label for="East Orange"><strong>East Orange Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('east_orange_alt'); ?>">East Orange Alt:<input class="widefat" id="<?php echo $this->get_field_id('east_orange_alt'); ?>" name="<?php echo $this->get_field_name('east_orange_alt'); ?>" type="text" value="<?php echo $east_orange_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('east_orange_link'); ?>">East Orange Link:<input class="widefat" id="<?php echo $this->get_field_id('east_orange_link'); ?>" name="<?php echo $this->get_field_name('east_orange_link'); ?>" type="text" value="<?php echo $east_orange_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('east_orange_county_name'); ?>">East Orange County Name:<input class="widefat" id="<?php echo $this->get_field_id('east_orange_county_name'); ?>" name="<?php echo $this->get_field_name('east_orange_county_name'); ?>" type="text" value="<?php echo $east_orange_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('east_orange_city_name'); ?>">East Orange City Name:<input class="widefat" id="<?php echo $this->get_field_id('east_orange_city_name'); ?>" name="<?php echo $this->get_field_name('east_orange_city_name'); ?>" type="text" value="<?php echo $east_orange_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('east_orange_phone'); ?>">East Orange Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('east_orange_phone'); ?>" name="<?php echo $this->get_field_name('east_orange_phone'); ?>" type="text" value="<?php echo $east_orange_phone; ?>" /></label></p>

<p><label for="Montclair"><strong>Montclair Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('montclair_alt'); ?>">Montclair Alt:<input class="widefat" id="<?php echo $this->get_field_id('montclair_alt'); ?>" name="<?php echo $this->get_field_name('montclair_alt'); ?>" type="text" value="<?php echo $montclair_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('montclair_link'); ?>">Montclair Link:<input class="widefat" id="<?php echo $this->get_field_id('montclair_link'); ?>" name="<?php echo $this->get_field_name('montclair_link'); ?>" type="text" value="<?php echo $montclair_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('montclair_county_name'); ?>">Montclair County Name:<input class="widefat" id="<?php echo $this->get_field_id('montclair_county_name'); ?>" name="<?php echo $this->get_field_name('montclair_county_name'); ?>" type="text" value="<?php echo $montclair_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('montclair_city_name'); ?>">Montclair City Name:<input class="widefat" id="<?php echo $this->get_field_id('montclair_city_name'); ?>" name="<?php echo $this->get_field_name('montclair_city_name'); ?>" type="text" value="<?php echo $montclair_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('montclair_phone'); ?>">Montclair Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('montclair_phone'); ?>" name="<?php echo $this->get_field_name('montclair_phone'); ?>" type="text" value="<?php echo $montclair_phone; ?>" /></label></p>

<p><label for="Ocean City"><strong>Ocean City Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_alt'); ?>">Ocean City Alt:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_alt'); ?>" name="<?php echo $this->get_field_name('ocean_city_alt'); ?>" type="text" value="<?php echo $ocean_city_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_link'); ?>">Ocean City Link:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_link'); ?>" name="<?php echo $this->get_field_name('ocean_city_link'); ?>" type="text" value="<?php echo $ocean_city_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_county_name'); ?>">Ocean City County Name:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_county_name'); ?>" name="<?php echo $this->get_field_name('ocean_city_county_name'); ?>" type="text" value="<?php echo $ocean_city_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_city_name'); ?>">Ocean City City Name:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_city_name'); ?>" name="<?php echo $this->get_field_name('ocean_city_city_name'); ?>" type="text" value="<?php echo $ocean_city_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_phone'); ?>">Ocean City Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_phone'); ?>" name="<?php echo $this->get_field_name('ocean_city_phone'); ?>" type="text" value="<?php echo $ocean_city_phone; ?>" /></label></p>

<p><label for="Ocean City Affordable"><strong>Ocean City Affordable Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_red_alt'); ?>">Ocean City Affordable Alt:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_red_alt'); ?>" name="<?php echo $this->get_field_name('ocean_city_red_alt'); ?>" type="text" value="<?php echo $ocean_city_red_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_red_link'); ?>">Ocean City Affordable Link:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_red_link'); ?>" name="<?php echo $this->get_field_name('ocean_city_red_link'); ?>" type="text" value="<?php echo $ocean_city_red_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_red_county_name'); ?>">Ocean City Affordable County Name:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_red_county_name'); ?>" name="<?php echo $this->get_field_name('ocean_city_red_county_name'); ?>" type="text" value="<?php echo $ocean_city_red_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_red_city_name'); ?>">Ocean City Affordable City Name:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_red_city_name'); ?>" name="<?php echo $this->get_field_name('ocean_city_red_city_name'); ?>" type="text" value="<?php echo $ocean_city_red_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_city_red_phone'); ?>">Ocean City Affordable Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('ocean_city_red_phone'); ?>" name="<?php echo $this->get_field_name('ocean_city_red_phone'); ?>" type="text" value="<?php echo $ocean_city_red_phone; ?>" /></label></p>

<p><label for="Ocean Grove"><strong>Ocean Grove Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_grove_alt'); ?>">Ocean Grove Alt:<input class="widefat" id="<?php echo $this->get_field_id('ocean_grove_alt'); ?>" name="<?php echo $this->get_field_name('ocean_grove_alt'); ?>" type="text" value="<?php echo $ocean_grove_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_grove_link'); ?>">Ocean Grove Link:<input class="widefat" id="<?php echo $this->get_field_id('ocean_grove_link'); ?>" name="<?php echo $this->get_field_name('ocean_grove_link'); ?>" type="text" value="<?php echo $ocean_grove_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_grove_county_name'); ?>">Ocean Grove County Name:<input class="widefat" id="<?php echo $this->get_field_id('ocean_grove_county_name'); ?>" name="<?php echo $this->get_field_name('ocean_grove_county_name'); ?>" type="text" value="<?php echo $ocean_grove_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_grove_city_name'); ?>">Ocean Grove City Name:<input class="widefat" id="<?php echo $this->get_field_id('ocean_grove_city_name'); ?>" name="<?php echo $this->get_field_name('ocean_grove_city_name'); ?>" type="text" value="<?php echo $ocean_grove_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('ocean_grove_phone'); ?>">Ocean Grove Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('ocean_grove_phone'); ?>" name="<?php echo $this->get_field_name('ocean_grove_phone'); ?>" type="text" value="<?php echo $ocean_grove_phone; ?>" /></label></p>

<p><label for="Pitman"><strong>Pitman Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('pitman_alt'); ?>">Pitman Alt:<input class="widefat" id="<?php echo $this->get_field_id('pitman_alt'); ?>" name="<?php echo $this->get_field_name('pitman_alt'); ?>" type="text" value="<?php echo $pitman_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('pitman_link'); ?>">Pitman Link:<input class="widefat" id="<?php echo $this->get_field_id('pitman_link'); ?>" name="<?php echo $this->get_field_name('pitman_link'); ?>" type="text" value="<?php echo $pitman_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('pitman_county_name'); ?>">Pitman County Name:<input class="widefat" id="<?php echo $this->get_field_id('pitman_county_name'); ?>" name="<?php echo $this->get_field_name('pitman_county_name'); ?>" type="text" value="<?php echo $pitman_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('pitman_city_name'); ?>">Pitman City Name:<input class="widefat" id="<?php echo $this->get_field_id('pitman_city_name'); ?>" name="<?php echo $this->get_field_name('pitman_city_name'); ?>" type="text" value="<?php echo $pitman_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('pitman_phone'); ?>">Pitman Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('pitman_phone'); ?>" name="<?php echo $this->get_field_name('pitman_phone'); ?>" type="text" value="<?php echo $pitman_phone; ?>" /></label></p>

<p><label for="Plainfield"><strong>Plainfield Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('plainfield_alt'); ?>">Plainfield Alt:<input class="widefat" id="<?php echo $this->get_field_id('plainfield_alt'); ?>" name="<?php echo $this->get_field_name('plainfield_alt'); ?>" type="text" value="<?php echo $plainfield_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('plainfield_link'); ?>">Plainfield Link:<input class="widefat" id="<?php echo $this->get_field_id('plainfield_link'); ?>" name="<?php echo $this->get_field_name('plainfield_link'); ?>" type="text" value="<?php echo $plainfield_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('plainfield_county_name'); ?>">Plainfield County Name:<input class="widefat" id="<?php echo $this->get_field_id('plainfield_county_name'); ?>" name="<?php echo $this->get_field_name('plainfield_county_name'); ?>" type="text" value="<?php echo $plainfield_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('plainfield_city_name'); ?>">Plainfield City Name:<input class="widefat" id="<?php echo $this->get_field_id('plainfield_city_name'); ?>" name="<?php echo $this->get_field_name('plainfield_city_name'); ?>" type="text" value="<?php echo $plainfield_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('plainfield_phone'); ?>">Plainfield Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('plainfield_phone'); ?>" name="<?php echo $this->get_field_name('plainfield_phone'); ?>" type="text" value="<?php echo $plainfield_phone; ?>" /></label></p>

<p><label for="Red Bank"><strong>Red Bank Options:</strong></label></p>
<p><label for="<?php echo $this->get_field_id('red_bank_alt'); ?>">Red Bank Alt:<input class="widefat" id="<?php echo $this->get_field_id('red_bank_alt'); ?>" name="<?php echo $this->get_field_name('red_bank_alt'); ?>" type="text" value="<?php echo $red_bank_alt; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('red_bank_link'); ?>">Red Bank Link:<input class="widefat" id="<?php echo $this->get_field_id('red_bank_link'); ?>" name="<?php echo $this->get_field_name('red_bank_link'); ?>" type="text" value="<?php echo $red_bank_link; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('red_bank_county_name'); ?>">Red Bank County Name:<input class="widefat" id="<?php echo $this->get_field_id('red_bank_county_name'); ?>" name="<?php echo $this->get_field_name('red_bank_county_name'); ?>" type="text" value="<?php echo $red_bank_county_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('red_bank_city_name'); ?>">Red Bank City Name:<input class="widefat" id="<?php echo $this->get_field_id('red_bank_city_name'); ?>" name="<?php echo $this->get_field_name('red_bank_city_name'); ?>" type="text" value="<?php echo $red_bank_city_name; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('red_bank_phone'); ?>">Red Bank Phone Number:<input class="widefat" id="<?php echo $this->get_field_id('red_bank_phone'); ?>" name="<?php echo $this->get_field_name('red_bank_phone'); ?>" type="text" value="<?php echo $red_bank_phone; ?>" /></label></p>

<?php 
}
}
add_action('widgets_init', create_function('', 'return register_widget("CommunityMapWidget");'));

if ( ! function_exists( 'my_pagination' ) ) :
	function my_pagination() {
		global $wp_query;

		$big = 999999999; // need an unlikely integer
		
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
	}
endif;

function my_limit_archives($args){
    $args['limit'] = 10;
    return $args;
}
add_filter( 'widget_archives_args', 'my_limit_archives' );


/* To display the full TinyMCE text editor so you have access to all of the advanced features  */
function enable_more_buttons($buttons) {

$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'styleselect';
$buttons[] = 'backcolor';
$buttons[] = 'newdocument';
$buttons[] = 'cut';
$buttons[] = 'copy';
$buttons[] = 'charmap';
$buttons[] = 'hr';
$buttons[] = 'visualaid';

return $buttons;
}
add_filter("mce_buttons_3", "enable_more_buttons");

/* To keep the kitchen sink always on */

add_filter( 'tiny_mce_before_init', 'myformatTinyMCE' );
function myformatTinyMCE( $in ) {

$in['wordpress_adv_hidden'] = FALSE;

return $in;
}