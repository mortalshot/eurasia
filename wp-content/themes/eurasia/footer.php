	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-top">
				<a class="logo" href="<?php echo home_url(); ?>">
					<div class="logo__title">Евразия</div>
					<div class="logo__subtitle">РЕСТОРАН</div>
				</a>
				<div class="footer-navigation">
					<nav class="footer-navigation__left">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'footer-menu-left',
								'menu_id'        => 'footer-menu-left',
								'container' 		=> false,
								'menu_class'        => 'footer-menu',
							)
						); ?>
					</nav>
					<nav class="footer-navigation__right">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'footer-menu-right',
								'menu_id'        => 'footer-menu-right',
								'container' 		=> false,
								'menu_class'        => 'footer-menu',
							)
						); ?>
					</nav>
				</div>
				<div data-da="footer-bottom, 0, 575" class="information">
					<div class="phone"><a class="phone__link footer-phone__link" href="tel:<?php echo get_theme_mod('eurasia_phone') ?>"><?php echo get_theme_mod('eurasia_phone') ?></a></div>
					<div class="information__address"><?php echo get_theme_mod('eurasia_address') ?></div>
					<div class="information__hours"><?php echo get_theme_mod('eurasia_hours') ?></div>
				</div>


			</div>
			<div class="footer-bottom">
				<div class="policy"><a href="<?php echo get_page_link(3) ?>">Евразия, все права защищены</a></div>
			</div>

		</div>
	</footer>
	</div>

	<?php wp_footer(); ?>

	</body>

	</html>