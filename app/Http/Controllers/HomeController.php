<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
	/**
	 * Show the home page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function home()
	{
		return view('home');
	}
}
