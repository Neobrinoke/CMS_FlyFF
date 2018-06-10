<?php

namespace App\Http\Controllers;

use App\Model\Web\Article;

class HomeController extends Controller
{
	/**
	 * Show the home page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function home()
	{
		$controller = 'home';
		$articles = Article::all()->take(6);

		return view('article.index', compact('articles', 'controller'));
	}
}
