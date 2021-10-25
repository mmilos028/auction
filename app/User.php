<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'origin_password',
        'first_name', 'last_name', 'address', 'address_number',
        'country', 'municipality', 'mobile_phone',
        'terms_and_conditions_status', 'newsletter_status',
        'account_status', 'account_status_date_changed', 'account_status_user_id_changed',
        'last_activity_at',
        'user_public_status', 'favourite_quote', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'origin_password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    public function auctions() : HasMany
    {
        return $this->hasMany(Auction::class, 'user_id', 'id');
    }

    public static function getUserDetails($user_id)
    {
        //User::query()->find($user_id);
        return User::where('id', $user_id)
            ->select(
                "users.*"
            )
            ->get()
            ->first();
    }

}
