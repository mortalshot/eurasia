<?php if (!defined('FW')) die('Forbidden'); ?>
<?php if ($data['slides']) : ?>
	<div class="home-slider">
		<?php foreach ($data['slides'] as $slide) : ?>
			<div class="slider-item">
				<?php if ($slide['extra']['link']) : ?>
					<a href="<?php echo $slide['extra']['link'] ?>" class="item-link">
					<?php endif; ?>
					<div class="slider-item__bg" style="background-image: url('<?php echo $slide['src']; ?>');">
						<div class="item-wrapper">
							<div class="slider-item__title"><?php echo $slide['title']; ?></div>
							<div class="slider-item__description"><?php echo $slide['desc']; ?></div>
							<div class="slider-item__note"><?php echo $slide['extra']['note']; ?></div>
						</div>
					</div>
					<?php if ($slide['extra']['link']) : ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>