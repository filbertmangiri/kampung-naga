<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-11 col-md-8 col-lg-6">
			<article class="mb-5">
				<h2><?= $detail['title']; ?></h2>

				<a href="<?= base_url('article/category/' . $detail['category_slug']); ?>" class="mb-3">
					<h5>Kategori : <?= $detail['category']; ?></h5>
				</a>

				<img src="<?= base_url('images/thumbnails/' . $detail['thumbnail']); ?>" alt="<?= $detail['title_slug']; ?>" width="100%">

				<!-- <p class="mt-3"> -->
				<?= $detail['content']; ?>
				<!-- </p> -->
			</article>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>