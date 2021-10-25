<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuctionsAddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('auctions', function(Blueprint $table){

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        //
        Schema::table('auctions', function(Blueprint $table){
            try {
                $table->dropIfExists('category_id');
            }catch(Exception $ex){

            }

            try {
                $table->dropIfExists('user_id');
            }catch(Exception $ex){

            }
        });

       // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::dropIfExists('auctions');
        // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Schema::enableForeignKeyConstraints();
    }
}
