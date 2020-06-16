<?php if (!defined('FW')) {
	die('Forbidden');
}

$bg_color = '';
if (!empty($atts['background_color'])) {
	$bg_color = 'background-color:' . $atts['background_color'] . ';';
}

$bg_image = '';
if (!empty($atts['background_image']) && !empty($atts['background_image']['data']['icon'])) {
	$bg_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');';
	$bg_url = $atts['background_image']['data']['icon'] . '';
}

$thumb = '';
if (!empty($atts['thumb'])) {
	$thumb = $atts['thumb']['url'];
	$bg_thumb = 'background-image:url(' . $thumb . ');';
}

$bg_video_data_attr    = '';
$section_extra_classes = '';
if (!empty($atts['video'])) {
	$filetype           = wp_check_filetype($atts['video']);
	$filetypes          = array('mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster');
	$filetype           = array_key_exists((string) $filetype['ext'], $filetypes) ? $filetypes[$filetype['ext']] : 'video';
	$data_name_attr = version_compare(fw_ext('shortcodes')->manifest->get_version(), '1.3.9', '>=') ? 'data-background-options' : 'data-wallpaper-options';
	$bg_video_data_attr = $data_name_attr . '="' . fw_htmlspecialchars(json_encode(array('source' => array($filetype => $atts['video'])))) . '"';
	$section_extra_classes .= ' background-video';
}
$section_style   = ($bg_color || $bg_image) ? 'style="' . esc_attr($bg_color . $bg_image) . '"' : '';
$container_class = (isset($atts['is_fullwidth']) && $atts['is_fullwidth']) ? 'fw-container-fluid' : 'fw-container';

$custom_id = (isset($atts['custom_id']) && $atts['custom_id']) ? $atts['custom_id'] : '';

$section_extra_classes .= (isset($atts['custom_class']) && $atts['custom_class']) ?  $atts['custom_class'] : '';
if (!empty($atts['thumb']) && $bg_image) {
	$section_extra_classes .= ' ' . 'lazy';
	$section_style = 'style=' . $bg_thumb . ' ' . 'data-bg=' . $bg_url . ' ';
}

?>
<section <?php if($custom_id) echo 'id="' . esc_attr($custom_id) . '"' ?> class="fw-main-row <?php echo esc_attr($section_extra_classes) ?>" <?php echo $section_style; ?> <?php echo $bg_video_data_attr; ?>>
	<div class="<?php echo esc_attr($container_class); ?>">
		<?php echo do_shortcode($content); ?>
	</div>
</section>