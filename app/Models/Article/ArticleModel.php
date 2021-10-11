<?php

namespace App\Models\Article;

use CodeIgniter\Model;

class ArticleModel extends Model
{
	protected $table      = 'articles';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';

	protected $allowedFields = [
		'title',
		'title_slug',
		'category',
		'category_slug',
		// 'thumbnail',
		'author',
		'content'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	protected $useSoftDeletes = false;
	// protected $deletedField  = 'deleted_at';

	// protected $validationRules    = [];
	// protected $validationMessages = [];
	// protected $skipValidation     = false;

	public function articleGet($titleSlug = '')
	{
		if (empty($titleSlug)) {
			return $this->findAll();
		}

		return $this->where('title_slug', $titleSlug)->first();
	}

	public function articleInsert($data)
	{
		$error_message = '';

		try {
			$this->insert([
				'title' => $data['title'],
				'title_slug' => url_title($data['title'], '-', true),
				'category' => $data['category'],
				'category_slug' => url_title($data['category'], '-', true),
				'author' => $data['author'],
				'content' => $data['content'],
			]);
		} catch (\Exception $e) {
			$error_message = 'Gagal membuat artikel. Silakan coba beberapa saat lagi';

			if ($e->getCode() == '1062') {
				$error_message = 'Judul artikel telah digunakan';
			}
		}

		\Config\Services::session()->setFlashData('article_insert_error_msg', $error_message);

		return $error_message;
	}

	public function articleEdit($data)
	{
		$error_message = '';

		try {
			$this->insert([
				'title' => $data['title'],
				'title_slug' => url_title($data['title'], '-', true),
				'category' => $data['category'],
				'category_slug' => url_title($data['category'], '-', true),
				'author' => $data['author'],
				'content' => $data['content'],
			]);
		} catch (\Exception $e) {
			$error_message = 'Gagal membuat artikel. Silakan coba beberapa saat lagi';

			if ($e->getCode() == '1062') {
				$error_message = 'Judul artikel telah digunakan';
			}
		}

		\Config\Services::session()->setFlashData('article_insert_error_msg', $error_message);

		return $error_message;
	}
}
