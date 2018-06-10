<?php

namespace App\Http\Controllers;

use App\Model\Character\Character;
use App\Model\Character\Guild;

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

	/**
	 * Show ranking for all guilds.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function guild()
	{
		$guilds = Guild::getForRanking()->paginate(20);

		return view('ranking.guild', compact('guilds'));
	}
}
