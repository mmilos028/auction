<?php

use Illuminate\Database\Seeder;

class AuctionBiddingSeeder extends Seeder
{

    /**
     * @var Faker\Generator
     */
    private $faker = null;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = $this->returnFaker();

        $this->createAuctionBidding();

    }

    /**
     * @return \Faker\Generator
     */
    public function returnFaker(){
        $faker = Faker\Factory::create();

        return $faker;
    }

    public function createAuctionBidding()
    {

        for($i = 0; $i<rand(10000, 100000); $i++) {
            $faker = $this->returnFaker();

            $auctionBidding = new App\AuctionBidding();
            $auctionBidding->auction_id = App\Auction::pluck('id')->random();
            $auctionBidding->user_id = App\User::pluck('id')->random();
            $auctionBidding->actual_price = $faker->randomFloat(2, 10, 100000);
            $auctionBidding->save();
        }

    }
}
