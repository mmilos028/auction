<?php

use App\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('payment_methods')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->createPaymentMethods();
    }

    public function createPaymentMethods()
    {
        PaymentMethod::create([
            'name' => "Cash",
            'description' => "Cash",
            'sort_order' => 999
        ]);

        PaymentMethod::create([
            'name' => "Plaćanje pre slanja",
            'description' => "Plaćanje pre slanja",
            'sort_order' => 998
        ]);

        PaymentMethod::create([
            'name' => "Plaćanje posle slanja",
            'description' => "Plaćanje posle slanja",
            'sort_order' => 997
        ]);

        PaymentMethod::create([
            'name' => "Plaćanje pouzećem",
            'description' => "Plaćanje pouzećem",
            'sort_order' => 996
        ]);

        PaymentMethod::create([
            'name' => "Lično",
            'description' => "Lično",
            'sort_order' => 995
        ]);
    }
}
