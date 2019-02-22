<?php

namespace App\Http\Controllers;

use App\Model\Web\Article;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return Response
     */
    public function home()
    {
        $articles = Article::all()->take(3);

        return view('home.index', [
            'articles' => $articles,
        ]);
    }
}
