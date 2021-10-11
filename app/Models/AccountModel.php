<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
	protected $table      = 'accounts';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';

	protected $allowedFields = [
		'email',
		'username',
		'password',
		'first_name',
		'last_name',
		'birth_date',
		'gender',
		'profile_picture',
		'is_admin'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	protected $useSoftDeletes = false;
	// protected $deletedField  = 'deleted_at';

	// protected $validationRules    = [];
	// protected $validationMessages = [];
	// protected $skipValidation     = false;

	public function accountInsert($data)
	{
		$session = \Config\Services::session();

		$error_message = '';

		$captcha = '';

		if (isset($data['g-recaptcha-response'])) {
			$captcha = $data['g-recaptcha-response'];
		}

		if (!empty($captcha)) {
			$response = (array) json_decode(file_get_contents(
				'https://www.google.com/recaptcha/api/siteverify?secret=' . RECAPTCHA_SECRET .
					'&response=' . $captcha .
					'&remoteip=' . $_SERVER['REMOTE_ADDR']
			));

			if ($response['success'] === true) {
				try {
					$this->insert([
						'email' => $data['email'],
						'username' => $data['username'],
						'password' => password_hash($data['password'], PASSWORD_DEFAULT),
						'first_name' => $data['first_name'],
						'last_name' => $data['last_name'],
						'birth_date' => $data['birth_date'],
						'gender' => $data['gender'],
						//'profile_picture' => $data[''],
						'is_admin' => false
					]);

					$session->set('is_logged_in', true);

					$session->set('email', $data['email']);
					$session->set('username', $data['username']);
					$session->set('first_name', $data['first_name']);
					$session->set('last_name', $data['last_name']);
					$session->set('birth_date', $data['birth_date']);
					$session->set('gender', $data['gender']);
					$session->set('profile_picture', $data['profile_picture']);
				} catch (\Exception $e) {
					$error_message = 'Gagal mendaftar. Silakan coba beberapa saat lagi';

					if ($e->getCode() == '1062') {
						$error_message = 'Email atau username telah digunakan';
					}
				}
			} else {
				$error_message = 'Verifikasi RECAPTCHA gagal';
			}
		} else {
			$error_message = 'Silakan isi verifikasi RECAPTCHA';
		}

		$session->setFlashData('register_error_msg', $error_message);

		return $error_message;
	}

	public function isEmailExist($email)
	{
		if ($this->where('email', $email)->first())
			return true;
		return false;
	}

	public function isUsernameExist($username)
	{
		if ($this->where('username', $username)->first())
			return true;
		return false;
	}

	public function accountGet($data)
	{
		$session = \Config\Services::session();

		$error_message = '';

		$captcha = '';

		if (isset($data['g-recaptcha-response'])) {
			$captcha = $data['g-recaptcha-response'];
		}

		if (!empty($captcha)) {
			$response = (array) json_decode(file_get_contents(
				'https://www.google.com/recaptcha/api/siteverify?secret=' . RECAPTCHA_SECRET .
					'&response=' . $captcha .
					'&remoteip=' . $_SERVER['REMOTE_ADDR']
			));

			if ($response['success'] === true) {
				try {
					$accData = $this
						->where('email', $data['email_username'])
						->orWhere('username', $data['email_username'])
						->first();
					if (!$accData || !password_verify($data['password'], $accData['password'])) {
						$error_message = 'Email/username atau password salah';
					} else {
						$session->set('is_logged_in', true);

						$session->set('email', $accData['email']);
						$session->set('username', $accData['username']);
						$session->set('first_name', $accData['first_name']);
						$session->set('last_name', $accData['last_name']);
						$session->set('birth_date', $accData['birth_date']);
						$session->set('gender', $accData['gender']);

						if ($accData['is_admin'])
							$session->set('is_admin', true);
					}
				} catch (\Exception $e) {
					$error_message = 'Gagal masuk. Silakan coba beberapa saat lagi';
				}
			} else {
				$error_message = 'Verifikasi RECAPTCHA gagal';
			}
		} else {
			$error_message = 'Silakan isi verifikasi RECAPTCHA';
		}

		$session->setFlashData('login_error_msg', $error_message);

		return $error_message;
	}
}
