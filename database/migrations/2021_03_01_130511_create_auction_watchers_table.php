<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionWatchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('auction_watchers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('auction_id')->nullable(false)->unsigned()
                ->comment('Veza ka auction tabeli, koja aucija se biduje');
            $table->foreign('auction_id')
                ->references('id')
                ->on('auctions')
            ;
            $table->string('ip_address')->unique();

            $table->bigInteger('user_id')->nullable()->unsigned()
                ->comment('Veza ka users tabeli, koji korisnik biduje aukciju');

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
        //
        Schema::dropIfExists('auction_watchers');
    }
}
