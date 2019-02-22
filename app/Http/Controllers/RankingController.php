<?php

namespace App\Http\Controllers;

use App\Model\Character\Character;
use App\Model\Character\Guild;
use Illuminate\Http\Response;

class RankingController extends Controller
{
    /**
     * Show ranking of all players.
     *
     * @return Response
     */
    public function player()
    {
        $characters = Character::getForRanking()->paginate(20);

        return view('ranking.player', [
            'characters' => $characters,
        ]);
    }

    /**
     * Show ranking for all guilds.
     *
     * @return Response
     */
    public function guild()
    {
        $guilds = Guild::getForRanking()->paginate(20);

        return view('ranking.guild', [
            'guilds' => $guilds,
        ]);
    }
}
