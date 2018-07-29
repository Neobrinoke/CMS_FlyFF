<?php

namespace App\Http\Controllers;

use App\Helper\Md5Helper;
use App\Model\Account\Account;
use App\Model\Account\AccountDetail;
use App\Model\Web\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        if (!Hash::check($request->input('password'), $user->password)) {
            session()->flash('error', trans('trans/settings.general.edit.messages.password_error'));
            return redirect()->back();
        }

        $validatedRules = [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:website.users,email,{$user->id}",
            'profile_img' => 'image|max:10000'
        ];

        if ($request->input('new_password')) {
            $validatedRules['new_password'] = 'required|string|min:6|confirmed';
        }

        $validatedData = $request->validate($validatedRules);

        if ($request->file('profile_img')) {
            $validatedData['avatar_url'] = '/uploads/' . $request->file('profile_img')->store('user/avatars', [
                'disk' => 'public'
            ]);
        }

        if ($request->input('new_password')) {
            $validatedData['password'] = Hash::make($validatedData['new_password']);
            unset($validatedData['new_password']);
        }

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
            'account' => 'required|string|alpha_num|min:4|max:32|unique:account.ACCOUNT_TBL,account|unique:account.ACCOUNT_TBL_DETAIL,account',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $validatedData['password'] = Md5Helper::md5Hash($validatedData['password']);

        Account::query()->create([
            'account' => $validatedData['account'],
            'password' => $validatedData['password'],
            'isuse' => 'T',
            'member' => 'A',
            'id_no2' => $validatedData['password'],
            'realname' => '',
            'user_id' => $user->id
        ]);

        AccountDetail::query()->create([
            'account' => $validatedData['account'],
            'gamecode' => 'A000',
            'tester' => '2',
            'm_chLoginAuthority' => 'F',
            'regdate' => Carbon::now(),
            'BlockTime' => '0',
            'EndTime' => '0',
            'WebTime' => '0',
            'isuse' => 'O',
            'email' => ''
        ]);

        session()->flash('success', trans('trans/settings.game.account.create.messages.success', ['account' => $validatedData['account']]));

        return redirect()->route('settings.game.account.index');
    }

    /**
     * Show game account edit view.
     *
     * @param Account $account
     * @return Response
     */
    public function gameAccountEdit(Account $account)
    {
        if (!$account->is_mine || $account->is_banned) {
            abort(404);
        }

        return view('settings.game.account.edit', [
            'account' => $account
        ]);
    }

    /**
     * Update given account.
     *
     * @param Request $request
     * @param Account $account
     * @return Response
     */
    public function gameAccountUpdate(Request $request, Account $account)
    {
        if (!$account->is_mine || $account->is_banned) {
            abort(404);
        }

        if (Md5Helper::md5Hash($request->input('password')) !== $account->password) {
            session()->flash('error', trans('trans/settings.game.account.edit.messages.password_error'));
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        $account->fill([
            'password' => Md5Helper::md5Hash($validatedData['new_password'])
        ])->save();

        session()->flash('success', trans('trans/settings.game.account.edit.messages.success', ['account' => $account->account]));

        return redirect()->route('settings.game.account.index');
    }
}
