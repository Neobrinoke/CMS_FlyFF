<?php

namespace App\Http\Controllers;

use App\Model\Web\Article;

class ArticleController extends Controller
{
	/**
	 * Show all articles.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$controller = 'article';
		$articles = Article::query()->paginate(5);

		return view('article.index', compact('articles', 'controller'));
	}
}
