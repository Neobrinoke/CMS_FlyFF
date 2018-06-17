<?php

namespace App\Http\Controllers;

use App\Model\Web\Article;
use App\Model\Web\ArticleCategory;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
	/**
	 * Show all articles.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::query()->paginate(5);

		return view('article.index', [
			'articles' => $articles
		]);
	}

	/**
	 * Show detail of article.
	 *
	 * @param Article $article
	 * @param string $slug
	 * @return Response
	 */
	public function show(Article $article, string $slug)
	{
		if ($slug !== $article->slug) {
			return redirect()->route('article.show', [$article->id, $article->slug]);
		}

		return view('article.show', [
			'article' => $article
		]);
	}

	public function categoryShow(ArticleCategory $category, string $slug)
	{
		if ($slug !== $category->slug) {
			return redirect()->route('article.category.show', [$category, $category->slug]);
		}

		return view('article.index', [
			'articles' => $category->articles()->paginate(5)
		]);
	}
}
