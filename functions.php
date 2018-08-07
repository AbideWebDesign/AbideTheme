<?php
/**
 * Abide Web Design functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Abide_Web_Design
 */

if ( ! function_exists( 'abide_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function abide_setup() {
		
		require WP_CONTENT_DIR . '/plugins/plugin-update-checker-master/plugin-update-checker.php';
		$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
			'https://github.com/AbideWebDesign/AbideTheme',
			__FILE__,
			'AbideTheme'
		);
		$myUpdateChecker->setBranch('master'); 
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'abide' ),
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
		
		function remove_menus(){
			remove_menu_page( 'edit.php' ); //Posts
			
			if(!is_admin()) {
				remove_menu_page( 'themes.php' ); //Appearance
				remove_menu_page( 'plugins.php' ); //Plugins
				remove_menu_page( 'users.php' ); //Users
				remove_menu_page( 'tools.php' ); //Tools
			}
		}
		add_action( 'admin_menu', 'remove_menus' );
	
		function remove_wp_logo( $wp_admin_bar ) {
			$wp_admin_bar->remove_node( 'wp-logo' );
		}
		add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
	
		function remove_wp_nodes() {
		    global $wp_admin_bar;   
		    $wp_admin_bar->remove_node( 'new-post' );
		    $wp_admin_bar->remove_menu( 'autoptimize' );
		    $wp_admin_bar->remove_menu( 'customize' );
		}
		add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );
	}
endif;
add_action( 'after_setup_theme', 'abide_setup' );

/**
 * Enqueue scripts and styles.
 */
function abide_scripts() {
	wp_enqueue_style( 'fa-solid-style', get_template_directory_uri() . '/css/fa-solid.min.css' );
	
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() . '/css/fontawesome.min.css' );
	
	wp_enqueue_style( 'fancybox-style', get_template_directory_uri() . '/css/jquery.fancybox.min.css' );
	
	wp_enqueue_style( 'abide-style', get_template_directory_uri() . '/style.css' );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.3.1.min.js', array(), null );
	
	wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array('jquery'), null, true );
	
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), null, true );
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery', 'popper'), null, true );
	
	wp_enqueue_script( 'site-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true );
			
	wp_enqueue_script( 'abide-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'abide_scripts' );

/**
 * Image sizes
 */
add_image_size('header', 1440);
add_image_size('col-6', 540);
add_image_size('col-4', 350);
add_image_size('col-5', 432);
add_image_size('col-7', 635);
add_image_size('square', 540, 540, true);

/**
 * ACF Options page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}