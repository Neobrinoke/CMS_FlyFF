<?php

namespace App\Http\Controllers;

use App\Model\Character\Guild;
use Illuminate\Http\Response;

class GuildController extends Controller
{
    /**
     * Show detail of this guild.
     *
     * @param Guild $guild
     * @return Response
     */
    public function show(Guild $guild)
    {
        return view('guild.show', [
            'guild' => $guild
        ]);
    }
}
