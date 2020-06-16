<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'label'  => array(
		'label' => __('Button Label', 'fw'),
		'desc'  => __('This is the text that appears on your button', 'fw'),
		'type'  => 'text',
		'value' => 'Submit'
	),
	'link'   => array(
		'label' => __('Button Link', 'fw'),
		'desc'  => __('Where should your button link to', 'fw'),
		'type'  => 'text',
		'value' => '#'
	),
	'target' => array(
		'type'  => 'switch',
		'label'   => __('Open Link in New Window', 'fw'),
		'desc'    => __('Select here if you want to open the linked page in a new window', 'fw'),
		'right-choice' => array(
			'value' => '_blank',
			'label' => __('Yes', 'fw'),
		),
		'left-choice' => array(
			'value' => '_self',
			'label' => __('No', 'fw'),
		),
	),
	'color'  => array(
		'label'   => __('Button Color', 'fw'),
		'desc'    => __('Choose a color for your button', 'fw'),
		'type'    => 'select',
		'choices' => array(
			''      => __('Default', 'fw'),
			'black' => __('Black', 'fw'),
			'blue'  => __('Blue', 'fw'),
			'green' => __('Green', 'fw'),
			'red'   => __('Red', 'fw'),
		)
	),
	'custom_id'  => array(
		'label' => __('ID элемента', 'notary'),
		'desc'  => __('Добавьте ID кнопке, если это требуется', 'notary'),
		'type'  => 'text',
	),
	'custom_class'  => array(
		'label' => __('Class элемента', 'notary'),
		'desc'  => __('Добавьте Class кнопке, если это требуется', 'notary'),
		'type'  => 'text',
	),
	'data_toggle'   => array(
		'label' => __('Button data-toggle', 'fw'),
		'desc'  => __('insert your data-toggle if you need', 'fw'),
		'type'  => 'text',
	),
	'data_target'   => array(
		'label' => __('Button data-target', 'fw'),
		'desc'  => __('insert your data-target if you need', 'fw'),
		'type'  => 'text',
	),
);
