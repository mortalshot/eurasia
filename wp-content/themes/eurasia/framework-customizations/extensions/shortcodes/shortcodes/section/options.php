<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'is_fullwidth' => array(
		'label'        => __('Full Width', 'fw'),
		'type'         => 'switch',
	),
	'background_color' => array(
		'label' => __('Background Color', 'fw'),
		'desc'  => __('Please select the background color', 'fw'),
		'type'  => 'color-picker',
	),
	'background_image' => array(
		'label'   => __('Background Image', 'fw'),
		'desc'    => __('Please select the background image', 'fw'),
		'type'    => 'background-image',
		'choices' => array(//	in future may will set predefined images
		)
	),
	'video' => array(
		'label' => __('Background Video', 'fw'),
		'desc'  => __('Insert Video URL to embed this video', 'fw'),
		'type'  => 'text',
	),

	// === Custom ===
	'custom_id' => array(
		'label' => __('Custom ID', 'clean'),
		'desc'  => __('Insert custom id in the field', 'clean'),
		'type'  => 'text',
	),
	'custom_class' => array(
		'label' => __('Custom Class', 'clean'),
		'desc'  => __('Insert custom class in the field', 'clean'),
		'type'  => 'text',
	),
	'thumb'            => array(
		'type'  => 'upload',
		'label' => __('Заглушка', 'fw'),
		'desc'  => __('Заглушка для изображения, используется для ленивой загрузки', 'fw')
	),
	
);
