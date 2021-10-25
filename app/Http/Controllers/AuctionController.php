<?php

namespace App\Http\Controllers;

use App\Auction;
use App\AuctionBidding;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
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
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /*public function welcome()
    {
        $categories = Category::getTopLevelCategories();

        return view('welcome', [
            'categories' => $categories
        ]);
    }*/

    public function details($auction_id)
    {

        /**
         * @var $auction \App\Auction
         */
        $auction = Auction::getAuctionDetails($auction_id);

        //dd($auction->actualBiddingPrice());

        //dd($auction);

        $path = [];

        if(!isset($category_id))
        {
            $path = [];
        }else {

            $path = Category::getPath($auction->category_id);
        }

        $current_category = Category::getCategory($auction->category_id);

        //$categories = (new Category())->getTopLevelCategoriesWithAuctionsCount();

        //$sub_categories = Category::getSubcategories($category_id);
        $sub_categories = (new Category())->getSubcategoriesWithAuctionsCount($auction->category_id);

        //dd($path);

        $total_auction_biddings = $auction->countBiddings();

        $auction_remaining_time = new \Carbon\Carbon($auction->start_auction_at);
        $auction_remaining_time->addDays($auction->auction_duration_days);


        //$auction_remaining_time_for_humans = $auction_remaining_time->diffForHumans($auction->start_auction_at);
        $auction_remaining_time_in_days = (new \Carbon\Carbon($auction_remaining_time))->diffInDays( new \Carbon\Carbon());
        $auction_remaining_time_in_hours = (new \Carbon\Carbon($auction_remaining_time))->addDays($auction_remaining_time_in_days * (-1) )->diffInHours( (new \Carbon\Carbon()));
        $auction_remaining_time_in_minutes = (new \Carbon\Carbon($auction_remaining_time))
            ->addDays($auction_remaining_time_in_days * (-1))
            ->addHours( $auction_remaining_time_in_hours * (-1) )
            ->diffInMinutes(new \Carbon\Carbon())
            ;

        return view('auction.details', [
            'path' => $path,
            'auction' => $auction,
            //'current_category' => $current_category,
            //'categories' => $categories,
            //'sub_categories' => $sub_categories,
            "auction_remaining_time_in_days" => $auction_remaining_time_in_days,
            "auction_remaining_time_in_hours" => $auction_remaining_time_in_hours,
            "auction_remaining_time_in_minutes" => $auction_remaining_time_in_minutes,
            "auction_remaining_time_formatted" => $auction_remaining_time->format('d-M-Y H:i:s'),

            "total_auction_biddings" => $total_auction_biddings,
        ]);
    }

    public function biddings($auction_id){
        /**
         * @var $auction \App\Auction
         */
        $auction = Auction::getAuctionDetails($auction_id);

        $biddings = Auction::getAuctionBiddings($auction_id);

        //dd($biddings);


        $auction_remaining_time = new \Carbon\Carbon($auction->start_auction_at);
        $auction_remaining_time->addDays($auction->auction_duration_days);


        //$auction_remaining_time_for_humans = $auction_remaining_time->diffForHumans($auction->start_auction_at);
        $auction_remaining_time_in_days = (new \Carbon\Carbon($auction_remaining_time))->diffInDays( new \Carbon\Carbon());
        $auction_remaining_time_in_hours = (new \Carbon\Carbon($auction_remaining_time))->diffInHours( (new \Carbon\Carbon())->addDays($auction_remaining_time_in_days * (-1) ));
        $auction_remaining_time_in_minutes = (new \Carbon\Carbon($auction_remaining_time))->diffInHours(
            (
            new \Carbon\Carbon())->addDays($auction_remaining_time_in_days * (-1))->addHours( $auction_remaining_time_in_hours * (-1) )
        );

        return view('auction.biddings', [

            'auction' => $auction,

            'biddings' => $biddings,

            "auction_remaining_time_in_days" => $auction_remaining_time_in_days,
            "auction_remaining_time_in_hours" => $auction_remaining_time_in_hours,
            "auction_remaining_time_in_minutes" => $auction_remaining_time_in_minutes,
            "auction_remaining_time_formatted" => $auction_remaining_time->format('d-M-Y H:i:s'),
        ]);
    }

    public function bid(Request $request){
        $bid_offer = $request['textMyOffer'];
        $auction_id = $request['textAuctionId'];
        $user_id = Auth::id();

        $auctionBidding = new AuctionBidding();
        $auctionBidding->auction_id = $auction_id;
        $auctionBidding->user_id = $user_id;
        $auctionBidding->actual_price = $bid_offer;
        $auctionBidding->save();

        return redirect()->route('auction_details', ['auction_id' => $auction_id]);
    }
}
