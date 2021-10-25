<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippments', function (Blueprint $table) {
            $table->id();

                $table->string('name')->nullable(false)->unique('unique_shippment_name');
                $table->text('description');
                $table->integer('sort_order')->nullable(true)->default(0);
                $table->string('url')->nullable(true);

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
        Schema::dropIfExists('shippments');
    }
}
