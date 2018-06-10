<?php

namespace App\Http\Controllers;

use App\Model\Character\Character;
use App\Model\Character\Guild;

class GuildController extends Controller
{
	/**
	 * Show detail of this guild.
	 *
	 * @param Guild $guild
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(Guild $guild)
	{
		return view('guild.show', compact('guild'));
	}
}
