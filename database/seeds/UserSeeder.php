<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserSeeder extends Seeder
{

    /**
     * @var Faker\Generator
     */
    private $faker = null;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->faker = $this->returnFaker();

        $this->createUsers();

    }

    /**
     * @return \Faker\Generator
     */
    public function returnFaker(){
        $faker = Faker\Factory::create();

        return $faker;
    }

    public function createUsers()
    {


        User::create(
            [
                'name' => "mmilos028",
                'email' => "mmilos028@localhost.com",
                'email_verified_at' => now(),
                'password' => Hash::make("mmilos028"),
                'origin_password' => 'mmilos028',
                'remember_token' => Str::random(10),
                'first_name' => 'Miloš',
                'last_name' => 'Milošević',
                'address' => 'Ljubiše Miodragovića 28',
                'address_number' => '21',
                'country' => 'Srbija',
                'municipality' => 'Zvezdara',
                'mobile_phone' => '381 064 942 80 70',
                'terms_and_conditions_status' => 1,
                'newsletter_status' => 1,
                'account_status' => 1,
                'account_status_date_changed' => null,
                'account_status_user_id_changed' => null,
                'last_activity_at' => now(),
            ]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('auctions')->delete();
        DB::table('category_to_auctions')->delete();
        DB::table('shippment_to_auctions')->delete();
        DB::table('payment_method_to_auctions')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(App\User::class, 10)->create()->
        each( function(App\User $u, $key) {

            factory(App\Auction::class, rand(5, 15))->create([ 'user_id' => $u->id])
            ->each(function (App\Auction $auction) {
                //
                //dd($auction);

                $auction_id = $auction->id;


                $categoryToAuction = new App\CategoryToAuction();
                $categoryToAuction->auction_id = $auction_id;
                $categoryToAuction->category_id = $auction->category_id;
                $categoryToAuction->save();


                //$imageToAuction = new App\ImagesToAuction();
                //$imageToAuction->auction_id = $auction_id;
                //$imageToAuction->image = "";
                //$imageToAuction->image_status = 1;
                //$imageToAuction->is_main_image = 1;
                //$imageToAuction->save();



                $imgname = "originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg";

                $sampleimgdir = "image\catalog\sample\auction\\1\\";
                $filenamewithextension = public_path("{$sampleimgdir}{$imgname}");
                $filesystemObj = new Filesystem();
                $filename = $filesystemObj->name($filenamewithextension);
                $extension = $filesystemObj->extension($filenamewithextension);
                $copyimgdir = "image/catalog/auction/$auction_id/";
                if(!$filesystemObj->exists(public_path($copyimgdir))) {
                    $filesystemObj->makeDirectory(public_path($copyimgdir));
                }
                //kopiraj original sliku
                $filenamewithextension1 = public_path("{$copyimgdir}{$imgname}");
                $filesystemObj->copy($filenamewithextension, $filenamewithextension1);
                //save img to database
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = "{$copyimgdir}{$imgname}";
                $imageToAuction->image_status = App\ImagesToAuction::IMAGE_STATUS_REALSIZE;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_MAIN_IMAGE;
                $imageToAuction->save();



                //CREATE THUMBNAIL
                $filenametostore = public_path($copyimgdir . $filename . "_150x60" . "." . $extension);
                //kopiraj smanjenu sliku
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                //save img to database
                /*
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = $copyimgdir . $filename . "_150x60" . "." . $extension;
                $imageToAuction->image_status =  App\ImagesToAuction::IMAGE_STATUS_THUMBNAIL;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_MAIN_IMAGE;
                $imageToAuction->save();
                */
                $img = Image::make($filenametostore);
                $img->resize(150, 60, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save();

                //CREATE SHOW IMAGE
                $filenametostore = public_path($copyimgdir . $filename . "_800x600" . "." . $extension);
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                $img = Image::make($filenametostore);
                $img->resize(800, 600, function($constraint){
                   $constraint->aspectRatio();
                });





                $imgname = "originalslika_Mona-braon-kaput-odlicno-stanje-258048229.jpg";

                $sampleimgdir = "image\catalog\sample\auction\\1\\";
                $filenamewithextension = public_path("{$sampleimgdir}{$imgname}");
                $filesystemObj = new Filesystem();
                $filename = $filesystemObj->name($filenamewithextension);
                $extension = $filesystemObj->extension($filenamewithextension);
                $copyimgdir = "image/catalog/auction/$auction_id/";
                if(!$filesystemObj->exists(public_path($copyimgdir))) {
                    $filesystemObj->makeDirectory(public_path($copyimgdir));
                }
                //kopiraj original sliku
                $filenamewithextension1 = public_path("{$copyimgdir}{$imgname}");
                $filesystemObj->copy($filenamewithextension, $filenamewithextension1);
                //save img to database
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = "{$copyimgdir}{$imgname}";
                $imageToAuction->image_status =  App\ImagesToAuction::IMAGE_STATUS_REALSIZE;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_NOT_MAIN_IMAGE;
                $imageToAuction->image_status = 1;
                $imageToAuction->is_main_image = 2;
                $imageToAuction->save();

                //CREATE THUMBNAIL
                $filenametostore = public_path($copyimgdir . $filename . "_150x60" . "." . $extension);
                //kopiraj smanjenu sliku
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                //save img to database
                /*
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = $copyimgdir . $filename . "_150x60" . "." . $extension;
                $imageToAuction->image_status =  App\ImagesToAuction::IMAGE_STATUS_THUMBNAIL;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_NOT_MAIN_IMAGE;
                $imageToAuction->save();
                */

                $img = Image::make($filenametostore);
                $img->resize(150, 60, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save();

                //CREATE SHOW IMAGE
                $filenametostore = public_path($copyimgdir . $filename . "_800x600" . "." . $extension);
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                $img = Image::make($filenametostore);
                $img->resize(800, 600, function($constraint){
                    $constraint->aspectRatio();
                });




                $imgname = "originalslika_Mona-braon-kaput-odlicno-stanje-258048233.jpg";

                $sampleimgdir = "image\catalog\sample\auction\\1\\";
                $filenamewithextension = public_path("{$sampleimgdir}{$imgname}");
                $filesystemObj = new Filesystem();
                $filename = $filesystemObj->name($filenamewithextension);
                $extension = $filesystemObj->extension($filenamewithextension);
                $copyimgdir = "image/catalog/auction/$auction_id/";
                if(!$filesystemObj->exists(public_path($copyimgdir))) {
                    $filesystemObj->makeDirectory(public_path($copyimgdir));
                }
                //kopiraj original sliku
                $filenamewithextension1 = public_path("{$copyimgdir}{$imgname}");
                $filesystemObj->copy($filenamewithextension, $filenamewithextension1);
                //save img to database
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = "{$copyimgdir}{$imgname}";
                $imageToAuction->image_status =  App\ImagesToAuction::IMAGE_STATUS_REALSIZE;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_NOT_MAIN_IMAGE;
                $imageToAuction->save();


                //CREATE THUMBNAIL
                $filenametostore = public_path($copyimgdir . $filename . "_150x60" . "." . $extension);
                //kopiraj smanjenu sliku
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                //save img to database
                /*
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = $copyimgdir . $filename . "_150x60" . "." . $extension;
                $imageToAuction->image_status =  App\ImagesToAuction::IMAGE_STATUS_THUMBNAIL;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_NOT_MAIN_IMAGE;
                $imageToAuction->save();
                */

                $img = Image::make($filenametostore);
                $img->resize(150, 60, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save();

                //CREATE SHOW IMAGE
                $filenametostore = public_path($copyimgdir . $filename . "_800x600" . "." . $extension);
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                $img = Image::make($filenametostore);
                $img->resize(800, 600, function($constraint){
                    $constraint->aspectRatio();
                });




                $imgname = "originalslika_Mona-braon-kaput-odlicno-stanje-258048237.jpg";

                $sampleimgdir = "image\catalog\sample\auction\\1\\";
                $filenamewithextension = public_path("{$sampleimgdir}{$imgname}");
                $filesystemObj = new Filesystem();
                $filename = $filesystemObj->name($filenamewithextension);
                $extension = $filesystemObj->extension($filenamewithextension);
                $copyimgdir = "image/catalog/auction/$auction_id/";
                if(!$filesystemObj->exists(public_path($copyimgdir))) {
                    $filesystemObj->makeDirectory(public_path($copyimgdir));
                }
                //kopiraj original sliku
                $filenamewithextension1 = public_path("{$copyimgdir}{$imgname}");
                $filesystemObj->copy($filenamewithextension, $filenamewithextension1);
                //save img to database
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = "{$copyimgdir}{$imgname}";
                $imageToAuction->image_status =  App\ImagesToAuction::IMAGE_STATUS_REALSIZE;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_NOT_MAIN_IMAGE;
                $imageToAuction->save();

                //CREATE THUMBNAIL
                $filenametostore = public_path($copyimgdir . $filename . "_150x60" . "." . $extension);
                //kopiraj smanjenu sliku
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                //save img to database
                /*
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = $copyimgdir . $filename . "_150x60" . "." . $extension;
                $imageToAuction->image_status =  App\ImagesToAuction::IMAGE_STATUS_THUMBNAIL;
                $imageToAuction->is_main_image = App\ImagesToAuction::IS_NOT_MAIN_IMAGE;
                $imageToAuction->save();
                */

                $img = Image::make($filenametostore);
                $img->resize(150, 60, function($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save();

                //CREATE SHOW IMAGE
                $filenametostore = public_path($copyimgdir . $filename . "_800x600" . "." . $extension);
                $filesystemObj->copy($filenamewithextension1, $filenametostore);
                $img = Image::make($filenametostore);
                $img->resize(800, 600, function($constraint){
                    $constraint->aspectRatio();
                });



                /*
                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = "";
                $imageToAuction->image_status = 1;
                $imageToAuction->save();


                $imageToAuction = new App\ImagesToAuction();
                $imageToAuction->auction_id = $auction_id;
                $imageToAuction->image = "";
                $imageToAuction->image_status = 2;
                $imageToAuction->save();
                */


                for($i = 0; $i< rand(1, 5); $i++) {
                    $shippmentToAuction = new App\ShippmentToAuction();
                    $shippmentToAuction->auction_id = $auction_id;
                    $shippmentToAuction->shippment_id = App\Shippment::pluck('id')->random();
                    $shippmentToAuction->save();

                    $auction->auction_shipping_from_id = $shippmentToAuction->id;
                    $auction->save();

                }

                for($i = 0; $i<rand(1, 5); $i++) {

                    $paymentMethodToAuction = new App\PaymentMethodToAuction();
                    $paymentMethodToAuction->auction_id = $auction_id;
                    $paymentMethodToAuction->payment_method_id = App\PaymentMethod::pluck('id')->random();
                    $paymentMethodToAuction->save();

                    $auction->auction_payment_method_id = $paymentMethodToAuction->id;
                    $auction->save();
                }

                for($i = 0; $i< rand(10, 200); $i++){
                    $auctionWatchers = new App\AuctionWatchers();
                    $auctionWatchers->auction_id = $auction_id;
                    $auctionWatchers->ip_address = $this->returnFaker()->ipv4;
                    //$auctionWatched->user_id =
                    $auctionWatchers->save();
                }

            });

        });
    }
}
