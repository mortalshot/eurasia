<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Eurasia
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'eurasia'); ?></a>

		<header id="masthead" class="header">
			<div class="container">
				<div class="header-top">
					<a class="logo" href="<?php echo home_url(); ?>">
						<div class="logo__title">Евразия</div>
						<div class="logo__subtitle">РЕСТОРАН</div>
					</a>
					<div class="information">
						<div class="information__address"><?php echo get_theme_mod('eurasia_address') ?></div>
						<div class="information__hours"><?php echo get_theme_mod('eurasia_hours') ?></div>
					</div>

					<div class="phone header-phone"><a class="phone__link header-phone__link" href="tel:<?php echo get_theme_mod('eurasia_phone') ?>"><?php echo get_theme_mod('eurasia_phone') ?></a></div>

				</div>

				<div class="header-bottom">
					<div class="header-bottom-wrapper">
						<div class="header__burger">
							<span></span>
						</div>
						<nav id="site-navigation" class="main-navigation">

							<?php wp_nav_menu(
								array(
									'theme_location' => 'header-menu',
									'menu_id'        => 'primary-menu',
									'container' 		=> false,
									'menu_class'        => 'main-menu',
								)
							); ?>
						</nav>

						<div class="header-cart-wrapper">
							<a class="header-cart" href="<?php echo get_page_link('7'); ?>">
								<div class="header-cart__icon"><img src="<?php echo get_template_directory_uri() . '/assets/img/icons/header/1.svg' ?>" alt=""></div>
								<div class="header-cart__price"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
							</a>
						</div>
					</div>
				</div>
			</div>

		</header>
		