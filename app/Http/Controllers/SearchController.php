<?php

namespace App\Http\Controllers;

use App\Category;
use App\Auction;
use Illuminate\Http\Request;

class SearchController extends Controller
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

    /**
     * Show the application dashboard.
     * @param $term
     * @param $page
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchAuctions($term = '', $page = 1)
    {

        $term = request()->term;

        $perPage = 200;

        $auctions = Auction::searchAuctions($term, $page, $perPage)->paginate($perPage);


        return view('search.search-auctions', [
            'term' => $term,
            'auctions' => $auctions
        ]);
    }

}