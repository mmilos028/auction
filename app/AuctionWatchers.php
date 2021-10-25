<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionWatchers extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id', 'id');
    }

}