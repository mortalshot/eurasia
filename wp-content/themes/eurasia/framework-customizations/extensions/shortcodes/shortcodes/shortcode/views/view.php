<?php if (!defined('FW')) {
    die('Forbidden');
}

/**
 * @var array $atts
 */
?>

<?php
$shortcode = '';
if (!empty($atts['shortcode'])) {
    $shortcode .= $atts['shortcode'];
    echo do_shortcode($shortcode);
}
?>
