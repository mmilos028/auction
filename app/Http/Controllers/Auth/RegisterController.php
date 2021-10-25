<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' =>  ['required', 'string', 'max:255'],
            'address_number' =>  ['required', 'int'],
            'country' => ['required', 'string', 'max:255'],
            'municipality' =>  ['required', 'string', 'max:255'],
            'mobile_phone' =>  ['required', 'string', 'max:255'],
            'terms_and_conditions_status' =>  ['required', 'int'],
            'newsletter_status' => ['required', 'int']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'origin_password' => $data['password'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'address_number' => $data['address_number'],
            'country' => $data['country'],
            'municipality' => $data['municipality'],
            'mobile_phone' => $data['mobile_phone'],
            'terms_and_conditions_status' => $data['terms_and_conditions_status'],
            'newsletter_status' => $data['newsletter_status']
        ]);
    }
}
