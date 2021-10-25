<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryToAuctions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_to_auctions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('auction_id')->unsigned();

            $table->foreign('auction_id')
                ->references('id')->on('auctions')
                ->onDelete('cascade');

            $table->bigInteger('category_id')->unsigned();

            $table->foreign('category_id')
                ->references('id')->on('categories')
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
        //Schema::dropIfExists('category_to_auction');
        Schema::disableForeignKeyConstraints();
        //
        Schema::table('category_to_auctions', function(Blueprint $table){
            try {
                $table->dropIfExists('category_id');
            }catch(Exception $ex){

            }

            try {
                $table->dropIfExists('auction_id');
            }catch(Exception $ex){

            }
        });

        // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('category_to_auctions');
        // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Schema::enableForeignKeyConstraints();
    }
}
