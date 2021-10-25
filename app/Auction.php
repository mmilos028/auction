<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;

class Auction extends Model
{
    protected $fillable = [
        'title',
        'auction_type_status',
        'start_price',
        'buy_now_status',
        'buy_now_price',
        'start_auction_at',
        'auction_duration_days',
        'auction_repeat',
        'number_to_repeat',
        'auction_shipping_from_id',
        'auction_payment_method_id',
        'category_id',
        'description',
        'item_status_id',
        'user_id'
    ];


    public function shippments()
    {
        return $this->belongsToMany(Shippment::class, 'shippment_to_auctions')->distinct()->orderBy('sort_order', 'asc');
    }

    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'payment_method_to_auctions')->distinct()->orderBy('sort_order', 'asc');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_to_auctions')->orderBy('sort_order', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function imagesToAuction()
    {
        return $this->hasMany(ImagesToAuction::class, 'auction_id', 'id')->orderBy('sort_order', 'asc');
    }

    public function watchers(){
        return $this->hasMany(AuctionWatchers::class, 'auction_id', 'id')->orderBy('created_at', 'desc');
    }

    public function countAllWatchers() {
        return $this->watchers()
            ->distinct()
            ->count('*');
    }
    public function countLastWatchers(){
        return $this->watchers()
            ->distinct()
            ->limit(50)
            ->count('*');
    }

    public function biddings() {
        return $this->hasMany(AuctionBidding::class, 'auction_id', 'id')
            ->orderBy('actual_price', 'desc');
    }

    public function actualBiddingPrice() {
        return $this->hasMany(AuctionBidding::class, 'auction_id', 'id')
            //->max('actual_price')
            ->orderBy('actual_price', 'desc')
            ->first()
            ;
    }

    public function countBiddings(){
        return $this->hasMany(AuctionBidding::class, 'auction_id', 'id')
            ->count()
            ;
    }

    public function countBiddingsFromAuction($auction_id){
        return $this->hasMany(AuctionBidding::class, 'auction_id', 'id')
            ->where('auction_id', '=', $auction_id)
            ->count()
            ;
    }

    public function thumbnailImagesToAuction(){
        return $this->hasMany(ImagesToAuction::class, 'auction_id')
            //->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL)
            ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
            ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_NOT_MAIN_IMAGE)
            ->orderBy('sort_order', 'asc');
    }

    public function mainThumbnailImagesToAuction(){
        return $this->hasMany(ImagesToAuction::class, 'auction_id')
            //->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL)
            ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
            ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE)
            ->orderBy('sort_order', 'asc');
    }

    public function realsizeImagesToAuction(){
        return $this->hasMany(ImagesToAuction::class, 'auction_id')
            ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
            ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_NOT_MAIN_IMAGE)
            ->orderBy('sort_order', 'asc');
    }

    public function mainRealsizeImagesToAuction(){
        return $this->hasMany(ImagesToAuction::class, 'auction_id')
            ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
            ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE)
            ->orderBy('sort_order', 'asc');
    }

    public static function getAuctionsForCategory($auction_id)
    {
        return Auction::with('category')
            //->count('auction.id')
            ->where('auction.id', '=', $auction_id)
            ->orderBy('id', 'desc')
            ;
    }

    public static function getAuctionDetails($auction_id)
    {
        //return Auction::with(['user', 'thumbnailImagesToAuction', 'mainThumbnailImagesToAuction', 'realsizeImagesToAuction', 'mainRealsizeImagesToAuction'])
        return Auction::with(['user', 'thumbnailImagesToAuction', 'mainRealsizeImagesToAuction', 'paymentMethods', 'shippments'])
            ->leftJoin('images_to_auctions', 'auctions.id', '=', 'images_to_auctions.auction_id')
            //->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL)
            ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
            ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE)
            ->where('auctions.id', '=', $auction_id)
            ->select(
                "auctions.*",
                "auctions.description as description",
                "images_to_auctions.image",
                "auctions.id as id",
                "auctions.category_id as category_id"
            )
            ->get()
            ->first()
            ;
    }


    public static function getLastAuctions()
    {
        return Auction::with('user')
        ->leftJoin('images_to_auctions', 'auctions.id', '=', 'images_to_auctions.auction_id')
        //->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL)
        ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
        ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE)
        ->select(
            "auctions.*",
            "auctions.id as auction_id",
            "auctions.description as description",
            "images_to_auctions.image"
            //"categories.id as category_id"
        )
        ->orderBy('auctions.id', 'desc')
        ->take(10)
            ->get();
    }


    public static function getAuctionsFromCategory($category_id, $page = 1, $perPage = 20)
    {
        return Auction::with('user')
            ->leftJoin('images_to_auctions', 'auctions.id', '=', 'images_to_auctions.auction_id')
            ->leftJoin('category_to_auctions', 'auctions.id', '=', 'category_to_auctions.auction_id')
            ->leftJoin('categories', 'category_to_auctions.category_id', '=', 'categories.id')
            ->where('category_to_auctions.category_id', '=', $category_id)
            //->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL)
            ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
            ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE)
            ->select(
                "*",
                "auctions.id as auction_id",
                "auctions.id as id",
                "auctions.description as description",
                "images_to_auctions.image"
            )

            ->orderBy('auctions.id', 'desc')
            ->skip($page * $perPage)
            ->take($perPage)
            ;
    }

    public static function getAuctionsFromUser($user_id, $page = 1, $perPage = 20)
    {

        return Auction::with('user')
            ->leftJoin('images_to_auctions', 'auctions.id', '=', 'images_to_auctions.auction_id')
            ->leftJoin('category_to_auctions', 'auctions.id', '=', 'category_to_auctions.auction_id')
            ->leftJoin('categories', 'category_to_auctions.category_id', '=', 'categories.id')
            //->where('users.id', '=', $user_id)
            //->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL)
            ->where('auctions.user_id', '=', $user_id)
            ->where('images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE)
            ->where('images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE)
            ->select(
                "*",
                "auctions.id as auction_id",
                "auctions.id as id",
                "auctions.description as description",
                "images_to_auctions.image"
            )

            ->orderBy('auctions.id', 'desc')
            ->skip($page * $perPage - $perPage)
            ->take($page * $perPage)
            ->get()
            ;

    }

    public static function searchAuctions($term, $page = 1, $perPage = 20){
        return Auction
            //::query()
            ::with('user')
            //->leftJoin('images_to_auctions', 'auctions.id', '=', 'images_to_auctions.auction_id')
                ->join('images_to_auctions', function($join) use ($term) {
                    $join->on('auctions.id', '=', 'images_to_auctions.auction_id')
                    ->where(
                        //'images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL
                        'images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_REALSIZE
                    )
                    ->where(
                        'images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE
                    )
                    ;
                }
            )

            ->where('auctions.title', 'like', '%' . $term . '%')
            ->orWhere('auctions.description', 'like', '%' . $term . '%')

            /*
            ->where(
                'images_to_auctions.image_status', '=', ImagesToAuction::IMAGE_STATUS_THUMBNAIL
            )
            ->where(
                'images_to_auctions.is_main_image', '=', ImagesToAuction::IS_MAIN_IMAGE
            )
            */

            ->select(
                "*",
                "auctions.id as auction_id",
                "auctions.description as description",
                "images_to_auctions.image"
            )
            ->distinct('auctions.id')


            ->orderBy('auctions.id', 'desc')
            ->skip($page * $perPage)
            ->take($perPage)
            ;
    }

    public static function getAuctionBiddings($auction_id){
        return Auction
            ::with('user')
            ->leftJoin("auction_biddings", "auctions.id", "=", "auction_biddings.auction_id")
            ->select()
            //->orderBy("auction_biddings.actual_price", "desc")
            ->orderBy("auction_biddings.id", "desc")
            ->take(200)
            ->get()
            ;
    }

    public function getThumbnailImage($image_name){
        $filesystemObj = new Filesystem();
        $path = $filesystemObj->dirname($image_name);
        $filename = $filesystemObj->name($image_name);
        $extension = $filesystemObj->extension($image_name);

        return $path . DIRECTORY_SEPARATOR . $filename . "_150x60" . "." . $extension;
    }

    public function getRealImage($image_name) {
        $filesystemObj = new Filesystem();
        $path = $filesystemObj->dirname($image_name);
        $filename = $filesystemObj->name($image_name);
        $extension = $filesystemObj->extension($image_name);

        return $path . DIRECTORY_SEPARATOR . $filename . "_800x600" . "." . $extension;
    }

    public function getRemainingTime(){
        $auction_remaining_time = new \Carbon\Carbon($this->start_auction_at);
        $auction_remaining_time->addDays($this->auction_duration_days);


        //$auction_remaining_time_for_humans = $auction_remaining_time->diffForHumans($this->start_auction_at);
        $auction_remaining_time_in_days = (new \Carbon\Carbon($auction_remaining_time))->diffInDays( new \Carbon\Carbon());
        $auction_remaining_time_in_hours = (new \Carbon\Carbon($auction_remaining_time))->diffInHours( (new \Carbon\Carbon())->addDays($auction_remaining_time_in_days * (-1) ));
        $auction_remaining_time_in_minutes = (new \Carbon\Carbon($auction_remaining_time))->diffInHours(
            (
            new \Carbon\Carbon())->addDays($auction_remaining_time_in_days * (-1))->addHours( $auction_remaining_time_in_hours * (-1) )
        );

        return [
            "auction_remaining_time_in_days" => $auction_remaining_time_in_days,
            "auction_remaining_time_in_hours" => $auction_remaining_time_in_hours,
            "auction_remaining_time_in_minutes" => $auction_remaining_time_in_minutes
        ];
    }

    public function isAuctionCompleted() {
        $auction_remaining_time = new \Carbon\Carbon($this->start_auction_at);
        $auction_remaining_time->addDays($this->auction_duration_days);

        $is_auction_completed = ((new \Carbon\Carbon($auction_remaining_time))->lte(new \Carbon\Carbon())) ? true : false;

        return $is_auction_completed;
    }

}
