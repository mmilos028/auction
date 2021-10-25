<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagesToAuction extends Model
{

    public const IMAGE_STATUS_REALSIZE = 1;
    public const IMAGE_STATUS_THUMBNAIL = 2;

    public const IS_MAIN_IMAGE = 1;
    public const IS_NOT_MAIN_IMAGE = 2;
    //
    protected $fillable = [
        'auction_id', 'image', 'sort_order'
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auction_id');
    }
}
