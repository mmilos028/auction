<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ShippmentMethodSeeder::class,
            PaymentMethodSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,

            AuctionBiddingSeeder::class
        ]);

    }
}
