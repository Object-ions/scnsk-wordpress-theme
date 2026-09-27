<?php
/**
 * SCNSK theme setup.
 *
 * @package scnsk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SCNSK_VERSION', '1.0.2' );

require get_template_directory() . '/inc/template-tags.php';

/**
 * Theme supports, menus, image sizes.
 */
function scnsk_setup() {
	load_theme_textdomain( 'scnsk', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_editor_style( 'assets/css/scnsk.css' );
	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'scnsk' ),
			'footer'  => __( 'Footer menu', 'scnsk' ),
		)
	);

	set_post_thumbnail_size( 1200, 675, true );
	add_image_size( 'scnsk-card', 720, 405, true );
	add_image_size( 'scnsk-wide', 1600, 700, true );
}
add_action( 'after_setup_theme', 'scnsk_setup' );

/**
 * Styles and scripts. Fonts are self-hosted from the brand kit.
 */
function scnsk_assets() {
	wp_enqueue_style( 'scnsk', get_template_directory_uri() . '/assets/css/scnsk.css', array(), SCNSK_VERSION );
	wp_enqueue_script( 'scnsk-nav', get_template_directory_uri() . '/assets/js/nav.js', array(), SCNSK_VERSION, array( 'strategy' => 'defer' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'scnsk_assets' );

/**
 * Preload the two variable font files so headlines don't flash.
 */
function scnsk_preload_fonts() {
	$dir = get_template_directory_uri() . '/assets/fonts/';
	foreach ( array( 'ArchivoExpanded-Variable.woff2', 'Archivo-Variable.woff2' ) as $file ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( $dir . $file ) );
	}
}
add_action( 'wp_head', 'scnsk_preload_fonts', 1 );

/**
 * Favicon + touch icon from the brand kit when no Site Icon is set in the Customizer.
 */
function scnsk_favicons() {
	if ( has_site_icon() ) {
		return;
	}
	$img = get_template_directory_uri() . '/assets/img/';
	echo '<link rel="icon" href="' . esc_url( $img . 'scnsk-favicon.svg' ) . '" type="image/svg+xml">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $img . 'scnsk-apple-touch-icon-180.png' ) . '">' . "\n";
	echo '<meta name="theme-color" content="#1E3A2F">' . "\n";
}
add_action( 'wp_head', 'scnsk_favicons', 2 );

/**
 * Excerpts: short, no "[...]".
 */
function scnsk_excerpt_length() {
	return 26;
}
add_filter( 'excerpt_length', 'scnsk_excerpt_length' );

function scnsk_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'scnsk_excerpt_more' );

/**
 * Body classes that templates use for layout switches.
 */
function scnsk_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'is-home';
	}
	return $classes;
}
add_filter( 'body_class', 'scnsk_body_classes' );

/**
 * Add the brand palette + font sizes to the block editor via theme.json (see theme.json).
 * Disable the WP emoji script: the brand doesn't use emoji in UI.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Register a footer widget-free sidebar? No. SCNSK is one column on purpose.
 * Keep the theme lean: no widgets, no sidebar.
 */
