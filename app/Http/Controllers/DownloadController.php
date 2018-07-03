<?php

namespace App\Http\Controllers;

use App\Model\Web\Download;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clients = Download::clients();
        $patchers = Download::patchers();

        return view('download.index', [
            'clients' => $clients,
            'patchers' => $patchers
        ]);
    }
}
