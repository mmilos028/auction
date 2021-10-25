<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();

                $table->string('title');

                $table->smallInteger('auction_type_status')->nullable(false)->default(1)
                    ->comment('Aution type, 1 - fixed price, 2 - auction');

                $table->decimal('start_price', 15, 4)
                    ->nullable(true)
                    ->default(0)
                    ->comment('Početna cena aukcije')
                ;
                $table->decimal('buy_now_price', 15, 4)
                    ->nullable(true)
                    ->default(0)
                    ->comment('Cena za pobedu na aukciji')
                ;
                $table->bigInteger('buy_now_status')->nullable(true)->default(0)
                ->comment('Da li je omogucena pobeda ako se licitira za cenu za pobedu na aukciji');

                $table->timestamp('start_auction_at')
                ->comment('Datum i vreme kada startuje aukcija');

                $table->bigInteger('auction_duration_days')->nullable(false)->default(1)
                ->comment('Broj dana koliko ce trajati aukcija' );

                $table->smallInteger('auction_repeat')->nullable(false)->default(0)
                ->comment('Status da li ce aukcija biti ponovljena ako nije bilo licitiranih pobednika, 0 - Nece biti ponovljena 1 - bice ponovljena');

                $table->integer('number_to_repeat')->nullable(true)->default(0)
                ->comment('Ako se aukcija ponavlja, odredjuje se broj ponavljanja aukcija - 1 ili vise ponavljanja');

                $table->bigInteger('auction_shipping_from_id')->nullable(true)->unsigned()
                ->comment('Veza od tabele auctions ka tabeli shippment_to_auctions ka shippments tabeli');

                $table->bigInteger('auction_payment_method_id')->nullable(true)->unsigned()
                ->comment('Veza od tabele auctions ka tabeli payment_method_to_auctions ka payment_methods tabeli');


                $table->bigInteger('category_id')->unsigned()
                ->comment('Veza ka tabeli categories, gde je vezana aukcija za neku kategoriju stavke koja se stavlja');

                $table->text('description')->comment('Description')
                ->comment('Opis stavke na aukciji');

                $table->smallInteger('item_status_id')->default(1)
                    ->comment('Status of Item on Auction, 1 - Nekorisceno, 2 - Polovno, 3 - Neispravno, 4 - Kolekcionarski primerak');

                $table->smallInteger('auction_status')->default(1)
                    ->comment('Status of Auction, 1 - Aktivna, 2 - Pauza, 3 - Neaktivna, 4 - Zavrsena');

                $table->bigInteger('user_id')->nullable(false)->unsigned()
                ->comment('Veza ka users tabeli, koji korisnik stavlja aukciju');

                $table->string('seo_url')->unique('unique_auction_seo_url')
                ->comment('URL stavke za promenu URL rute stavke aukcije');
                $table->string('seo_url_path')->unique('unique_auction_seo_url_path')
                ->comment('Path stavke za promenu Path rute stavke aukcije');

            $table->timestamps();
        });

        $prefix = DB::getTablePrefix();
        $randStartId = random_int(1, 1000000);
        DB::update("ALTER TABLE " . $prefix . "auctions AUTO_INCREMENT = $randStartId;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auctions');
    }
}
