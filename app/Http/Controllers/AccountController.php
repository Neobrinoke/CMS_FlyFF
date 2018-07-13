<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class AccountController extends Controller
{
    /**
     * @return Response
     */
    public function general()
    {
        return view('account.general');
    }
}
