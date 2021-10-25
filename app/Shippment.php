<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shippment extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'sort_order', 'url'
    ];

    public function auctions()
    {
        return $this->belongsToMany(Auction::class, 'shippment_to_auctions');
    }
}
