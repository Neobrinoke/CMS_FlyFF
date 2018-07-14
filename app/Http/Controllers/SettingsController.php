<?php

namespace App\Http\Controllers;

use App\Model\Account\Account;
use App\Model\Account\AccountDetail;
use App\Model\Web\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Show general information view.
     *
     * @return Response
     */
    public function generalIndex()
    {
        return view('settings.general.index');
    }

    /**
     * Show edit information view.
     *
     * @return Response
     */
    public function generalEdit()
    {
        return view('settings.general.edit');
    }

    /**
     * Update user information.
     *
     * @param Request $request
     * @return Response
     */
    public function generalUpdate(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:website.users,email,' . $user->id,
            'password' => 'required|string|min:6|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user->fill($validatedData);
        $user->save();

        session()->flash('success', trans('trans/settings.general.edit.messages.success'));

        return redirect()->route('settings.general.index');
    }

    /**
     * Show game accounts information view.
     *
     * @return Response
     */
    public function gameAccountIndex()
    {
        return view('settings.game.account.index');
    }

    /**
     * Show game account create view.
     *
     * @return Response
     */
    public function gameAccountCreate()
    {
        return view('settings.game.account.create');
    }

    /**
     * Store new game account.
     *
     * @param Request $request
     * @return Response
     */
    public function gameAccountStore(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $validatedData = $request->validate([
            'login' => 'required|string|min:4|max:32|unique:account.ACCOUNT_TBL,account|unique:account.ACCOUNT_TBL_DETAIL,account|regex:/(^[a-z0-9 ]+$)+/',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $validatedData['password'] = md5(env('MD5_HASH_KEY') . $validatedData['password']);

        Account::query()->create([
            'account' => $validatedData['login'],
            'password' => $validatedData['password'],
            'isuse' => 'T',
            'member' => 'A',
            'id_no2' => $validatedData['password'],
            'realname' => '',
            'user_id' => $user->id
        ]);

        AccountDetail::query()->create([
            'account' => $validatedData['login'],
            'gamecode' => 'A000',
            'tester' => '2',
            'm_chLoginAuthority' => 'F',
            'regdate' => Carbon::now(), // TODO: trouver une solution pour les date SQL SERVER
            'BlockTime' => '0',
            'EndTime' => '0',
            'WebTime' => '0',
            'isuse' => 'O',
            'email' => ''
        ]);

        session()->flash('success', trans('trans/settings.game.account.create.messages.success', ['login' => $validatedData['login']]));

        return redirect()->route('settings.game.account.index');
    }
}
