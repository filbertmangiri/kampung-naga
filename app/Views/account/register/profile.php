<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer">
<style>
	body {
		background-color: #efefef;
	}

	.profile-pic {
		max-width: 222px;
		max-height: 222px;
		margin-left: auto;
		margin-right: auto;
		display: block;
	}

	.file-upload {
		display: none;
	}

	.circle {
		border-radius: 50%;
		overflow: hidden;
		width: 228px;
		height: 228px;
		border: 8px solid rgba(255, 255, 255, 0.7);
		position: sticky;
		top: 72px;
		transition: all .3s;
	}

	.circle:hover {
		background-color: #909090;
		cursor: pointer
	}

	img {
		max-width: 100%;
		height: auto;
		min-width: 212px;
		min-height: 212px
	}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
	<div class="row">
		<div class="col">
			<div class="form-group mb-5">
				<div class="circle upload-button" style="margin: auto;">
					<img class="profile-pic" src="images/profiles/default.png">
				</div>
				<input class="file-upload" type="file">
			</div>

			<div class="d-grid">
				<button type="button" class="btn btn-primary" id="registerSubmit">LEWATI</button>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('modals'); ?>
<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload & Crop Image</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-8 text-center">
						<div id="image_demo" style="width:350px; margin-top:30px"></div>
					</div>
					<div class="col-md-4" style="padding-top:30px;">
						<br><br><br>
						<button class="btn btn-success crop_image">Crop & Upload Image</button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".upload-button").on('click', function() {
			$(".file-upload").click();
		});

		$image_crop = $('#image_demo').croppie({
			enableExif: true,
			viewport: {
				width: 200,
				height: 200,
				type: 'square' //circle
			},
			boundary: {
				width: 300,
				height: 300
			}
		});

		$('.file-upload').on('change', function() {
			let reader = new FileReader();
			reader.onload = function(event) {
				$image_crop.croppie('bind', {
					url: event.target.result
				}).then(function() {
					console.log('jQuery bind complete');
				});
			}
			reader.readAsDataURL(this.files[0]);
			$('#uploadimageModal').modal('show');
		});

		$('.crop_image').click(function(event) {
			$image_crop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function(response) {
				$.ajax({
					url: "<?= base_url('register/submit') ?>",
					type: "post",
					data: {
						"image": response
					},
					success: function(data) {
						$('#uploadimageModal').modal('hide');
					}
				});
			})
		});
	});
</script>
<?= $this->endSection(); ?>