<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Article\CategoryModel;
use App\Models\Article\ArticleModel;

class Admin extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session();

		if ($session->get('is_admin') !== true) {
			return redirect()->to(base_url());
		}

		$data = [
			'title' => 'Admin',
			'articles' => (new ArticleModel())->articleGet()
		];

		return view('admin/index', $data);
	}

	public function insert()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$error_message = (new ArticleModel())->articleInsert($this->request->getVar());

			if (empty($error_message)) {
				return redirect()->to(base_url('admin'));
			}

			return redirect()->to(base_url('admin/insert'));
		}

		$data = [
			'title' => 'Admin | Insert',
			'categories' => (new CategoryModel())->categoryGetAll()
		];

		return view('admin/insert', $data);
	}

	public function edit($titleSlug = '')
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$error_message = (new ArticleModel())->articleEdit($this->request->getVar());

			if (empty($error_message)) {
				return redirect()->to(base_url('admin'));
			}

			return redirect()->to(base_url('admin/insert'));
		}

		if (empty($titleSlug)) {
			return redirect()->to(base_url());
		}

		$data = [
			'title' => 'Admin | Edit'
		];

		return view('admin/edit', $data);
	}

	public function delete($titleSlug = '')
	{
		if (empty($titleSlug)) {
			return redirect()->to(base_url());
		}
	}
}
