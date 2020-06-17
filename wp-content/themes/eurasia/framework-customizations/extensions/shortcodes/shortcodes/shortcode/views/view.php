<?php if (!defined('FW')) {
    die('Forbidden');
}

/**
 * @var array $atts
 */
?>

<?php
if (!empty($atts['class'])) :
    echo '<div class="' . $atts['class'] . '">';
endif;
$shortcode = '';
if (!empty($atts['shortcode'])) {
    $shortcode .= $atts['shortcode'];
    echo do_shortcode($shortcode);
}
if (!empty($atts['class'])) :
    echo '</div>';
endif;
?>
