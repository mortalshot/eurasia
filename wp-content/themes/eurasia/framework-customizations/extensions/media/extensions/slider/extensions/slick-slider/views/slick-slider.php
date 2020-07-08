<?php if (!defined('FW')) die('Forbidden'); ?>
<?php if ($data['slides']) : ?>
	<div class="home-slider">
		<?php foreach ($data['slides'] as $slide) : ?>
			<div class="slider-item">
				<?php if ($slide['extra']['link']) : ?>
					<a href="<?php echo $slide['extra']['link'] ?>" class="item-link">
					<?php endif; ?>
					<div class="slider-item__bg" style="background-image: url('<?php echo $slide['src'] ?>');">
						<?php if ($slide['title'] || $slide['desc'] || $slide['note']) : ?>
							<div class="item-wrapper">
							<?php endif; ?>
							<?php if ($slide['title']) : ?>
								<div class="slider-item__title"><?php echo $slide['title']; ?></div>
							<?php endif; ?>
							<?php if ($slide['desc']) : ?>
								<div class="slider-item__description"><?php echo $slide['desc']; ?></div>
							<?php endif; ?>
							<?php if ($slide['extra']['note']) : ?>
								<div class="slider-item__note"><?php echo $slide['extra']['note']; ?></div>
							<?php endif; ?>
							<?php if ($slide['title'] || $slide['desc'] || $slide['note']) : ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ($slide['extra']['link']) : ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>