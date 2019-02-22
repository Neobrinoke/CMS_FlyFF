<?php

namespace App\Http\Controllers;

use App\Model\Web\User;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:website.users',
            'password' => 'required|string|min:6|confirmed',
            'rules' => 'accepted',
            'profile_img' => 'image|max:10000',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data): Model
    {
        $values = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        if (isset($data['profile_img'])) {
            /** @var UploadedFile $image */
            $image = $data['profile_img'];

            $values['avatar_url'] = '/uploads/' . $image->store('user/avatars', [
                'disk' => 'public',
            ]);
        } else {
            $values['avatar_url'] = '/images/default_avatar.png';
        }

        return User::query()->create($values);
    }
}
