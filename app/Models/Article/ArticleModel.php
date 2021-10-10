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
		'author_id',
		'thumbnail',
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
}
