<?php

namespace App\Http\Controllers;

use App\User;
use App\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function details($user_id)
    {

        /**
         * @var $user \App\User
         */
        $user = User::getUserDetails($user_id);

        //dd($user);

        return view('user.details', [
            'user' => $user
        ]);
    }

    /**
     * List user auctions
     * @param $user_id
     * @param $page
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listAuctionsFromUser($user_id = null, $page = 1)
    {

        if(!isset($user_id))
        {
            $auctions = [];
        }else {

            $auctions = Auction::getAuctionsFromUser($user_id, $page);
        }

        $user = User::getUserDetails($user_id);

        //dd($auctions);

        return view('user.list-auctions-from-user', [
            'user_id' => $user_id,
            'user' => $user,
            'auctions' => $auctions
        ]);
    }
}
