<?php

/**
 * Eurasia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Eurasia
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}
add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
	add_theme_support('woocommerce');
}
// *
// * Изменения WooCommerce
// *
// удаление фотографий в категориях товаров
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);

// удаление ссылки на страницу товара
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

// добавление обертки фотографии в карточке товара
add_action('woocommerce_before_shop_loop_item', 'product_img_wrapper_start', 4);
add_action('woocommerce_shop_loop_item_title', 'wrapper_end', 7);

// обертка текста в карточке товара
add_action('woocommerce_shop_loop_item_title', 'product_content_wrapper_start', 8);

// добавление описания в карточке товара
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 4);

// перемещение цены в карточке товара
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action('woocommerce_after_shop_loop_item', 'shop_loop_item_wrapper_start', 4);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 4);
add_action('woocommerce_after_shop_loop_item', 'wrapper_end', 20);
add_action('woocommerce_after_shop_loop_item', 'wrapper_end', 21);

// !archive-product.php
// удаление хлебных крошек
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// удаление количества выведенных товаров, удаление сортировки товаров
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

function product_img_wrapper_start()
{
	echo '<div class="product-img">';
}
function product_content_wrapper_start()
{
	echo '<div class="product-content">';
}
function shop_loop_item_wrapper_start()
{
	echo '<div class="product-footer">';
}
function wrapper_end()
{
	echo '</div>';
}




if (!function_exists('eurasia_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eurasia_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Eurasia, use a find and replace
		 * to change 'eurasia' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('eurasia', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header-menu' => esc_html__('Header menu', 'eurasia'),
				'footer-menu-left' => esc_html__('Footer menu left', 'eurasia'),
				'footer-menu-right' => esc_html__('Footer menu right', 'eurasia'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'eurasia_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'eurasia_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eurasia_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('eurasia_content_width', 640);
}
add_action('after_setup_theme', 'eurasia_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eurasia_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'eurasia'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'eurasia'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'eurasia_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function eurasia_scripts()
{

	// wp_enqueue_style('eurasia-slick', get_template_directory_uri() . '/assets/css/slick.css', array(), _S_VERSION);
	wp_enqueue_style('eurasia-custom', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION);

	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.5.0.min.js', array(), false, true);

	wp_enqueue_script('eurasia-slick.min-js', get_template_directory_uri() . '/assets/js/slick.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('eurasia-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), _S_VERSION, true);
	wp_enqueue_script('eurasia-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'eurasia_scripts');



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
