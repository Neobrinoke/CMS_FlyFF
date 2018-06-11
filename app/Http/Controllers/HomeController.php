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
		$articles = Article::all()->take(3);

		return view('home', compact('articles'));
	}
}
