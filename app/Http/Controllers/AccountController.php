<?php

namespace App\Http\Controllers;

use App\Model\Web\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Show general information view.
     *
     * @return Response
     */
    public function general()
    {
        return view('account.general');
    }

    /**
     * Show edit information view.
     *
     * @return Response
     */
    public function edit()
    {
        return view('account.edit');
    }

    public function update(Request $request)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'password' => 'required|string|min:6|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::query()->find($userId);
        $user->fill($validatedData);
        $user->save();

        session()->flash('success', trans('trans/account.edit.success_message'));

        return redirect()->route('account.general');
    }
}
