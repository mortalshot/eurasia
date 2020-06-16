<?php if (!defined('FW')) die('Forbidden'); ?>
<?php $color_class = !empty($atts['color']) ? "fw-btn-{$atts['color']}" : ''; ?>
<?php $custom_class = (isset($atts['custom_class']) && $atts['custom_class']) ? $atts['custom_class'] : ''; ?>
<a href="<?php echo esc_attr($atts['link']) ?>"
	target="<?php echo esc_attr($atts['target']) ?>" class="<?php echo esc_attr($color_class); ?> <?php echo esc_attr($custom_class); ?>"
<?php if (!empty($atts['custom_id'])) echo 'id="' . $atts['custom_id'] . '"' ?> 
<?php if (!empty($atts['data_toggle'])) echo 'data-toggle="' . $atts['data_toggle'] . '"' ?> 
<?php if (!empty($atts['data_target'])) echo 'data-target="' . $atts['data_target'] . '"' ?>>
	<span><?php echo $atts['label']; ?></span>
</a>