<?php

namespace App\Http\Controllers\ProtectedRoutes;

use App\Auction;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List user auctions
     * @param $page
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myAuctions($page = 1)
    {

        $user = auth()->user();

        if(!isset($user->id))
        {
            $auctions = [];
        }else {

            $auctions = Auction::getAuctionsFromUser($user->id, $page);
        }

        return view('protected.profile.selling.my-auctions', [
            //'categories' => $categories
            'user' => $user,
            'auctions' => $auctions
        ]);
    }
}

