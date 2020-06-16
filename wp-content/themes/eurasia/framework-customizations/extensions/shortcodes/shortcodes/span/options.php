<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'span_icon'       => array(
		'type' => 'icon',
		'label' => __('Span Icon', 'fw')
	),
	'span_content'    => array(
		'type'  => 'text',
		'label' => __('Span Content', 'fw'),
		'desc'  => __('Span Content', 'fw'),
	),

	// === Custom ===
	'span_class'    => array(
		'label' => __('Span Class', 'fw'),
		'desc'  => __('Span Class', 'fw'),
		'type'  => 'text',
	),
	'span_id'    => array(
		'label' => __('Span ID', 'fw'),
		'desc'  => __('Span ID', 'fw'),
		'type'  => 'text',
	),
	'span_data_attrs'    => array(
		'type'  => 'text',
		'label' => __('Attributes', 'fw'),
		'desc'  => __('Attributes', 'fw'),
	),
);
