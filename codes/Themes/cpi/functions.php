<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 584;

/*
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain()    For translation/localization support.
 * @uses add_editor_style()         To style the visual editor.
 * @uses add_theme_support()        To add support for post thumbnails, automatic feed links, custom headers
 * 	                                and backgrounds, and post formats.
 * @uses register_nav_menus()       To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size()  To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	/*
	 * Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use
	 * a find and replace to change 'twentyeleven' to the name
	 * of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );

	// Grab Twenty Eleven's Ephemera widget.
	require( get_template_directory() . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );
	register_nav_menu( 'sidebar', __( 'Sidebar Menu', 'twentyeleven' ) );
	register_nav_menu( 'ind-app', __( 'Industry Application Menu', 'twentyeleven' ) );
	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	$theme_options = twentyeleven_get_theme_options();
	if ( 'dark' == $theme_options['color_scheme'] )
		$default_background_color = '1d1d1d';
	else
		$default_background_color = 'e2e2e2';

	// Add support for custom backgrounds.
	add_theme_support( 'custom-background', array(
		/*
		 * Let WordPress know what our default background color is.
		 * This is dependent on our current color scheme.
		 */
		'default-color' => $default_background_color,
	) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );

	// Add support for custom headers.
	$custom_header_support = array(
		// The default header text color.
		'default-text-color' => '000',
		// The height and width of our custom header.
		/**
		 * Filter the Twenty Eleven default header image width.
		 *
		 * @since Twenty Eleven 1.0
		 *
		 * @param int The default header image width in pixels. Default 1000.
		 */
		'width' => apply_filters( 'twentyeleven_header_image_width', 1000 ),
		/**
		 * Filter the Twenty Eleven default header image height.
		 *
		 * @since Twenty Eleven 1.0
		 *
		 * @param int The default header image height in pixels. Default 288.
		 */
		'height' => apply_filters( 'twentyeleven_header_image_height', 288 ),
		// Support flexible heights.
		'flex-height' => true,
		// Random image rotation by default.
		'random-default' => true,
		// Callback for styling the header.
		'wp-head-callback' => 'twentyeleven_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'twentyeleven_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'twentyeleven_admin_header_image',
	);

	add_theme_support( 'custom-header', $custom_header_support );

	if ( ! function_exists( 'get_custom_header' ) ) {
		// This is all for compatibility with versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR', $custom_header_support['default-text-color'] );
		define( 'HEADER_IMAGE', '' );
		define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
		add_custom_image_header( $custom_header_support['wp-head-callback'], $custom_header_support['admin-head-callback'], $custom_header_support['admin-preview-callback'] );
		add_custom_background();
	}

	/*
	 * We'll be using post thumbnails for custom header images on posts and pages.
	 * We want them to be the size of the header image that we just defined.
	 * Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	 */
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

	/*
	 * Add Twenty Eleven's custom image sizes.
	 * Used for large feature (header) images.
	 */
	add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
	// Used for featured posts if a large-feature doesn't exist.
	add_image_size( 'small-feature', 500, 300 );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'wheel' => array(
			'url' => '%s/images/headers/wheel.jpg',
			'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wheel', 'twentyeleven' )
		),
		'shore' => array(
			'url' => '%s/images/headers/shore.jpg',
			'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Shore', 'twentyeleven' )
		),
		'trolley' => array(
			'url' => '%s/images/headers/trolley.jpg',
			'thumbnail_url' => '%s/images/headers/trolley-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Trolley', 'twentyeleven' )
		),
		'pine-cone' => array(
			'url' => '%s/images/headers/pine-cone.jpg',
			'thumbnail_url' => '%s/images/headers/pine-cone-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Pine Cone', 'twentyeleven' )
		),
		'chessboard' => array(
			'url' => '%s/images/headers/chessboard.jpg',
			'thumbnail_url' => '%s/images/headers/chessboard-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Chessboard', 'twentyeleven' )
		),
		'lanterns' => array(
			'url' => '%s/images/headers/lanterns.jpg',
			'thumbnail_url' => '%s/images/headers/lanterns-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Lanterns', 'twentyeleven' )
		),
		'willow' => array(
			'url' => '%s/images/headers/willow.jpg',
			'thumbnail_url' => '%s/images/headers/willow-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Willow', 'twentyeleven' )
		),
		'hanoi' => array(
			'url' => '%s/images/headers/hanoi.jpg',
			'thumbnail_url' => '%s/images/headers/hanoi-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Hanoi Plant', 'twentyeleven' )
		)
	) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="twentyeleven-header-css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // twentyeleven_header_style

if ( ! function_exists( 'twentyeleven_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_style() {
?>
	<style type="text/css" id="twentyeleven-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif; // twentyeleven_admin_header_style

if ( ! function_exists( 'twentyeleven_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_theme_support('custom-header') in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
	<div id="headimg">
		<?php
		$color = get_header_textcolor();
		$image = get_header_image();
		if ( $color && $color != 'blank' )
			$style = ' style="color:#' . $color . '"';
		else
			$style = ' style="display:none"';
		?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // twentyeleven_admin_header_image

/**
 * Set the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove
 * the filter and add your own function tied to
 * the excerpt_length filter hook.
 *
 * @since Twenty Eleven 1.0
 *
 * @param int $length The number of excerpt characters.
 * @return int The filtered number of characters.
 */
function twentyeleven_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

if ( ! function_exists( 'twentyeleven_continue_reading_link' ) ) :
/**
 * Return a "Continue Reading" link for excerpts
 *
 * @since Twenty Eleven 1.0
 *
 * @return string The "Continue Reading" HTML link.
 */
function twentyeleven_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}
endif; // twentyeleven_continue_reading_link

/**
 * Replace "[...]" in the Read More link with an ellipsis.
 *
 * The "[...]" is appended to automatically generated excerpts.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $more The Read More text.
 * @return The filtered Read More text.
 */
function twentyeleven_auto_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		return ' &hellip;' . twentyeleven_continue_reading_link();
	}
	return $more;
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Add a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $output The "Continue Reading" link.
 * @return string The filtered "Continue Reading" link.
 */
function twentyeleven_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() && ! is_admin() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );

/**
 * Show a home link for the wp_nav_menu() fallback, wp_page_menu().
 *
 * @since Twenty Eleven 1.0
 *
 * @param array $args The page menu arguments. @see wp_page_menu()
 * @return array The filtered page menu arguments.
 */
function twentyeleven_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyeleven_page_menu_args' );

/**
 * Register sidebars and widgetized areas.
 *
 * Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_widgets_init() {

	register_widget( 'Twenty_Eleven_Ephemera_Widget' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );

	register_sidebar( array(
		'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-2',
		'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<strong class="widget-title">',
		'after_title' => '</strong>',
	) );

	register_sidebar( array(
		'name' => __( 'CPI Logo', 'twentyeleven' ),
		'id' => 'logo',
		'description' => __( 'CPI Logo', 'twentyeleven' ),
		'before_widget' => '',
		'after_widget' => "",
		'before_title' => '<strong class="widget-title">',
		'after_title' => '</strong>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Tagline', 'twentyeleven' ),
		'id' => 'tagline',
		'description' => __( 'Tagline', 'twentyeleven' ),
		'before_widget' => "",
		'after_widget' => "",
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Top Right Information', 'twentyeleven' ),
		'id' => 'top-info',
		'description' => __( 'Top Right Information', 'twentyeleven' ),
		'before_widget' => '',
		'after_widget' => "",
		'before_title' => '<strong class="widget-title">',
		'after_title' => '</strong>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Social Icons', 'twentyeleven' ),
		'id' => 'social',
		'description' => __( 'Social Icons', 'twentyeleven' ),
		'before_widget' => '',
		'after_widget' => "",
		'before_title' => '<strong class="widget-title">',
		'after_title' => '</strong>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Tagline Below Slider', 'twentyeleven' ),
		'id' => 'tagline2',
		'description' => __( 'Tagline Below Slider', 'twentyeleven' ),
		'before_widget' => "",
		'after_widget' => "",
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );	

	register_sidebar( array(
		'name' => __( 'Home Top Content', 'twentyeleven' ),
		'id' => 'home-top-content',
		'description' => __( 'Home Top Content', 'twentyeleven' ),
		'before_widget' => "",
		'after_widget' => "",
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );	
	
	register_sidebar( array(
		'name' => __( 'Whitepaper', 'twentyeleven' ),
		'id' => 'whitepaper',
		'description' => __( 'Whitepaper', 'twentyeleven' ),
		'before_widget' => "",
		'after_widget' => "",
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );		

	register_sidebar( array(
		'name' => __( 'Product Desc', 'twentyeleven' ),
		'id' => 'product-desc',
		'description' => __( 'Show 3 Products', 'twentyeleven' ),
		'before_widget' => "<li>",
		'after_widget' => "</li>",
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );
	
		register_sidebar( array(
		'name' => __( 'Footer Top Sidebar', 'twentyeleven' ),
		'id' => 'footer-top',
		'description' => __( 'Footer Top Sidebar', 'twentyeleven' ),
		'before_widget' => '<aside class="footer-top-widgets">',
		'after_widget' => '</aside>',
		'before_title' => '<strong class="footer-widget-title">',
		'after_title' => '</strong>',
	) );
	
		register_sidebar( array(
		'name' => __( 'Footer Bottom Sidebar', 'twentyeleven' ),
		'id' => 'footer-bottom',
		'description' => __( 'Footer Bottom Sidebar', 'twentyeleven' ),
		'before_widget' => '<aside class="footer-bottom-widgets">',
		'after_widget' => '</aside>',
		'before_title' => '<strong style="display: none;" class="footer-widget-title">',
		'after_title' => '</strong>',
	) );
	
		register_sidebar( array(
		'name' => __( 'Top Right Phone', 'twentyeleven' ),
		'id' => 'top-phone',
		'description' => __( 'Top Right Phone', 'twentyeleven' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );

		register_sidebar( array(
		'name' => __( 'Sidebar Menu', 'twentyeleven' ),
		'id' => 'sidebar-menu',
		'description' => __( 'Sidebar Menu', 'twentyeleven' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );
	
		register_sidebar( array(
		'name' => __( 'Product Sidebar 1', 'twentyeleven' ),
		'id' => 'product-sidebar-1',
		'description' => __( 'Product Sidebar', 'twentyeleven' ),
		'before_widget' => '<aside class="product-widgets">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );	
	
		register_sidebar( array(
		'name' => __( 'Blue Section Sidebar', 'twentyeleven' ),
		'id' => 'blue-section-sidebar',
		'description' => __( 'Blue Section Sidebar', 'twentyeleven' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<strong style="display: none;" class="widget-title">',
		'after_title' => '</strong>',
	) );
/*		register_sidebar( array(
		'name' => __( 'Related Products Sidebar', 'twentyeleven' ),
		'id' => 'related-products-sidebar',
		'description' => __( 'Related Products Sidebar', 'twentyeleven' ),
		'before_widget' => '<aside class="related-product-widgets">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );*/
	
		register_sidebar( array(
		'name' => __( 'Industry Application Sidebar', 'twentyeleven' ),
		'id' => 'industry-application',
		'description' => __( 'Industry Application Sidebar', 'twentyeleven' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );	

		register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'twentyeleven' ),
		'id' => 'blog-sidebar',
		'description' => __( 'Blog Sidebar', 'twentyeleven' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="sidebar-menu">',
		'after_widget' => "</div></aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );	
	
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );

if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $html_id The HTML id attribute.
 */
function twentyeleven_content_nav( $html_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>">
			<strong class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></strong>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // twentyeleven_content_nav

/**
 * Return the first link from the post content. If none found, the
 * post permalink is used as a fallback.
 *
 * @since Twenty Eleven 1.0
 *
 * @uses get_url_in_content() to get the first URL from the post content.
 *
 * @return string The first link.
 */
function twentyeleven_get_first_url() {
	$content = get_the_content();
	$has_url = function_exists( 'get_url_in_content' ) ? get_url_in_content( $content ) : false;

	if ( ! $has_url )
		$has_url = twentyeleven_url_grabber();

	/** This filter is documented in wp-includes/link-template.php */
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 *
 * @return string|bool URL or false when no link is present.
 */
function twentyeleven_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 *
 * @param object $comment The comment object.
 * @param array  $args    An array of comment arguments. @see get_comment_reply_link()
 * @param int    $depth   The depth of the comment.
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

/*if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
 /*
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;*/

/**
 * Add two classes to the array of body classes.
 *
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 *
 * @param array $classes Existing body classes.
 * @return array The filtered array of body classes.
 */
function twentyeleven_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );

/**
 * Retrieve the IDs for images in a gallery.
 *
 * @uses get_post_galleries() First, if available. Falls back to shortcode parsing,
 *                            then as last option uses a get_posts() call.
 *
 * @since Twenty Eleven 1.6
 *
 * @return array List of image IDs from the post gallery.
 */
function twentyeleven_get_gallery_images() {
	$images = array();

	if ( function_exists( 'get_post_galleries' ) ) {
		$galleries = get_post_galleries( get_the_ID(), false );
		if ( isset( $galleries[0]['ids'] ) )
		 	$images = explode( ',', $galleries[0]['ids'] );
	} else {
		$pattern = get_shortcode_regex();
		preg_match( "/$pattern/s", get_the_content(), $match );
		$atts = shortcode_parse_atts( $match[3] );
		if ( isset( $atts['ids'] ) )
			$images = explode( ',', $atts['ids'] );
	}

	if ( ! $images ) {
		$images = get_posts( array(
			'fields'         => 'ids',
			'numberposts'    => 999,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post_mime_type' => 'image',
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
		) );
	}

	return $images;
}


add_theme_support( 'woocommerce' );


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
		// $readmore = esc_attr($instance['readmore']);
		 if(empty($num_blogs)){
		 $num_blogs=3;
		 } 
     ?>
     <?php echo $before_widget; ?>
       <?php if ( $title ){	echo $before_title.$title.$after_title; } ?>
       <?php
	//$args=array(post_type=>'post',posts_per_page=>$num_blogs,order => DESC);
		$args=array(post_type=>'post',order => DESC,posts_per_page=>$num_blogs);
		query_posts( $args );
		?>
		<ul class="footer-blog">
		 <?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
		<li>
         <?php //Featured Image Code
		if(has_post_thumbnail()){
		 $thumbnail=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"full");
		}
     	?>
	  <img src="<?php echo $thumbnail[0];?>" alt="<?php the_title();?>" /><?php the_time('m/d/y'); ?><br>
     <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</li>
	<?php endwhile; ?>
    <?php endif; ?>	
	 <?php wp_reset_query();?>
 </ul>
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

/*function filter_plugin_updates( $value ) {
    unset( $value->response['meteor-slides/meteor-slides-plugin.php'] );
	unset( $value->response['megamenu/megamenu.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );*/

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '&#155;&#155;',
            'wrap_before' => '<nav class="breadcrumbs" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

function my_limit_words($string, $word_limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $word_limit));
}

class RelatedProductsWidget extends WP_Widget {
    /** constructor */
    function RelatedProductsWidget() {
		$widget_ops = array('classname' => 'related_products', 'description' => 'Displays Related Products' );
		$this->WP_Widget('RelatedProductsWidget',"Related Products", $widget_ops);	
    }
    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
      extract( $args );
		$title = esc_attr($instance['title']);				
		$num_pro = esc_attr($instance['num_pro']);
		 if(empty($num_pro)){
		 $num_pro=6;
		 } 
     ?>
     <?php echo $before_widget; ?>
     <div class="related-product-widgets">
       <?php if ( $title ){	echo $before_title.$title.$after_title; } ?>
    <ul class="products">
<?php
global $product, $woocommerce_loop;	
$upsells = $product->get_upsells();
$meta_query = WC()->query->get_meta_query();	
$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $num_pro,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				?>
             <li>
            <div class="rel-img-div">
			<a href="<?php the_permalink(); ?>">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
            </a>
            </div>
            <a href="<?php the_permalink(); ?>">
			<?php echo my_limit_words(get_the_title(),1); ?>
            </a>
			</li>   
                <?php
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</ul><!--/.products-->
</div>
     <?php echo $after_widget; ?>
      <?php
    }
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['num_pro'] = strip_tags($new_instance['num_pro']);
     return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {
		$title = esc_attr($instance['title']);				
		$num_pro = esc_attr($instance['num_pro']);
		 if(empty($num_pro)){ $num_pro=3; }
    ?>
<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('num_pro'); ?>">No of Related Products<input class="widefat" id="<?php echo $this->get_field_id('num_pro'); ?>" name="<?php echo $this->get_field_name('num_pro'); ?>" type="text" value="<?php echo $num_pro; ?>" /></label></p> 
<?php 
}
}
add_action('widgets_init', create_function('', 'return register_widget("RelatedProductsWidget");'));

foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

add_shortcode( 'products_code', 'page_product_code' );

function page_product_code( $atts ) {

  extract(shortcode_atts( array(
      'per_page' => '16',
      'category' => '',  
    ), $atts ));
	
	ob_start();
    if ( ! $atts['category'] ) {
      return '';
    }

    $args = array(
      'post_type'        => 'product',
      'posts_per_page'     => $atts['per_page'],
	  'orderby' => 'name',
	  'order' => 'asc',
      'tax_query'       => array(
        array(
          'taxonomy'     => 'product_cat',
          'terms'     => array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
          'field'     => 'slug'
		)
      )
    );

    if ( isset( $ordering_args['meta_key'] ) ) {
      $args['meta_key'] = $ordering_args['meta_key'];
    }

    ob_start();

    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

    $woocommerce_loop['columns'] = $atts['columns'];

    if ( $products->have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
            <nav class="woocommerce-pagination">
            <div class="holder"></div>
            </nav>
            

		<?php endif;

    woocommerce_reset_loop();
    wp_reset_postdata();
	return ob_get_clean();
	
}

class IndustryApplicationWidget extends WP_Widget {
    /** constructor */
    function IndustryApplicationWidget() {
		$widget_ops = array('classname' => 'widget_indapp', 'description' => 'Displays Industry Application' );
		$this->WP_Widget('IndustryApplicationWidget',"Industry Application Widget", $widget_ops);	
    }
    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
      extract( $args );
		$title = esc_attr($instance['title']);				
		$industry_name = esc_attr($instance['industry_name']);
		
		$application1_name = esc_attr($instance['application1_name']);
		$application1_img = esc_attr($instance['application1_img']);
		$application1_img_alt = esc_attr($instance['application1_img_alt']);
		$application1_product_feature = esc_attr($instance['application1_product_feature']);
		$application1_content = esc_attr($instance['application1_content']);
		$application1_learn_more_link = esc_attr($instance['application1_learn_more_link']);
		$application1_learn_more_text = esc_attr($instance['application1_learn_more_text']);
		
		$application2_name = esc_attr($instance['application2_name']);
		$application2_img = esc_attr($instance['application2_img']);
		$application2_img_alt = esc_attr($instance['application2_img_alt']);
		$application2_product_feature = esc_attr($instance['application2_product_feature']);
		$application2_content = esc_attr($instance['application2_content']);
		$application2_learn_more_link = esc_attr($instance['application2_learn_more_link']);
		$application2_learn_more_text = esc_attr($instance['application2_learn_more_text']);


		$application3_name = esc_attr($instance['application3_name']);
		$application3_img = esc_attr($instance['application3_img']);
		$application3_img_alt = esc_attr($instance['application3_img_alt']);
		$application3_product_feature = esc_attr($instance['application3_product_feature']);
		$application3_content = esc_attr($instance['application3_content']);
		$application3_learn_more_link = esc_attr($instance['application3_learn_more_link']);
		$application3_learn_more_text = esc_attr($instance['application3_learn_more_text']);

		$application4_name = esc_attr($instance['application4_name']);
		$application4_img = esc_attr($instance['application4_img']);
		$application4_img_alt = esc_attr($instance['application4_img_alt']);
		$application4_product_feature = esc_attr($instance['application4_product_feature']);
		$application4_content = esc_attr($instance['application4_content']);
		$application4_learn_more_link = esc_attr($instance['application4_learn_more_link']);
		$application4_learn_more_text = esc_attr($instance['application4_learn_more_text']);

		$application5_name = esc_attr($instance['application5_name']);
		$application5_img = esc_attr($instance['application5_img']);
		$application5_img_alt = esc_attr($instance['application5_img_alt']);
		$application5_product_feature = esc_attr($instance['application5_product_feature']);
		$application5_content = esc_attr($instance['application5_content']);
		$application5_learn_more_link = esc_attr($instance['application5_learn_more_link']);
		$application5_learn_more_text = esc_attr($instance['application5_learn_more_text']);

		$application6_name = esc_attr($instance['application6_name']);
		$application6_img = esc_attr($instance['application6_img']);
		$application6_img_alt = esc_attr($instance['application6_img_alt']);
		$application6_product_feature = esc_attr($instance['application6_product_feature']);
		$application6_content = esc_attr($instance['application6_content']);
		$application6_learn_more_link = esc_attr($instance['application6_learn_more_link']);
		$application6_learn_more_text = esc_attr($instance['application6_learn_more_text']);
		
		$application7_name = esc_attr($instance['application7_name']);
		$application7_img = esc_attr($instance['application7_img']);
		$application7_img_alt = esc_attr($instance['application7_img_alt']);
		$application7_product_feature = esc_attr($instance['application7_product_feature']);
		$application7_content = esc_attr($instance['application7_content']);
		$application7_learn_more_link = esc_attr($instance['application7_learn_more_link']);
		$application7_learn_more_text = esc_attr($instance['application7_learn_more_text']);
		
		$application8_name = esc_attr($instance['application8_name']);
		$application8_img = esc_attr($instance['application8_img']);
		$application8_img_alt = esc_attr($instance['application8_img_alt']);
		$application8_product_feature = esc_attr($instance['application8_product_feature']);
		$application8_content = esc_attr($instance['application8_content']);
		$application8_learn_more_link = esc_attr($instance['application8_learn_more_link']);
		$application8_learn_more_text = esc_attr($instance['application8_learn_more_text']);

		$application9_name = esc_attr($instance['application9_name']);
		$application9_img = esc_attr($instance['application9_img']);
		$application9_img_alt = esc_attr($instance['application9_img_alt']);
		$application9_product_feature = esc_attr($instance['application9_product_feature']);
		$application9_content = esc_attr($instance['application9_content']);
		$application9_learn_more_link = esc_attr($instance['application9_learn_more_link']);
		$application9_learn_more_text = esc_attr($instance['application9_learn_more_text']);

		$application10_name = esc_attr($instance['application10_name']);
		$application10_img = esc_attr($instance['application10_img']);
		$application10_img_alt = esc_attr($instance['application10_img_alt']);
		$application10_product_feature = esc_attr($instance['application10_product_feature']);
		$application10_content = esc_attr($instance['application10_content']);
		$application10_learn_more_link = esc_attr($instance['application10_learn_more_link']);
		$application10_learn_more_text = esc_attr($instance['application10_learn_more_text']);								

		?>

	  <?php echo $before_widget; ?>
      <?php if($industry_name){ ?>
      <li class="menu-item-has-children">
      <?php } else{ ?>
    <li class="menu-item">
      <?php } ?>
      	<a href="javascript:void(0)"><?php echo $industry_name; ?><span></span></a>
      <ul class="sub-menu">
        
        <?php if($application1_name){ ?>		
          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application1_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                        <?php if($application1_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application1_img; ?>" alt="<?php echo $application1_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application1_product_feature){ ?>
                        <div class="headings"><?php echo $application1_product_feature;?></div>
                        <?php } ?>
                        <p>
                        	<?php echo $application1_content; ?>
                            <?php if($application1_learn_more_link){ ?>
                            <a href="<?php echo $application1_learn_more_link; ?>">
								<?php echo $application1_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
            <?php } ?>
          </li>
          
          <?php if($application2_name){ ?>
          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application2_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application2_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application2_img; ?>" alt="<?php echo $application2_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application2_product_feature){ ?>
                        <div class="headings"><?php echo $application2_product_feature;?></div>
                        <?php } ?>
                        <p>
                        	<?php echo $application2_content; ?>
                            <?php if($application2_learn_more_link){ ?>
                            <a href="<?php echo $application2_learn_more_link; ?>">
								<?php echo $application2_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>          
		<?php } ?>
        
        <?php if($application3_name){ ?>

          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application3_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application3_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application3_img; ?>" alt="<?php echo $application3_img_alt; ?>" />
                          <?php }?>                       		 
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application3_product_feature){ ?>
                        <div class="headings"><?php echo $application3_product_feature;?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application3_content; ?>
                            <?php if($application3_learn_more_link){ ?>
                            <a href="<?php echo $application3_learn_more_link; ?>">
								<?php echo $application3_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>    
          <?php } ?>
          
          <?php if($application4_name){ ?>
          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application4_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application4_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application4_img; ?>" alt="<?php echo $application4_img_alt; ?>" />
                          <?php }?>                   		  
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application4_product_feature){ ?>
                        <div class="headings"><?php echo $application4_product_feature; ?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application4_content; ?>
                            <?php if($application4_learn_more_link){ ?>
                            <a href="<?php echo $application4_learn_more_link; ?>">
								<?php echo $application4_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>
          <?php } ?>

		<?php if($application5_name){ ?>
          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application5_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application5_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application5_img; ?>" alt="<?php echo $application5_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application5_product_feature){ ?>
                        <div class="headings"><?php echo $application5_product_feature;?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application5_content; ?>
                            <?php if($application5_learn_more_link){ ?>
                            <a href="<?php echo $application5_learn_more_link; ?>">
								<?php echo $application5_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>
		<?php } ?>
        
        <?php if($application6_name){ ?>
          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application6_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application6_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application6_img; ?>" alt="<?php echo $application6_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application6_product_feature){ ?>
                        <div class="headings"><?php echo $application6_product_feature;?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application6_content; ?>
                            <?php if($application6_learn_more_link){ ?>
                            <a href="<?php echo $application6_learn_more_link; ?>">
								<?php echo $application6_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>  
		<?php } ?>
        
		<?php if($application7_name){ ?>
          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application7_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application7_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application7_img; ?>" alt="<?php echo $application7_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application7_product_feature){ ?>
                        <div class="headings"><?php echo $application7_product_feature;?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application7_content; ?>
                            <?php if($application7_learn_more_link){ ?>
                            <a href="<?php echo $application7_learn_more_link; ?>">
								<?php echo $application7_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>  
		<?php } ?>
        
		<?php if($application8_name){ ?>

          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application8_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application8_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application8_img; ?>" alt="<?php echo $application8_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application8_product_feature){ ?>
                        <div class="headings"><?php echo $application8_product_feature;?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application8_content; ?>
                            <?php if($application8_learn_more_link){ ?>
                            <a href="<?php echo $application8_learn_more_link; ?>">
								<?php echo $application8_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li> 
		<?php } ?>
        
		<?php if($application9_name){ ?>          


          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application9_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application9_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application9_img; ?>" alt="<?php echo $application9_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application9_product_feature){ ?>
                        <div class="headings"><?php echo $application9_product_feature;?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application9_content; ?>
                            <?php if($application9_learn_more_link){ ?>
                            <a href="<?php echo $application9_learn_more_link; ?>">
								<?php echo $application9_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>
		<?php } ?>
        
		<?php if($application10_name){ ?>
        

          <li class="menu-item-has-children">
          	<a href="javascript:void(0)"><?php echo $application10_name; ?></a>
            <ul class="sub-menu">
              <li class="menu-item">
              	<div class="ind-app-product">
                    <div class="ind-app-pro">
                        <div class="ind-app-pro-img">
                   		   <?php if($application10_img){ ?>
                   		  <img src="<?php bloginfo('url'); ?>/<?php echo $application10_img; ?>" alt="<?php echo $application10_img_alt; ?>" />
                          <?php }?>
                        </div>
                        <div class="ind-app-pro-content">
                        <?php if($application10_product_feature){ ?>
                        <div class="headings"><?php echo $application10_product_feature;?></div>
                        <?php } ?>                        
                        <p>
                        	<?php echo $application10_content; ?>
                            <?php if($application10_learn_more_link){ ?>
                            <a href="<?php echo $application10_learn_more_link; ?>">
								<?php echo $application10_learn_more_text; ?>
                            </a><?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="clr"></div>
                </div>
              </li>
            </ul>
          </li>   
  		<?php } ?>

              
      </ul>
      </li>
	<?php echo $after_widget; ?>
    <?php
    }
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['industry_name'] = strip_tags($new_instance['industry_name']);
	
	$instance['application1_name'] = strip_tags($new_instance['application1_name']);
	$instance['application1_img'] = strip_tags($new_instance['application1_img']);
	$instance['application1_img_alt'] = strip_tags($new_instance['application1_img_alt']);
	$instance['application1_product_feature'] = strip_tags($new_instance['application1_product_feature']);	
	$instance['application1_content'] = strip_tags($new_instance['application1_content']);
	$instance['application1_learn_more_link'] = strip_tags($new_instance['application1_learn_more_link']);
	$instance['application1_learn_more_text'] = strip_tags($new_instance['application1_learn_more_text']);

	$instance['application2_name'] = strip_tags($new_instance['application2_name']);
	$instance['application2_img'] = strip_tags($new_instance['application2_img']);
	$instance['application2_img_alt'] = strip_tags($new_instance['application2_img_alt']);
	$instance['application2_product_feature'] = strip_tags($new_instance['application2_product_feature']);		
	$instance['application2_content'] = strip_tags($new_instance['application2_content']);
	$instance['application2_learn_more_link'] = strip_tags($new_instance['application2_learn_more_link']);
	$instance['application2_learn_more_text'] = strip_tags($new_instance['application2_learn_more_text']);
	
	$instance['application3_name'] = strip_tags($new_instance['application3_name']);
	$instance['application3_img'] = strip_tags($new_instance['application3_img']);
	$instance['application3_img_alt'] = strip_tags($new_instance['application3_img_alt']);
	$instance['application3_product_feature'] = strip_tags($new_instance['application3_product_feature']);		
	$instance['application3_content'] = strip_tags($new_instance['application3_content']);
	$instance['application3_learn_more_link'] = strip_tags($new_instance['application3_learn_more_link']);
	$instance['application3_learn_more_text'] = strip_tags($new_instance['application3_learn_more_text']);
	
	$instance['application4_name'] = strip_tags($new_instance['application4_name']);
	$instance['application4_img'] = strip_tags($new_instance['application4_img']);
	$instance['application4_img_alt'] = strip_tags($new_instance['application4_img_alt']);
	$instance['application4_product_feature'] = strip_tags($new_instance['application4_product_feature']);		
	$instance['application4_content'] = strip_tags($new_instance['application4_content']);
	$instance['application4_learn_more_link'] = strip_tags($new_instance['application4_learn_more_link']);
	$instance['application4_learn_more_text'] = strip_tags($new_instance['application4_learn_more_text']);
	
	$instance['application5_name'] = strip_tags($new_instance['application5_name']);
	$instance['application5_img'] = strip_tags($new_instance['application5_img']);
	$instance['application5_img_alt'] = strip_tags($new_instance['application5_img_alt']);
	$instance['application5_product_feature'] = strip_tags($new_instance['application5_product_feature']);		
	$instance['application5_content'] = strip_tags($new_instance['application5_content']);
	$instance['application5_learn_more_link'] = strip_tags($new_instance['application5_learn_more_link']);
	$instance['application5_learn_more_text'] = strip_tags($new_instance['application5_learn_more_text']);
	
	$instance['application6_name'] = strip_tags($new_instance['application6_name']);
	$instance['application6_img'] = strip_tags($new_instance['application6_img']);
	$instance['application6_img_alt'] = strip_tags($new_instance['application6_img_alt']);
	$instance['application6_product_feature'] = strip_tags($new_instance['application6_product_feature']);		
	$instance['application6_content'] = strip_tags($new_instance['application6_content']);
	$instance['application6_learn_more_link'] = strip_tags($new_instance['application6_learn_more_link']);
	$instance['application6_learn_more_text'] = strip_tags($new_instance['application6_learn_more_text']);
	
	$instance['application7_name'] = strip_tags($new_instance['application7_name']);
	$instance['application7_img'] = strip_tags($new_instance['application7_img']);
	$instance['application7_img_alt'] = strip_tags($new_instance['application7_img_alt']);
	$instance['application7_product_feature'] = strip_tags($new_instance['application7_product_feature']);		
	$instance['application7_content'] = strip_tags($new_instance['application7_content']);
	$instance['application7_learn_more_link'] = strip_tags($new_instance['application7_learn_more_link']);
	$instance['application7_learn_more_text'] = strip_tags($new_instance['application7_learn_more_text']);
	
	$instance['application8_name'] = strip_tags($new_instance['application8_name']);
	$instance['application8_img'] = strip_tags($new_instance['application8_img']);
	$instance['application8_img_alt'] = strip_tags($new_instance['application8_img_alt']);
	$instance['application8_product_feature'] = strip_tags($new_instance['application8_product_feature']);		
	$instance['application8_content'] = strip_tags($new_instance['application8_content']);
	$instance['application8_learn_more_link'] = strip_tags($new_instance['application8_learn_more_link']);
	$instance['application8_learn_more_text'] = strip_tags($new_instance['application8_learn_more_text']);
	

	$instance['application9_name'] = strip_tags($new_instance['application9_name']);
	$instance['application9_img'] = strip_tags($new_instance['application9_img']);
	$instance['application9_img_alt'] = strip_tags($new_instance['application9_img_alt']);
	$instance['application9_product_feature'] = strip_tags($new_instance['application9_product_feature']);		
	$instance['application9_content'] = strip_tags($new_instance['application9_content']);
	$instance['application9_learn_more_link'] = strip_tags($new_instance['application9_learn_more_link']);
	$instance['application9_learn_more_text'] = strip_tags($new_instance['application9_learn_more_text']);
	
	$instance['application10_name'] = strip_tags($new_instance['application10_name']);
	$instance['application10_img'] = strip_tags($new_instance['application10_img']);
	$instance['application10_img_alt'] = strip_tags($new_instance['application10_img_alt']);
	$instance['application10_product_feature'] = strip_tags($new_instance['application10_product_feature']);		
	$instance['application10_content'] = strip_tags($new_instance['application10_content']);
	$instance['application10_learn_more_link'] = strip_tags($new_instance['application10_learn_more_link']);
	$instance['application10_learn_more_text'] = strip_tags($new_instance['application10_learn_more_text']);									
	
     return $instance;
    }
    /** @see WP_Widget::form */
    function form($instance) {
		$title = esc_attr($instance['title']);				
		$industry_name = esc_attr($instance['industry_name']);
		
		$application1_name = esc_attr($instance['application1_name']);
		$application1_img = esc_attr($instance['application1_img']);
		$application1_img_alt = esc_attr($instance['application1_img_alt']);
		$application1_product_feature = esc_attr($instance['application1_product_feature']);		
		$application1_content = esc_attr($instance['application1_content']);
		$application1_learn_more_link = esc_attr($instance['application1_learn_more_link']);
		$application1_learn_more_text = esc_attr($instance['application1_learn_more_text']);
		
		$application2_name = esc_attr($instance['application2_name']);
		$application2_img = esc_attr($instance['application2_img']);
		$application2_img_alt = esc_attr($instance['application2_img_alt']);
		$application2_product_feature = esc_attr($instance['application2_product_feature']);		
		$application2_content = esc_attr($instance['application2_content']);
		$application2_learn_more_link = esc_attr($instance['application2_learn_more_link']);
		$application2_learn_more_text = esc_attr($instance['application2_learn_more_text']);


		$application3_name = esc_attr($instance['application3_name']);
		$application3_img = esc_attr($instance['application3_img']);
		$application3_img_alt = esc_attr($instance['application3_img_alt']);
		$application3_product_feature = esc_attr($instance['application3_product_feature']);		
		$application3_content = esc_attr($instance['application3_content']);
		$application3_learn_more_link = esc_attr($instance['application3_learn_more_link']);
		$application3_learn_more_text = esc_attr($instance['application3_learn_more_text']);

		$application4_name = esc_attr($instance['application4_name']);
		$application4_img = esc_attr($instance['application4_img']);
		$application4_img_alt = esc_attr($instance['application4_img_alt']);
		$application4_product_feature = esc_attr($instance['application4_product_feature']);		
		$application4_content = esc_attr($instance['application4_content']);
		$application4_learn_more_link = esc_attr($instance['application4_learn_more_link']);
		$application4_learn_more_text = esc_attr($instance['application4_learn_more_text']);

		$application5_name = esc_attr($instance['application5_name']);
		$application5_img = esc_attr($instance['application5_img']);
		$application5_img_alt = esc_attr($instance['application5_img_alt']);
		$application5_product_feature = esc_attr($instance['application5_product_feature']);		
		$application5_content = esc_attr($instance['application5_content']);
		$application5_learn_more_link = esc_attr($instance['application5_learn_more_link']);
		$application5_learn_more_text = esc_attr($instance['application5_learn_more_text']);

		$application6_name = esc_attr($instance['application6_name']);
		$application6_img = esc_attr($instance['application6_img']);
		$application6_img_alt = esc_attr($instance['application6_img_alt']);
		$application6_product_feature = esc_attr($instance['application6_product_feature']);		
		$application6_content = esc_attr($instance['application6_content']);
		$application6_learn_more_link = esc_attr($instance['application6_learn_more_link']);
		$application6_learn_more_text = esc_attr($instance['application6_learn_more_text']);
		
		$application7_name = esc_attr($instance['application7_name']);
		$application7_img = esc_attr($instance['application7_img']);
		$application7_img_alt = esc_attr($instance['application7_img_alt']);
		$application7_product_feature = esc_attr($instance['application7_product_feature']);		
		$application7_content = esc_attr($instance['application7_content']);
		$application7_learn_more_link = esc_attr($instance['application7_learn_more_link']);
		$application7_learn_more_text = esc_attr($instance['application7_learn_more_text']);
		
		$application8_name = esc_attr($instance['application8_name']);
		$application8_img = esc_attr($instance['application8_img']);
		$application8_img_alt = esc_attr($instance['application8_img_alt']);
		$application8_product_feature = esc_attr($instance['application8_product_feature']);		
		$application8_content = esc_attr($instance['application8_content']);
		$application8_learn_more_link = esc_attr($instance['application8_learn_more_link']);
		$application8_learn_more_text = esc_attr($instance['application8_learn_more_text']);

		$application9_name = esc_attr($instance['application9_name']);
		$application9_img = esc_attr($instance['application9_img']);
		$application9_img_alt = esc_attr($instance['application9_img_alt']);
		$application9_product_feature = esc_attr($instance['application9_product_feature']);		
		$application9_content = esc_attr($instance['application9_content']);
		$application9_learn_more_link = esc_attr($instance['application9_learn_more_link']);
		$application9_learn_more_text = esc_attr($instance['application9_learn_more_text']);

		$application10_name = esc_attr($instance['application10_name']);
		$application10_img = esc_attr($instance['application10_img']);
		$application10_img_alt = esc_attr($instance['application10_img_alt']);
		$application10_product_feature = esc_attr($instance['application10_product_feature']);		
		$application10_content = esc_attr($instance['application10_content']);
		$application10_learn_more_link = esc_attr($instance['application10_learn_more_link']);
		$application10_learn_more_text = esc_attr($instance['application10_learn_more_text']);
        ?>
	
    <p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('industry_name'); ?>">Industry Name<input class="widefat" id="<?php echo $this->get_field_id('industry_name'); ?>" name="<?php echo $this->get_field_name('industry_name'); ?>" type="text" value="<?php echo $industry_name; ?>" /></label></p>
  
  	<div id="accordion" class="accordion">
    <h3 id="acc-title" class="acc-title">Application 1</h3>
    <div id="acc-content" class="acc-content" style="display: none;">
  	<p><label for="<?php echo $this->get_field_id('application1_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application1_name'); ?>" name="<?php echo $this->get_field_name('application1_name'); ?>" type="text" value="<?php echo $application1_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application1_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application1_img'); ?>" name="<?php echo $this->get_field_name('application1_img'); ?>" type="text" value="<?php echo $application1_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application1_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application1_img_alt'); ?>" name="<?php echo $this->get_field_name('application1_img_alt'); ?>" type="text" value="<?php echo $application1_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application1_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application1_product_feature'); ?>" name="<?php echo $this->get_field_name('application1_product_feature'); ?>" type="text" value="<?php echo $application1_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application1_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application1_content'); ?>" name="<?php echo $this->get_field_name('application1_content'); ?>" type="text" value="<?php echo $application1_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application1_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application1_content'); ?>" name="<?php echo $this->get_field_name('application1_content'); ?>" rows="7" cols="20" ><?php echo $application1_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application1_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application1_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application1_learn_more_link'); ?>" type="text" value="<?php echo $application1_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application1_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application1_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application1_learn_more_text'); ?>" type="text" value="<?php echo $application1_learn_more_text; ?>" /></label></p>
	</div>

	<h3 id="acc-title" class="acc-title">Application 2</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">
	<p><label for="<?php echo $this->get_field_id('application2_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application2_name'); ?>" name="<?php echo $this->get_field_name('application2_name'); ?>" type="text" value="<?php echo $application2_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application2_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application2_img'); ?>" name="<?php echo $this->get_field_name('application2_img'); ?>" type="text" value="<?php echo $application2_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application2_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application2_img_alt'); ?>" name="<?php echo $this->get_field_name('application2_img_alt'); ?>" type="text" value="<?php echo $application2_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application2_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application2_product_feature'); ?>" name="<?php echo $this->get_field_name('application2_product_feature'); ?>" type="text" value="<?php echo $application2_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application2_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application2_content'); ?>" name="<?php echo $this->get_field_name('application2_content'); ?>" type="text" value="<?php echo $application2_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application2_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application2_content'); ?>" name="<?php echo $this->get_field_name('application2_content'); ?>" rows="7" cols="20" ><?php echo $application2_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application2_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application2_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application2_learn_more_link'); ?>" type="text" value="<?php echo $application2_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application2_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application2_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application2_learn_more_text'); ?>" type="text" value="<?php echo $application2_learn_more_text; ?>" /></label></p>
	</div>

	<h3 id="acc-title" class="acc-title">Application 3</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">
    <p><label for="<?php echo $this->get_field_id('application3_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application3_name'); ?>" name="<?php echo $this->get_field_name('application3_name'); ?>" type="text" value="<?php echo $application3_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application3_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application3_img'); ?>" name="<?php echo $this->get_field_name('application3_img'); ?>" type="text" value="<?php echo $application3_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application3_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application3_img_alt'); ?>" name="<?php echo $this->get_field_name('application3_img_alt'); ?>" type="text" value="<?php echo $application3_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application3_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application3_product_feature'); ?>" name="<?php echo $this->get_field_name('application3_product_feature'); ?>" type="text" value="<?php echo $application3_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application3_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application3_content'); ?>" name="<?php echo $this->get_field_name('application3_content'); ?>" type="text" value="<?php echo $application3_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application3_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application3_content'); ?>" name="<?php echo $this->get_field_name('application3_content'); ?>" rows="7" cols="20" ><?php echo $application3_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application3_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application3_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application3_learn_more_link'); ?>" type="text" value="<?php echo $application3_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application3_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application3_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application3_learn_more_text'); ?>" type="text" value="<?php echo $application3_learn_more_text; ?>" /></label></p>
	</div>

	<h3 id="acc-title" class="acc-title">Application 4</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">    
 	<p><label for="<?php echo $this->get_field_id('application4_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application4_name'); ?>" name="<?php echo $this->get_field_name('application4_name'); ?>" type="text" value="<?php echo $application4_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application4_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application4_img'); ?>" name="<?php echo $this->get_field_name('application4_img'); ?>" type="text" value="<?php echo $application4_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application4_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application4_img_alt'); ?>" name="<?php echo $this->get_field_name('application4_img_alt'); ?>" type="text" value="<?php echo $application4_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application4_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application4_product_feature'); ?>" name="<?php echo $this->get_field_name('application4_product_feature'); ?>" type="text" value="<?php echo $application4_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application4_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application4_content'); ?>" name="<?php echo $this->get_field_name('application4_content'); ?>" type="text" value="<?php echo $application4_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application4_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application4_content'); ?>" name="<?php echo $this->get_field_name('application4_content'); ?>" rows="7" cols="20" ><?php echo $application4_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application4_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application4_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application4_learn_more_link'); ?>" type="text" value="<?php echo $application4_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application4_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application4_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application4_learn_more_text'); ?>" type="text" value="<?php echo $application4_learn_more_text; ?>" /></label></p>
	</div>
    
	<h3 id="acc-title" class="acc-title">Application 5</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">    
	<p><label for="<?php echo $this->get_field_id('application5_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application5_name'); ?>" name="<?php echo $this->get_field_name('application5_name'); ?>" type="text" value="<?php echo $application5_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application5_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application5_img'); ?>" name="<?php echo $this->get_field_name('application5_img'); ?>" type="text" value="<?php echo $application5_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application5_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application5_img_alt'); ?>" name="<?php echo $this->get_field_name('application5_img_alt'); ?>" type="text" value="<?php echo $application5_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application5_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application5_product_feature'); ?>" name="<?php echo $this->get_field_name('application5_product_feature'); ?>" type="text" value="<?php echo $application5_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application5_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application5_content'); ?>" name="<?php echo $this->get_field_name('application5_content'); ?>" type="text" value="<?php echo $application5_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application5_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application5_content'); ?>" name="<?php echo $this->get_field_name('application5_content'); ?>" rows="7" cols="20" ><?php echo $application5_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application5_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application5_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application5_learn_more_link'); ?>" type="text" value="<?php echo $application5_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application5_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application5_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application5_learn_more_text'); ?>" type="text" value="<?php echo $application5_learn_more_text; ?>" /></label></p>
	</div>

	<h3 id="acc-title" class="acc-title">Application 6</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">
    <p><label for="<?php echo $this->get_field_id('application6_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application6_name'); ?>" name="<?php echo $this->get_field_name('application6_name'); ?>" type="text" value="<?php echo $application6_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application6_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application6_img'); ?>" name="<?php echo $this->get_field_name('application6_img'); ?>" type="text" value="<?php echo $application6_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application6_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application6_img_alt'); ?>" name="<?php echo $this->get_field_name('application6_img_alt'); ?>" type="text" value="<?php echo $application6_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application6_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application6_product_feature'); ?>" name="<?php echo $this->get_field_name('application6_product_feature'); ?>" type="text" value="<?php echo $application6_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application6_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application6_content'); ?>" name="<?php echo $this->get_field_name('application6_content'); ?>" type="text" value="<?php echo $application6_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application6_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application6_content'); ?>" name="<?php echo $this->get_field_name('application6_content'); ?>" rows="7" cols="20" ><?php echo $application6_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application6_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application6_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application6_learn_more_link'); ?>" type="text" value="<?php echo $application6_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application6_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application6_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application6_learn_more_text'); ?>" type="text" value="<?php echo $application6_learn_more_text; ?>" /></label></p>
	</div>

	<h3 id="acc-title" class="acc-title">Application 7</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">
 	<p><label for="<?php echo $this->get_field_id('application7_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application7_name'); ?>" name="<?php echo $this->get_field_name('application7_name'); ?>" type="text" value="<?php echo $application7_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application7_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application7_img'); ?>" name="<?php echo $this->get_field_name('application7_img'); ?>" type="text" value="<?php echo $application7_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application7_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application7_img_alt'); ?>" name="<?php echo $this->get_field_name('application7_img_alt'); ?>" type="text" value="<?php echo $application7_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application7_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application7_product_feature'); ?>" name="<?php echo $this->get_field_name('application7_product_feature'); ?>" type="text" value="<?php echo $application7_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application7_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application7_content'); ?>" name="<?php echo $this->get_field_name('application7_content'); ?>" type="text" value="<?php echo $application7_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application7_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application7_content'); ?>" name="<?php echo $this->get_field_name('application7_content'); ?>" rows="7" cols="20" ><?php echo $application7_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application7_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application7_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application7_learn_more_link'); ?>" type="text" value="<?php echo $application7_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application7_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application7_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application7_learn_more_text'); ?>" type="text" value="<?php echo $application7_learn_more_text; ?>" /></label></p>
	</div>
    
	<h3 id="acc-title" class="acc-title">Application 8</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">
	<p><label for="<?php echo $this->get_field_id('application8_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application8_name'); ?>" name="<?php echo $this->get_field_name('application8_name'); ?>" type="text" value="<?php echo $application8_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application8_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application8_img'); ?>" name="<?php echo $this->get_field_name('application8_img'); ?>" type="text" value="<?php echo $application8_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application8_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application8_img_alt'); ?>" name="<?php echo $this->get_field_name('application8_img_alt'); ?>" type="text" value="<?php echo $application8_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application8_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application8_product_feature'); ?>" name="<?php echo $this->get_field_name('application8_product_feature'); ?>" type="text" value="<?php echo $application8_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application8_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application8_content'); ?>" name="<?php echo $this->get_field_name('application8_content'); ?>" type="text" value="<?php echo $application8_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application8_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application8_content'); ?>" name="<?php echo $this->get_field_name('application8_content'); ?>" rows="7" cols="20" ><?php echo $application8_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application8_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application8_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application8_learn_more_link'); ?>" type="text" value="<?php echo $application8_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application8_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application8_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application8_learn_more_text'); ?>" type="text" value="<?php echo $application8_learn_more_text; ?>" /></label></p>
	</div>
    
   	<h3 id="acc-title" class="acc-title">Application 9</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">
    <p><label for="<?php echo $this->get_field_id('application9_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application9_name'); ?>" name="<?php echo $this->get_field_name('application9_name'); ?>" type="text" value="<?php echo $application9_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application9_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application9_img'); ?>" name="<?php echo $this->get_field_name('application9_img'); ?>" type="text" value="<?php echo $application9_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application9_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application9_img_alt'); ?>" name="<?php echo $this->get_field_name('application9_img_alt'); ?>" type="text" value="<?php echo $application9_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application9_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application9_product_feature'); ?>" name="<?php echo $this->get_field_name('application9_product_feature'); ?>" type="text" value="<?php echo $application9_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application9_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application9_content'); ?>" name="<?php echo $this->get_field_name('application9_content'); ?>" type="text" value="<?php echo $application9_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application9_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application9_content'); ?>" name="<?php echo $this->get_field_name('application9_content'); ?>" rows="7" cols="20" ><?php echo $application9_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application9_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application9_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application9_learn_more_link'); ?>" type="text" value="<?php echo $application9_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application9_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application9_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application9_learn_more_text'); ?>" type="text" value="<?php echo $application9_learn_more_text; ?>" /></label></p>
	</div>

	<h3 id="acc-title" class="acc-title">Application 10</h3>  
  	<div id="acc-content" class="acc-content" style="display: none;">
    <p><label for="<?php echo $this->get_field_id('application10_name'); ?>">Application Name<input class="widefat" id="<?php echo $this->get_field_id('application10_name'); ?>" name="<?php echo $this->get_field_name('application10_name'); ?>" type="text" value="<?php echo $application10_name; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application10_img'); ?>">Application Image<input class="widefat" id="<?php echo $this->get_field_id('application10_img'); ?>" name="<?php echo $this->get_field_name('application10_img'); ?>" type="text" value="<?php echo $application10_img; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application10_img_alt'); ?>">Application Image Alt<input class="widefat" id="<?php echo $this->get_field_id('application10_img_alt'); ?>" name="<?php echo $this->get_field_name('application10_img_alt'); ?>" type="text" value="<?php echo $application10_img_alt; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application10_product_feature'); ?>">Product To Feature<input class="widefat" id="<?php echo $this->get_field_id('application10_product_feature'); ?>" name="<?php echo $this->get_field_name('application10_product_feature'); ?>" type="text" value="<?php echo $application10_product_feature; ?>" /></label></p>
    <!--<p><label for="<?php echo $this->get_field_id('application10_content'); ?>">Application Content<input class="widefat" id="<?php echo $this->get_field_id('application10_content'); ?>" name="<?php echo $this->get_field_name('application10_content'); ?>" type="text" value="<?php echo $application10_content; ?>" /></label></p>-->
    <p><label for="<?php echo $this->get_field_id('application10_content'); ?>">Application Content<textarea class="widefat" id="<?php echo $this->get_field_id('application10_content'); ?>" name="<?php echo $this->get_field_name('application10_content'); ?>" rows="7" cols="20" ><?php echo $application10_content; ?></textarea></label></p>
    <p><label for="<?php echo $this->get_field_id('application10_learn_more_link'); ?>">Application Read More Link<input class="widefat" id="<?php echo $this->get_field_id('application10_learn_more_link'); ?>" name="<?php echo $this->get_field_name('application10_learn_more_link'); ?>" type="text" value="<?php echo $application10_learn_more_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('application10_learn_more_text'); ?>">Application Read More Text<input class="widefat" id="<?php echo $this->get_field_id('application10_learn_more_text'); ?>" name="<?php echo $this->get_field_name('application10_learn_more_text'); ?>" type="text" value="<?php echo $application10_learn_more_text; ?>" /></label></p>
	</div>
    </div>
    
  <?php 
    }
}
add_action('widgets_init', create_function('', 'return register_widget("IndustryApplicationWidget");'));
add_action('admin_enqueue_scripts','wptuts53021_load_admin_script');
function wptuts53021_load_admin_script( $hook ){
    wp_enqueue_script('wptuts53021_script',get_template_directory_uri().'/js/adminjs.js',array('jquery'),'',true);
}



function twentyeleven_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php the_post_thumbnail(); ?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
	<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
	?>
	</a>

	<?php endif; // End is_singular()
}

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyeleven_posted_on() {
	// Set up and print post meta information.
	printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;

function post_meta_datas(){

 // Translators: used between list items, there is a space after the comma.
 $categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
 if ( $categories_list ) {
  echo '<span class="categories-links">' . $categories_list . '</span>';
 }

 // Translators: used between list items, there is a space after the comma.
 $tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
 if ( $tag_list ) {
  echo '<span class="tags-links">' . $tag_list . '</span>';
 }

 // Post author
 if ( 'post' == get_post_type() ) {
  printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
   esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
   esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
   get_the_author()
  );
 }
}

if ( ! function_exists( 'twentyeleven_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */

function twentyeleven_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( 'Previous', 'twentyeleven' ),
		'next_text' => __( 'Next', 'twentyeleven' ),
		'type' => 'list'
	) );

	if ( $links ) :

	?>
	<div class="navigation paging-navigation" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</div><!-- .navigation -->
	<?php
	endif;
}
endif;

function custom_excerpt_length( $length ) {
 return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
return ' <a class="more-link" href="'.get_permalink().'">Read More...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_action( 'init', 'custom_taxonomy_Industry' );
function custom_taxonomy_Industry()  {
$labels = array(
    'name'                       => 'Industry',
    'singular_name'              => 'Industry',
    'menu_name'                  => 'Industry',
    'all_items'                  => 'All Industries',
    'parent_item'                => 'Parent Industry',
    'parent_item_colon'          => 'Parent Industry:',
    'new_item_name'              => 'New Item Industry',
    'add_new_item'               => 'Add New Industry',
    'edit_item'                  => 'Edit Industry',
    'update_item'                => 'Update Industry',
    'separate_items_with_commas' => 'Separate Industry with commas',
    'search_items'               => 'Search Industry',
    'add_or_remove_items'        => 'Add or remove Industries',
    'choose_from_most_used'      => 'Choose from the most used Industries',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'industry', 'product', $args );
register_taxonomy_for_object_type( 'industry', 'product' );
}


add_action( 'init', 'custom_taxonomy_Application' );
function custom_taxonomy_Application()  {
$labels = array(
    'name'                       => 'Application',
    'singular_name'              => 'Application',
    'menu_name'                  => 'Application',
    'all_items'                  => 'All Applications',
    'parent_item'                => 'Parent Application',
    'parent_item_colon'          => 'Parent Application:',
    'new_item_name'              => 'New Item Application',
    'add_new_item'               => 'Add New Application',
    'edit_item'                  => 'Edit Application',
    'update_item'                => 'Update Application',
    'separate_items_with_commas' => 'Separate Application with commas',
    'search_items'               => 'Search Application',
    'add_or_remove_items'        => 'Add or remove Applications',
    'choose_from_most_used'      => 'Choose from the most used Applications',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'application', 'product', $args );
register_taxonomy_for_object_type( 'application', 'product' );
}



add_shortcode( 'ind_products_code', 'ind_product_code' );

function ind_product_code( $atts ) {

  extract(shortcode_atts( array(
      'per_page' => '16',
      'industries' => '',  
    ), $atts ));
	
	ob_start();
    if ( ! $atts['industries'] ) {
      return '';
    }

    $args = array(
      'post_type'        => 'product',
      'posts_per_page'     => $atts['per_page'],
	  'orderby' => 'name',
	  'order' => 'asc',
      'tax_query'       => array(
        array(
          'taxonomy'     => 'industry',
          'terms'     => array_map( 'sanitize_title', explode( ',', $atts['industries'] ) ),
          'field'     => 'slug'
		)
      )
    );

    if ( isset( $ordering_args['meta_key'] ) ) {
      $args['meta_key'] = $ordering_args['meta_key'];
    }

    ob_start();

    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

    $woocommerce_loop['columns'] = $atts['columns'];

    if ( $products->have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
            <nav class="woocommerce-pagination">
            <div class="holder"></div>
            </nav>
            

		<?php endif;

    woocommerce_reset_loop();
    wp_reset_postdata();
	return ob_get_clean();
	
}



add_shortcode( 'app_products_code', 'app_product_code' );

function app_product_code( $atts ) {

  extract(shortcode_atts( array(
      'per_page' => '16',
      'applications' => '',  
    ), $atts ));
	
	ob_start();
    if ( ! $atts['applications'] ) {
      return '';
    }

    $args = array(
      'post_type'        => 'product',
      'posts_per_page'     => $atts['per_page'],
	  'orderby' => 'name',
	  'order' => 'asc',
      'tax_query'       => array(
        array(
          'taxonomy'     => 'application',
          'terms'     => array_map( 'sanitize_title', explode( ',', $atts['applications'] ) ),
          'field'     => 'slug'
		)
      )
    );

    if ( isset( $ordering_args['meta_key'] ) ) {
      $args['meta_key'] = $ordering_args['meta_key'];
    }

    ob_start();

    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

    $woocommerce_loop['columns'] = $atts['columns'];

    if ( $products->have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
            <nav class="woocommerce-pagination">
            <div class="holder"></div>
            </nav>
            

		<?php endif;

    woocommerce_reset_loop();
    wp_reset_postdata();
	return ob_get_clean();
	
}