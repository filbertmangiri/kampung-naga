<?= $this->extend('layout/template'); ?>

<?php $session = \Config\Services::session(); ?>

<?= $this->section('styles'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" rel="stylesheet" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer"> -->

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
		<div class="col-12 col-sm-11 col-md-8 col-lg-6 mx-auto">
			<form id="registerForm" action="<?= base_url('register/submit'); ?>" method="post">
				<?= csrf_field(); ?>

				<?php if (!empty($session->getFlashData('register_error_msg'))) : ?>
					<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
						<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
						</symbol>
					</svg>

					<div class="alert alert-danger alert-dismissible" role="alert">
						<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
							<use xlink:href="#exclamation-triangle-fill">
						</svg>

						<?= $session->getFlashData('register_error_msg'); ?>

						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<div class="form-group mb-5">
					<div class="circle upload-button" style="margin: auto;">
						<img class="profile-pic" src="">
					</div>

					<input class="file-upload" type="file" accept="image/*">
				</div>

				<div class="row mb-3">
					<div class="col-12 col-sm-6 mb-2">
						<div class="form-floating">
							<input type="text" class="form-control" id="firstName" placeholder="First Name" name="first_name" value="<?= isset($form['first_name']) ? $form['first_name'] : ''; ?>" autofocus>
							<label for="firstName">First Name</label>
						</div>
					</div>
					<div class="col-12 col-sm-6 mb-2">
						<div class="form-floating">
							<input type="text" class="form-control" id="lastName" placeholder="Last Name" name="last_name" value="<?= isset($form['last_name']) ? $form['last_name'] : ''; ?>">
							<label for="lastName">Last Name</label>
						</div>
					</div>
				</div>

				<div class="form-floating mb-2">
					<input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?= isset($form['email']) ? $form['email'] : ''; ?>">
					<label for="email">Email</label>
				</div>

				<div class="form-floating mb-2">
					<input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= isset($form['username']) ? $form['username'] : ''; ?>">
					<label for="username">Username</label>
				</div>

				<div class="row mb-3">
					<div class="col-12 col-sm-6 mb-2">
						<div class="form-floating">
							<input type="password" class="form-control" id="password" placeholder="Password" name="password">
							<label for="password">Password</label>
						</div>
					</div>
					<div class="col-12 col-sm-6 mb-2">
						<div class="form-floating">
							<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" name="confirm_password">
							<label for="confirmPassword">Confirm Password</label>
						</div>
					</div>
				</div>

				<div class="form-floating mb-3">
					<input type="date" class="form-control" id="birthDate" placeholder="Birth Date" name="birth_date" value="<?= isset($form['birth_date']) ? $form['birth_date'] : ''; ?>">
					<label for="birthDate">Birth Date</label>
				</div>

				<div class="form-group mb-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="gender" id="genderMale" value="0" <?= (!isset($form['gender']) || $form['gender'] == 0) ? 'checked' : '' ?>>
						<label class="form-check-label" for="genderMale">Laki-laki</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="gender" id="genderFemale" value="1" <?= (isset($form['gender']) && $form['gender'] != 0) ? 'checked' : ''; ?>>
						<label class="form-check-label" for="genderFemale">Perempuan</label>
					</div>
				</div>

				<div class="form-group mb-3">
					<div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE; ?>" data-callback="recaptchaCallback">
					</div>
					<input type="hidden" class="hiddenRecaptcha required" name="hidden_recaptcha" id="hiddenRecaptcha">
				</div>

				<div class="d-grid">
					<button type="submit" class="btn btn-primary" id="registerSubmit">DAFTAR</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
jQuery Validation
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" integrity="sha256-TAzGN4WNZQPLqSYvi+dXQMKehTYFoVOnveRqbi42frA=" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>

<script type="text/javascript">
	function recaptchaCallback() {
		$('#hiddenRecaptcha').valid();
	};

	$(document).ready(function() {
		let readURL = function(input) {
			if (input.files && input.files[0]) {
				let reader = new FileReader();

				reader.onload = function(e) {
					$('.profile-pic').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		};


		$(".file-upload").on('change', function() {
			readURL(this);
		});

		$(".upload-button").on('click', function() {
			$(".file-upload").click();
		});

		$.validator.addMethod('lettersOnly', function(value, element) {
			return this.optional(element) || /^[A-Za-z áãâäàéêëèíîïìóõôöòúûüùçñ]+$/i.test(value);
		}, 'Hanya boleh huruf dan spasi');

		$.validator.addMethod('emailEx', function(value, element) {
			return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
		}, 'Email tidak valid');

		$.validator.addMethod('noSpaceSymbol', function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9_]+$/i.test(value);
		}, 'Tidak boleh spasi dan simbol selain underscore');

		$.validator.addMethod('lessThanToday', function(value, element) {
			return new Date(value) < new Date();
		}, 'Tanggal lahir tidak valid');

		$.validator.addMethod('fileTypeImage', function(value, element) {
			return this.optional(element) || (element.files[0].size <= param * 1048576);
		}, 'Tipe file harus berupa gambar (.jpg/.png)');
	});

	$('#registerForm').validate({
		ignore: '.ignore',

		rules: {
			first_name: {
				required: true,
				lettersOnly: true,
				minlength: 2
			},
			last_name: {
				required: true,
				lettersOnly: true,
				minlength: 2
			},
			email: {
				required: true,
				emailEx: true,
				remote: {
					url: '<?= base_url('register/emailcheck'); ?>',
					type: 'post'
				}
			},
			username: {
				required: true,
				noSpaceSymbol: true,
				minlength: 5,
				maxlength: 36,
				remote: {
					url: '<?= base_url('register/usernamecheck'); ?>',
					type: 'post'
				}
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: '#password'
			},
			birth_date: {
				required: true,
				dateISO: true,
				lessThanToday: true
			},
			image: {
				fileTypeImage: true,
				extension: 'jpg,jpeg,png',
				filesize: 10
			},
			gender: {
				required: true,
			},
			hidden_recaptcha: {
				required: function() {
					return grecaptcha.getResponse() == '';
				}
			}
		},

		messages: {
			first_name: {
				required: 'Masukkan nama pertama',
				lettersOnly: 'Hanya boleh huruf dan spasi',
				minlength: 'Nama pertama minimal {0} karakter'
			},
			last_name: {
				required: 'Masukkan nama terakhir',
				lettersOnly: 'Hanya boleh huruf dan spasi',
				minlength: 'Nama pertama minimal {0} karakter'
			},
			email: {
				required: 'Masukkan Email',
				emailEx: 'Format email tidak valid',
				remote: 'Email telah digunakan'
			},
			username: {
				required: 'Masukkan username',
				noSpaceSymbol: 'Hanya boleh huruf, angka, dan garis bawah (_)',
				minlength: 'Minimal huruf/angka username 5 karakter dan maksimal 32 karakter',
				maxlength: 'Username sudah melebihi batas maksimal',
				remote: 'Username sudah digunakan'
			},
			password: {
				required: 'Masukkan kata sandi',
				minlength: 'Minimal huruf/angka kata sandi 5 karakter'
			},
			confirm_password: {
				required: 'Masukkan konfirmasi kata sandi',
				minlength: 'Minimal huruf/angka kata sandi 5 karakter',
				equalTo: 'Kata sandi tidak sesuai'
			},
			birth_date: {
				required: 'Masukkan tanggal lahir',
				dateISO: 'Format tanggal tidak valid',
				lessThanToday: 'Tanggal lahir tidak valid'
			},
			image: {
				extension: 'File yang diterima adalah jpg, jpeg, dan png',
				filesize: ''
			},
			gender: {
				required: 'Masukkan jenis kelamin',
			}
		},

		errorElement: 'em',
		errorPlacement: function(error, element) {
			error.addClass('invalid-feedback');

			if (element.prop('type') === 'radio') {
				error.insertAfter(element.next('label'));
			} else {
				error.insertAfter(element);
			}
		},
		highlight: function(element, errorClass, validClass) {
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).addClass('is-valid').removeClass('is-invalid');
		},
		submitHandler: function(form) {
			if ($("#registerForm").valid()) {
				form.submit();
			}
		}
	});
</script>
<?= $this->endSection(); ?>