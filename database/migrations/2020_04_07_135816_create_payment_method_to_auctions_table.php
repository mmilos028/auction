<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_to_auctions', function (Blueprint $table) {
            $table->id();

                $table->bigInteger('auction_id')->unsigned();

                $table->foreign('auction_id')
                ->references('id')->on('auctions')
                ->onDelete('cascade');

                $table->bigInteger('payment_method_id')->unsigned();

                $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('payment_method_to_auctions', function(Blueprint $table){
            $table->dropIfExists('auction_id');

            $table->dropIfExists('payment_method_id');
        });
        Schema::dropIfExists('payment_method_to_auctions');
        Schema::enableForeignKeyConstraints();
    }
}
