<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippmentToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippment_to_auctions', function (Blueprint $table) {
            $table->id();


                $table->bigInteger('auction_id')->unsigned();

                $table->foreign('auction_id')
                    ->references('id')->on('auctions')
                    ->onDelete('cascade');

                $table->bigInteger('shippment_id')->unsigned();
                $table->foreign('shippment_id')
                    ->references('id')->on('shippments')
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
        Schema::table('shippment_to_auctions', function(Blueprint $table){
            $table->dropIfExists('auction_id');

            $table->dropIfExists('shippment_id');
        });

        Schema::dropIfExists('shippment_to_auctions');
        Schema::enableForeignKeyConstraints();
    }
}
