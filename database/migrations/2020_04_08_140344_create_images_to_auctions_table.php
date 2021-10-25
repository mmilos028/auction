<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesToAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images_to_auctions', function (Blueprint $table) {
            $table->id();

                $table->bigInteger('auction_id')->unsigned();

                $table->foreign('auction_id')
                ->references('id')
                ->on('auctions')
                ->onDelete('cascade');

                $table->string('image');
                $table->smallInteger('image_status')
                    ->default(1)
                    ->comment("Image status: 1 is ORIGINAL 2 is THUMBNAIL");
                $table->smallInteger('is_main_image')
                    ->default(2)
                    ->comment('Main image: 1 - Yes, 2 - No');
                $table->integer('sort_order')->default(1);

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
        Schema::table('images_to_auctions', function(Blueprint $table){
            //$table->dropForeign('auction_id');
            $table->dropIfExists('auction_id');
        });

        Schema::dropIfExists('images_to_auctions');
    }
}
