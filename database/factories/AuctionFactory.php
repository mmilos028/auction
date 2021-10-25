<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Auction;
use App\Category;
use App\Shippment;
use App\PaymentMethod;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Auction::class, function (Faker $faker) {

    $category = Category::getCategory(Category::pluck('id')->random());

    $action_title = $faker->words(rand(5, 15), true);

    $action_seo_url = \Illuminate\Support\Str::slug($action_title);

    $action_seo_url_path = implode('-', [$category->seo_url_path, \Illuminate\Support\Str::slug($action_title)]);

    $auction_type_status = $faker->biasedNumberBetween(1, 2);

    $auction_repeat_status = $faker->numberBetween(0, 1);
    if($auction_repeat_status == 1){
        $number_to_repeat = $faker->numberBetween(0, 5);
    }else{
        $number_to_repeat = null;
    }

    $item_status_id = $faker->numberBetween(1, 4);

    if($auction_type_status == 1){
        //fixed price auction
        return [
            'title' => $action_title,
            'auction_type_status' => $auction_type_status,

            'start_price' => $faker->randomFloat(2, 10, 100000),
            'buy_now_status' => null,
            'buy_now_price' => null,
            'start_auction_at' => now()->addDays(1, 365),
            'auction_duration_days' => $faker->numberBetween(1, 15),
            'auction_repeat' => $auction_repeat_status,
            'number_to_repeat' => $number_to_repeat,
            'auction_shipping_from_id' => 0,
            'auction_payment_method_id' => 0,
            'category_id' => Category::pluck('id')->random(),
            'description' => $faker->text,
            'item_status_id' => $item_status_id,
            'user_id' => User::pluck('id')->first(),
            'seo_url' => $action_seo_url,
            'seo_url_path' => $action_seo_url_path
        ];
    }else{
        //competetive auction

        $buy_now_status = $faker->biasedNumberBetween(0, 1);
        if($buy_now_status == 0){
            $buy_now_price = null;
        }else{
            $buy_now_price = $faker->randomFloat(2, 10, 100000);
        }

        return [
            'title' => $action_title,
            'auction_type_status' => $auction_type_status,

            'start_price' => $faker->randomFloat(2, 10, 100000),
            'buy_now_status' => $buy_now_status,
            'buy_now_price' => $buy_now_price,
            'start_auction_at' => now()->addDays(1, 365),
            'auction_duration_days' => $faker->numberBetween(1, 15),
            'auction_repeat' => $auction_repeat_status,
            'number_to_repeat' => $number_to_repeat,
            'auction_shipping_from_id' => 0,
            'auction_payment_method_id' => 0,
            'category_id' => Category::pluck('id')->random(),
            'description' => $faker->text,
            'item_status_id' => $item_status_id,
            'user_id' => User::pluck('id')->first(),
            'seo_url' => $action_seo_url,
            'seo_url_path' => $action_seo_url_path
        ];
    }


});
