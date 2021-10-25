<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique('unique_category_name');
            $table->text('description');
            $table->string('image');
            $table->smallInteger('status')->unsigned();
            $table->integer('sort_order')->nullable(true)->default(0);

            $table->string('seo_url')->unique('unique_category_seo_url');
            $table->string('seo_url_path')->unique('unique_category_seo_url_path');


            $table->bigInteger('parent_id')->unsigned()->nullable(true);

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
            ;


            $table->integer('top')->unsigned()->default(1);

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
        Schema::table('categories', function(Blueprint $table){
            $table->dropIfExists('parent_id');
        });
        Schema::dropIfExists('categories');
    }
}
