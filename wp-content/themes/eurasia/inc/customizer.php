<?php

/**
 * Eurasia Theme Customizer
 *
 * @package Eurasia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function eurasia_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'eurasia_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'eurasia_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_section('eurasia_information', array(
		'title'		=> 'Информация сайта',
		'priority'	=> 10,
	));

	$wp_customize->add_setting('eurasia_address', array(
		'default'	=> '',
	));
	$wp_customize->add_control(
		'eurasia_address',
		array(
			'label'		=> 'Адрес ресторана',
			'section'	=> 'eurasia_information',
		)
	);

	$wp_customize->add_setting('eurasia_hours', array(
		'default'	=> '',
	));
	$wp_customize->add_control(
		'eurasia_hours',
		array(
			'label'		=> 'Часы работы ресторана',
			'section'	=> 'eurasia_information',
		)
	);

	$wp_customize->add_setting('eurasia_phone', array(
		'default'	=> '',
	));
	$wp_customize->add_control(
		'eurasia_phone',
		array(
			'label'		=> 'Номер телефона',
			'section'	=> 'eurasia_information',
		)
	);
}
add_action('customize_register', 'eurasia_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function eurasia_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function eurasia_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eurasia_customize_preview_js()
{
	wp_enqueue_script('eurasia-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'eurasia_customize_preview_js');
