<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'shortcode'    => array(
		'label' => __('Shortcode', 'fw'),
		'desc'  => __('Введите shortcode, например, [booking]', 'fw'),
		'type'  => 'text',
	),
	'class'    => array(
		'label' => __('Class', 'fw'),
		'desc'  => __('Введите класс для обертки shortcode', 'fw'),
		'type'  => 'text',
	),
);
