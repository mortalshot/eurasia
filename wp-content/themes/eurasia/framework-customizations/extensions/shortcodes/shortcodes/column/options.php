<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'background_image' => array(
		'label'   => __('Background Image', 'fw'),
		'desc'    => __('Please select the background image', 'fw'),
		'type'    => 'background-image',
		'choices' => array(//	in future may will set predefined images
		)
	),
	'link'   => array(
		'type'  => 'text',
		'label' => __('Image Link', 'fw'),
		'desc'  => __('Where should your image link to?', 'fw')
	),
	'custom_id' => array(
		'label' => __('Custom ID', 'fw'),
		'desc'  => __('Insert custom id in the field', 'fw'),
		'type'  => 'text',
	),
	'custom_class' => array(
		'label' => __('Custom Class', 'fw'),
		'desc'  => __('Insert custom class in the field', 'fw'),
		'type'  => 'text',
	),

);
