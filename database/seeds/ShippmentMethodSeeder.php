<?php

use App\Shippment;
use Illuminate\Database\Seeder;

class ShippmentMethodSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('shippments')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->createShippmentMethods();
    }

    public function createShippmentMethods()
    {
        Shippment::create(
            [
                'name' => "AKS",
                'description' => "AKS",
                'url' => 'http://www.aks.rs/cenovnik/',
                'sort_order' => 999
            ]

        );
        Shippment::create(
            [
                'name' => "BEX",
                'description' => "BEX",
                'url' => 'http://bex.rs/kalkulatorcena.php',
                'sort_order' => 998
            ]
        );
        Shippment::create(
            [
                'name' => "City Express",
                'description' => "City Express",
                'url' => 'https://www.cityexpress.rs/cenovnik-domaci-transport/',
                'sort_order' => 997
            ]
        );
        Shippment::create(
            [
                'name' => "Pošta",
                'description' => "Pošta",
                'sort_order' => 996
            ]
        );
        Shippment::create(
            [
                'name' => "Post Express",
                'description' => "Post Express",
                'sort_order' => 995
            ]
        );
        Shippment::create(
            [
                'name' => "Daily Express",
                'description' => "Daily Express",
                'url' => 'http://www.dexpress.rs/rs/cenovnik/',
                'sort_order' => 994
            ]
        );
        Shippment::create(
            [
                'name' => "Lično preuzimanje",
                'description' => "Lično preuzimanje",
                'sort_order' => 993
            ]
        );
        Shippment::create(
            [
                'name' => "Ogranizovani transport",
                'description' => "Organizovani transport",
                'sort_order' => 992
            ]
        );
    }
}
