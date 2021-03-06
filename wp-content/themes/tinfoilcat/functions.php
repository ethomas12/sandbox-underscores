<?php
/**
 * Tin Foil Cat functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tin_Foil_Cat
 */

if ( ! function_exists( 'tinfoilcat_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tinfoilcat_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Tin Foil Cat, use a find and replace
	 * to change 'tinfoilcat' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'tinfoilcat', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 828, 360, true ); //these parameters are entirely up to you.

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'tinfoilcat' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tinfoilcat_custom_background_args', array(
		'default-color' => 'fffbbc',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'tinfoilcat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tinfoilcat_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tinfoilcat_content_width', 640 );
}
add_action( 'after_setup_theme', 'tinfoilcat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tinfoilcat_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area', 'tinfoilcat' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'tinfoilcat' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tinfoilcat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tinfoilcat_scripts() {
	wp_enqueue_style( 'tinfoilcat-style', get_stylesheet_uri() );

	//Add Google fonts Montserrat and Source Sans pro
	// wp_enqueue_style('tinfoilcat-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,400italic,700,700italic');

	wp_enqueue_style('tinfoilcat-local-fonts', get_template_directory_uri() . '/fonts/custom-fonts.css');

wp_enqueue_style('tinfoilcat-fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css');
	wp_enqueue_script( 'tinfoilcat-navigation', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20151215', true );

	wp_localize_script( 'tinfoilcat-navigation', 'screenReaderText', array(
			'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'tinfoilcat' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'tinfoilcat' ) . '</span>',
		) );

	wp_enqueue_script( 'tinfoilcat-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tinfoilcat_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
