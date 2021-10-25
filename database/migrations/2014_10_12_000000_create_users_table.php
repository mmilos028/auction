<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('origin_password');
            $table->rememberToken();

            $table->string('first_name')->nullable(false)->default('');
            $table->string('last_name')->nullable(false)->default('');
            $table->string('address')->nullable(false)->default('');
            $table->string('address_number')->nullable(false)->default('');
            $table->string('country')->nullable(false)->default('');
            $table->string('municipality')->nullable(false)->default('');
            $table->string('mobile_phone')->nullable(false)->default('');
            $table->smallInteger('terms_and_conditions_status')->default(0);
            $table->smallInteger('newsletter_status')->default(0);

            $table->smallInteger('account_status')->default(0);
            $table->timestamp('account_status_date_changed')->nullable(true);
            $table->bigInteger('account_status_user_id_changed')->nullable(true);
            $table->timestamp('last_activity_at')->nullable();

            $table->string('user_public_status')->nullable(true)->default('');
            $table->string('favourite_quote')->nullable(true)->default('');
            $table->text('description')->nullable(true)->default('');


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
        Schema::dropIfExists('users');
    }
}
