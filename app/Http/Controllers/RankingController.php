<?php

namespace App\Http\Controllers;

use App\Model\Character\Character;
use Illuminate\Http\Request;

class RankingController extends Controller
{
	/**
	 * Show ranking of all players.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function player()
	{
		$characters = Character::getForRanking()->paginate(20);

    	return view('ranking.player', compact('characters'));
	}
}
