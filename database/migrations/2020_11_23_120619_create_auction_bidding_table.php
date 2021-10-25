<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionBiddingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_biddings', function (Blueprint $table) {
            $table->id();
                $table->bigInteger('user_id')->nullable(false)->unsigned()
                    ->comment('Veza ka users tabeli, koji korisnik biduje aukciju');

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                ;

                $table->bigInteger('auction_id')->nullable(false)->unsigned()
                    ->comment('Veza ka auction tabeli, koja aucija se biduje');

                $table->foreign('auction_id')
                    ->references('id')
                    ->on('auctions')
                ;

                $table->decimal('actual_price', 15, 4)
                    ->nullable(false)
                    ->comment('Cena koju stavlja korisnik user_id na aukciju auction_id');


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
        Schema::dropIfExists('auction_biddings');
    }
}
