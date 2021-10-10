<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Article\ArticleModel;

class Article extends BaseController
{
	protected $articleModel;

	public function __construct()
	{
		$this->articleModel = new ArticleModel();
	}

	public function __destruct()
	{
		unset($this->articleModel);
	}

	public function index()
	{
		$data = [
			'title' => 'Beranda',
			'articles' => $this->articleModel->articleGet()
		];

		return view('articles/index', $data);
	}

	public function detail($titleSlug)
	{
		$data['detail'] = $this->articleModel->articleGet($titleSlug);
		$data['title'] = $data['detail']['title'];

		return view('articles/detail', $data);
	}
}
