<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php foreach ($articles as $key) :
	if ($key['id'] % 2 != 0) {
		echo "<div class=container style=border: radius 2px;><div class=row>";
	} ?>
	<div class="column" style="float:left;width:50%;height:50%;">
		<article class='mb-5' data-aos='fade-up'>
			<a href="<?= base_url('article/' . $key['title_slug']); ?>">
				<img src="<?= base_url('images/thumbnails/' . $key['thumbnail']); ?>" alt="<?= $key['title_slug']; ?>" style="margin-left:auto; margin-right:auto;" class="rounded img-fluid">
			</a>
			<a href="<?= base_url('article/' . $key['title_slug']); ?>" style="text-decoration:none;">
				<h2 class="text-success"><?= $key['title']; ?></h2>
			</a>
			<a href="<?= base_url('article/category/' . $key['category_slug']); ?>" style="text-decoration:none;">
				<h5 class="text-info">Kategori : <?= $key['category']; ?></h5>
			</a>
		</article>
	</div>
	<?php
	if ($key['id'] % 2 == 0) {
		echo "</div></div>";
	} ?>
<?php endforeach; ?>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	AOS.init({
		disable: false,
		disableMutationObserver: false, // disables automatic mutations' detections (advanced)
		debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
		throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)

		// Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
		offset: 400, // offset (in px) from the original trigger point
		delay: 400, // values from 0 to 3000, with step 50ms
		duration: 300, // values from 0 to 3000, with step 50ms
		easing: 'ease-in-sine', // default easing for AOS animations
		once: false, // whether animation should happen only once - while scrolling down
		mirror: true, // whether elements should animate out while scrolling past them
		anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
	});
</script>
<?= $this->endSection(); ?>