<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;

class HomeController extends AdminController
{
    /**
     * Show the home page.
     *
     * @return Response
     */
    public function home()
    {
        return view('admin.home.index');
    }
}
