<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'icon'       => array(
		'type' => 'icon',
		'label' => __( 'Icon', 'fw' )
	),
	'title'    => array(
		'type'  => 'text',
		'label' => __( 'Title', 'fw' ),
		'desc'  => __( 'Icon title', 'fw' ),
	),
	
	// === Custom ===
	'url'    => array(
		'label' => __( 'Url', 'fw' ),
		'desc'  => __( 'icon url', 'fw' ),
		'type'  => 'text',
	),
);