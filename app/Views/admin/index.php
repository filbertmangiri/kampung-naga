<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
	<div class="row">
		<div class="col">
			<button class="btn btn-primary mb-5" onclick="window.location.href = '<?= base_url('admin/insert'); ?>'">Tambah Artikel</button>
			<table id="articlesTable" class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<!-- <th>Thumbnail</th> -->
						<th>Judul</th>
						<th>Kategori</th>
						<th>Penulis</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($articles as $key) : ?>
						<tr>
							<td><?= $key['id']; ?></td>
							<td><?= $key['title']; ?></td>
							<td><?= $key['category']; ?></td>
							<td><?= $key['author']; ?></td>
							<td>
								<a href="<?= base_url('admin/edit/' . $key['title_slug']); ?>"><i class="fas fa-edit"></i></a>
								<a href="<?= base_url('admin/delete/' . $key['title_slug']); ?>"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#articlesTable').DataTable();
	});
</script>
<?= $this->endSection(); ?>