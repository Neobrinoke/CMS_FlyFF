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
		$articles = Article::query()->paginate(5);

		return view('article.index', compact('articles'));
	}

	/**
	 * Show detail of article.
	 *
	 * @param Article $article
	 * @param string $slug
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(Article $article, string $slug)
	{
		return view('article.show', compact('article'));
	}
}
