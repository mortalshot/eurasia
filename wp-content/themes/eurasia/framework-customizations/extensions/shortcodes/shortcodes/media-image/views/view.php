<?php if (!defined('FW')) {
	die('Forbidden');
}

/**
 * @var array $atts
 */

if (empty($atts['image'])) {
	return;
}
$thumb = '';
if (!empty($atts['thumb'])) {
	$thumb = $atts['thumb']['url'];
}

$width  = (is_numeric($atts['width']) && ($atts['width'] > 0)) ? $atts['width'] : '';
$height = (is_numeric($atts['height']) && ($atts['height'] > 0)) ? $atts['height'] : '';

if (!empty($width) && !empty($height)) {
	$image = fw_resize($atts['image']['attachment_id'], $width, $height, true);
} else {
	$image = $atts['image']['url'];
}

$alt = get_post_meta($atts['image']['attachment_id'], '_wp_attachment_image_alt', true);

if (!empty($thumb)) {
	$img_attributes = array(
		'data-src' => $image,
		'src' => $thumb,
		'alt' => $alt ? $alt : $image,
		'class' => 'lazy'
	);
} else {
	$img_attributes = array(
		'src' => $image,
		'alt' => $alt ? $alt : $image
	);
}

if (!empty($width)) {
	$img_attributes['width'] = $width;
}

if (!empty($height)) {
	$img_attributes['height'] = $height;
}
if (!empty($atts['wrapper'])) {
	echo '<div class="image-wrapper '. $atts['wrapper_class'] . '">';
	if (empty($atts['link'])) {
		echo fw_html_tag('img', $img_attributes);
	} else {
		echo fw_html_tag('a', array(
			'href' => $atts['link'],
			'target' => $atts['target'],
		), fw_html_tag('img', $img_attributes));
	}
	echo '</div>';
} else {
	if (empty($atts['link'])) {
		echo fw_html_tag('img', $img_attributes);
	} else {
		echo fw_html_tag('a', array(
			'href' => $atts['link'],
			'target' => $atts['target'],
		), fw_html_tag('img', $img_attributes));
	}
}
