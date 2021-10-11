<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
	<div class="row" data-aos="fade-up">
		<div class="col-12 col-sm-11 col-md-8 col-lg-6">
			<?php foreach ($articles as $key) : ?>
				<article class="mb-5">
					<a href="?= base_url('article/' . $key['title_slug']); ?>">
						<img src="?= base_url('images/thumbnails/' . $key['thumbnail']); ?>" alt="?= $key['title_slug']; ?>" width="100%">
					</a>
					<a href="<?= base_url('article/' . $key['title_slug']); ?>">
						<h2><?= $key['title']; ?></h2>
					</a>
					<a href="<?= base_url('article/category/' . $key['category_slug']); ?>">
						<h5>Kategori : <?= $key['category']; ?></h5>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	AOS.init();
</script>
<?= $this->endSection(); ?>