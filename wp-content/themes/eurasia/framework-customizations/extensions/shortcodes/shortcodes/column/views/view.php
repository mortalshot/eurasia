<?php if (!defined('FW')) die('Forbidden');
$class = fw_ext_builder_get_item_width('page-builder', $atts['width'] . '/frontend_class');
$custom_id = (isset($atts['custom_id']) && $atts['custom_id']) ? $atts['custom_id'] : '';
$custom_class = (isset($atts['custom_class']) && $atts['custom_class']) ? $atts['custom_class'] : '';
$bg_image = '';
if (!empty($atts['background_image']) && !empty($atts['background_image']['data']['icon'])) {
	$bg_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');';
}
$section_style   = ($bg_image) ? 'style="' . esc_attr($bg_image) . '"' : '';
?>
<?php if (!empty($atts['link'])) : ?>
	<div class="<?php echo esc_attr($class);
				echo ' ';
				echo esc_attr($custom_class); ?>" id="<?php echo esc_attr($custom_id); ?>" <?php echo $section_style; ?>>
		<a href="<?php echo $atts['link'] ?>">
			<?php echo do_shortcode($content); ?>
		</a>
	</div>
<?php else : ?>
	<div class="<?php echo esc_attr($class);
				echo ' ';
				echo esc_attr($custom_class); ?>" id="<?php echo esc_attr($custom_id); ?>" <?php echo $section_style; ?>>
		<?php echo do_shortcode($content); ?>
	</div>
<?php endif; ?>