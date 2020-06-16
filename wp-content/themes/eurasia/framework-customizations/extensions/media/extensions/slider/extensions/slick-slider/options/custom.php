<?php if (!defined('FW')) die('Forbidden'); 

$options = array(
    'note'  => array (
        'type'  => 'text',
        'label' => __('Примечание', 'fw'),
        'value' => '',
        'desc'  => __('Введите примечание для слайда')
    ),
    'link'  => array (
        'type'  => 'text',
        'label' => __('Ссылка', 'fw'),
        'value' => '',
        'desc'  => __('Вставьте ссылку, куда будет переходить пользователь, нажав на слайдер, если это нужно')
    )
)

?>