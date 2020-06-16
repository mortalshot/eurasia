<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'image'            => array(
		'type'  => 'upload',
		'label' => __('Choose Image', 'fw'),
		'desc'  => __('Either upload a new, or choose an existing image from your media library', 'fw')
	),
	'size'             => array(
		'type'    => 'group',
		'options' => array(
			'width'  => array(
				'type'  => 'text',
				'label' => __('Width', 'fw'),
				'desc'  => __('Set image width', 'fw'),
				'value' => 300
			),
			'height' => array(
				'type'  => 'text',
				'label' => __('Height', 'fw'),
				'desc'  => __('Set image height', 'fw'),
				'value' => 200
			)
		)
	),
	'image-link-group' => array(
		'type'    => 'group',
		'options' => array(
			'link'   => array(
				'type'  => 'text',
				'label' => __('Image Link', 'fw'),
				'desc'  => __('Where should your image link to?', 'fw')
			),
			'target' => array(
				'type'         => 'switch',
				'label'        => __('Open Link in New Window', 'fw'),
				'desc'         => __('Select here if you want to open the linked page in a new window', 'fw'),
				'right-choice' => array(
					'value' => '_blank',
					'label' => __('Yes', 'fw'),
				),
				'left-choice'  => array(
					'value' => '_self',
					'label' => __('No', 'fw'),
				),
			),
			'wrapper' => array(
				'type'         => 'switch',
				'label'        => __('Обёртка для изображения', 'fw'),
				'desc'         => __('Выберите да, если нужно обернуть изображение в div', 'fw'),
			),
			'wrapper_class' => array(
				'type'         => 'text',
				'label'        => __('Накладывает класс на обертку', 'fw'),
				'desc'         => __('Накладывает класс на обертку', 'fw'),
			),
			'thumb'            => array(
				'type'  => 'upload',
				'label' => __('Заглушка', 'fw'),
				'desc'  => __('Заглушка для изображения, используется для ленивой загрузки', 'fw')
			),
		)
	)
);
