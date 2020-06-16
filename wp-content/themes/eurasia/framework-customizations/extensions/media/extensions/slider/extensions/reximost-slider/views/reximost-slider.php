<?php if (!defined('FW')) die('Forbidden');

$slider_class = 'slider__wrap';
$slider_container = 'col-md-12';
$uid = uniqid('slider_id_');
?>

<?php if (isset($data['slides'])) : ?>
    <div id="<?php echo esc_attr($uid); ?>" class="<?php echo esc_attr($slider_class); ?>">
        <div class="slider__wrap__slides">
            <?php foreach ($data['slides'] as $slide) : ?>

                <?php
                $slider_attr = '';
                $image = '';
                if ($slide['src']) {
                    $image = 'data-image="' . $slide["src"] . '"';
                }

                if (!empty($image)) {
                    $slider_attr .= $image;
                }
                ?>

                <div class="slider__wrap__slide bg-image" <?php echo esc_html($slider_attr); ?>>
                    <div class="container">
                        <div class="row">
                            <div class="<?php echo esc_attr($slider_container) ?>">
                                <div class="slide-wrapper">
                                    <h1 class="heading-title"><?php echo $slide['title'] ?></h1>
                                    <h2 class="heading-description"><?php echo $slide['desc'] ?></h2>
                                    <?php if (!empty($slide['extra']['link'])  && !empty($slide['extra']['link_title'])) : ?>
                                        <a class="btn btn-primary btn-lg" href="<?php echo $slide['extra']['link'] ?>"><?php echo $slide['extra']['link_title'] ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            /*-------------------------------------
            Full screen slider - Slick
            -------------------------------------*/
            jQuery('#<?php echo esc_attr($uid); ?> > .slider__wrap__slides').slick({
                dots: false,
                fade: true,
                autoplay: true,
                autoplaySpeed: 3000,
                autoHeight: false,
                adaptiveHeight: true,
                touch: false,
                cssEase: 'linear',
                prevArrow: jQuery('#prev-next-<?php echo esc_attr($uid); ?> > .prev'),
                nextArrow: jQuery('#prev-next-<?php echo esc_attr($uid); ?> > .next')
            });
        });
    </script>
<?php endif; ?>