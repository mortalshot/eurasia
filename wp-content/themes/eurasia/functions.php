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

// !archive-product.php
// удаление хлебных крошек
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// удаление количества выведенных товаров, удаление сортировки товаров
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// удаление лейбла с распродажей
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

// изменение структуры вывода продуктов и категорий на странице shop
remove_filter('woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories');
add_action('woocommerce_before_shop_loop', 'eurasia_show_category', 40);
function eurasia_show_category()
{
	if (is_shop()) {
		echo '<div class="product-menu product-menu--page-shop">';
	} else {
		echo '<div class="product-menu">';
	}
	echo '<div class="woocommerce">';
	woocommerce_product_loop_start();
	echo woocommerce_maybe_show_product_subcategories();
	woocommerce_product_loop_end();
	echo '</div>';
	echo '</div>';
}

/* Добавление вариаций в архив продукт */
// Замена стандартной кнопки добавления в корзину
function iconic_change_loop_add_to_cart()
{
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
	add_action('woocommerce_after_shop_loop_item', 'iconic_template_loop_add_to_cart', 10);
}
add_action('init', 'iconic_change_loop_add_to_cart', 10);

// Удаление вариативной цены
add_filter('woocommerce_variable_sale_price_html', 'my_remove_variation_price', 10, 2);
add_filter('woocommerce_variable_price_html', 'my_remove_variation_price', 10, 2);
function my_remove_variation_price($price)
{
	$price = '';
	return $price;
}

// Если объект не вариативный, то подгружаем стандартную функцию, в противном случае будем использовать свой код
function iconic_template_loop_add_to_cart()
{
	global $product;

	if (!$product->is_type('variable')) {
		woocommerce_template_loop_add_to_cart();
		return;
	}

	remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
	add_action('woocommerce_single_variation', 'iconic_loop_variation_add_to_cart_button', 20);

	woocommerce_template_single_add_to_cart();
}

// Вид блока покупки, где будет поле выбора доступных вариантов
function iconic_loop_variation_add_to_cart_button()
{
	global $product;
?>
	<div class="woocommerce-variation-add-to-cart variations_button">
		<button type="submit" class="single_add_to_cart_button button ajax_add_to_cart"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
		<input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
		<input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
		<input type="hidden" name="variation_id" class="variation_id" value="0" />
	</div>
<?php
}

// Удаление редиректа на страницу продукта
function iconic_add_to_cart_form_action($redirect)
{
	if (!is_archive() && !is_front_page()) {
		return $redirect;
	}
	return '';
}
add_filter('woocommerce_add_to_cart_form_action', 'iconic_add_to_cart_form_action');

// !cart.php
/* Изменение названий полей */
function tb_text_strings($translated_text, $text, $domain)
{
	switch ($translated_text) {
		case 'Подытог':
			$translated_text = __('Итого:', 'woocommerce');
			break;
		case 'Итого':
			$translated_text = __('К оплате:', 'woocommerce');
			break;
		case 'Оформить заказ':
			$translated_text = __('Заказать', 'woocommerce');
			break;
		case 'Оплата и доставка':
			$translated_text = __('Контактные данные', 'woocommerce');
			break;
		case 'Отправить комментарий':
			$translated_text = __('Добавить отзыв', 'woocommerce');
			break;
		case 'Ваш адрес email не будет опубликован.':
			$translated_text = __('Ваш адрес электронной почты не будет указываться в общем доступе.', 'woocommerce');
			break;
	}
	return $translated_text;
}
add_filter('gettext', 'tb_text_strings', 20, 3);

// Динамическое изменение суммы корзины в хедере страницы
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment($fragments)
{
	ob_start(); ?>
	<div class="header-cart__price"><?php echo WC()->cart->get_cart_total() ?></div>
<?php $fragments['.header-cart__price'] = ob_get_clean();
	return $fragments;
}

// !checkout.php
/* Удаление купона */
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);

/* Удаление лишних полей оформления заказа */
add_filter('woocommerce_checkout_fields', 'eurasia_override_checkout_fields');
function eurasia_override_checkout_fields($fields)
{
	unset($fields['billing']['billing_last_name']);
	unset($fields['shipping']['shipping_last_name']);
	unset($fields['billing']['billing_country']);
	unset($fields['shipping']['shipping_country']);
	unset($fields['billing']['billing_city']);
	unset($fields['shipping']['shipping_city']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['shipping']['shipping_postcode']);
	unset($fields['billing']['billing_state']);
	unset($fields['shipping']['shipping_state']);
	return $fields;
}

/* Изменение текста placeholder для полей */
add_filter('woocommerce_default_address_fields', 'override_default_address_checkout_fields', 20, 1);
function override_default_address_checkout_fields($address_fields)
{
	$address_fields['first_name']['placeholder'] = 'Ваше имя';
	$address_fields['address_1']['placeholder'] = 'Адрес доставки';
	return $address_fields;
}
add_filter('woocommerce_checkout_fields', 'override_billing_checkout_fields', 20, 1);
function override_billing_checkout_fields($fields)
{
	$fields['billing']['billing_phone']['placeholder'] = 'Номер телефона';
	$fields['billing']['billing_email']['placeholder'] = 'E-mail';
	return $fields;
}

/* Добавление звездочек к комментарию на странице отзывов */
add_action('comment_form_logged_in_after', 'comm_rating_rating_field');
add_action('comment_form_after_fields', 'comm_rating_rating_field');
function comm_rating_rating_field()
{ ?>
	<div class="comment-rating" data-total-value="0">
		<?php for ($i = 5; $i >= 1; $i--) : ?>
			<span class="comment-rating__item" data-item-value="<?php echo esc_attr($i); ?>">
				<input type="radio" id="rating-<?php echo esc_attr($i); ?>" name="rating" value="<?php echo esc_attr($i); ?>" /><label for="rating-<?php echo esc_attr($i); ?>"></label>
			</span>
		<?php endfor; ?>
	</div>
<?php
}
//Сохранение результата
add_action('comment_post', 'comm_rating_save_comment_rating');
function comm_rating_save_comment_rating($comment_id)
{
	if ((isset($_POST['rating'])) && ('' !== $_POST['rating']))
		$rating = intval($_POST['rating']);
	add_comment_meta($comment_id, 'rating', $rating);
}
//required на рейтинг
add_filter('preprocess_comment', 'comm_rating_require_rating');
function comm_rating_require_rating($commentdata)
{
	if (!isset($_POST['rating']) || 0 === intval($_POST['rating']))
		wp_die('Ошибка: Вы не добавили оценку. Нажмите кнопку «Назад» в своем веб-браузере и повторно отправьте свой комментарий с оценкой.');
	return $commentdata;
}
//Отображение рейтинга в комментариях
add_filter('comment_text', 'comm_rating_display_rating');
function comm_rating_display_rating($comment_text)
{
	if ($rating = get_comment_meta(get_comment_ID(), 'rating', true)) {
		$stars = '<div class="rating">';
		for ($i = 0; $i < 5; $i++) {
			if ($i < $rating) {
				$stars .= '<span class="rating__icon active"></span>';
			} else {
				$stars .= '<span class="rating__icon"></span>';
			}
		}
		$stars .= '</div>';
		$comment_text = $comment_text . $stars;
		return $comment_text;
	} else {
		return $comment_text;
	}
}

/* Изменение порядка полей */
function sort_comment_fields($fields)
{
	$new_fields = array();
	$myorder = array('author', 'email', 'url', 'comment');

	foreach ($myorder as $key) {
		$new_fields[$key] = $fields[$key];
		unset($fields[$key]);
	}

	if ($fields)
		foreach ($fields as $key => $val)
			$new_fields[$key] = $val;
	return $new_fields;
}
add_filter('comment_form_fields', 'sort_comment_fields');

/* Добавление placeholder в поля комментариев */
function my_update_fields($fields)
{
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');

	$fields['author'] =
		'<p class="comment-form-author">
            <input required minlength="3" maxlength="30" placeholder="Ваше имя" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
		'" size="30"' . $aria_req . ' />
        </p>';

	$fields['email'] =
		'<p class="comment-form-email">
            <input required placeholder="E-mail" id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) .
		'" size="30"' . $aria_req . ' />
        </p>';

	return $fields;
}
add_filter('comment_form_default_fields', 'my_update_fields');
function my_update_comment_field($comment_field)
{
	$comment_field =
		'<p class="comment-form-comment">
            <textarea required placeholder="Отзыв" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';

	return $comment_field;
}
add_filter('comment_form_field_comment', 'my_update_comment_field');



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
	wp_enqueue_script('eurasia-maskedinput-js', get_template_directory_uri() . '/assets/js/maskedinput.js', array(), _S_VERSION, true);
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
