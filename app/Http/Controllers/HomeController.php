<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use App\CategoryToAuction;
use Illuminate\Http\Request;
//use File;
use Illuminate\Support\Facades\App;
use \Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        //$categories = Category::getTopLevelCategories();
        $categories = (new Category())->getTopLevelCategoriesWithAuctionsCount();

        $last_auctions = Auction::getLastAuctions();


        //dd($last_auctions);

        return view('welcome', [
            'categories' => $categories,
            'last_auctions' => $last_auctions
        ]);
    }

    public function test(){
        //$model = new Category();
        //1dd($model->countCategoryItems());
        //dd(Category::getCategoriesWithAuctionsCount());

        //dd((new Category())->getTopLevelCategoriesWithAuctionsCount());
        //$coll = (new Category())->getTopLevelCategoriesWithAuctionsCount();

        //$coll = Category::getTopLevelCategories();


        //$coll = Category::all()->find("id", 3);
        //$coll = (new Category())->getParentsCategories(3);

        //$coll = Category::all()->find(3)->getParentsCategories()->get();

        //dump($coll);

        /*
        \Illuminate\Support\Facades\Storage::copy(
            public_path("image\catalog\sample\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg"),
            public_path("image\catalog\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg")
        );
        */

        //$filePath = 'public\catalog\sample\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg';
        //$filePath = public_path('public\catalog\sample\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg');
        //$content = \Illuminate\Support\Facades\Storage::disk('local')->get($filePath);
        //dd($content);

        /*
        \Illuminate\Support\Facades\Storage::disk('local')->copy(
            "public\catalog\sample\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg",
            "public\catalog\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg"
        );
        */

        /*
        $filenamewithextension = "public\catalog\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg";
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = pathinfo($filenamewithextension, PATHINFO_EXTENSION);
        $filenametostore = $filename . "." . $extension;

        if(!\Illuminate\Support\Facades\Storage::disk('local')->exists("public\catalog\auction\\1\\" . $filenametostore)) {
            \Illuminate\Support\Facades\Storage::disk('local')->copy(
                "public\catalog\sample\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg",
                "public\catalog\auction\\1\\" . $filenametostore
            );
        }

        $thumbnailpath = "public\catalog\auction\\1\\" . $filenametostore;

        $img = Image::make(\Illuminate\Support\Facades\Storage::disk('local')->get($thumbnailpath));
        $img->resize(400, 150, function($constraint) {
            $constraint->aspectRatio();
        });

        $filename = pathinfo($thumbnailpath, PATHINFO_FILENAME);
        $extension = pathinfo($thumbnailpath, PATHINFO_EXTENSION);
        $thumbnailpath = $filename. "_" . "400x150." . $extension;
        $img->save(App::basePath() . "\public\catalog\auction\\1\\" . $thumbnailpath);
        */

        //Storage::disk('public')->get("image\catalog\sample\auction\\1\originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg")

        $sampleimgdir = "image\catalog\sample\auction\\1\\";

        $filenamewithextension = public_path("{$sampleimgdir}originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg");
        $filesystemObj = new Filesystem();
        $filename = $filesystemObj->name($filenamewithextension);
        //dd($filename);
        $extension = $filesystemObj->extension($filenamewithextension);
        //dd($extension);
        $copyimgdir = "image\catalog\auction\\1\\";

        $filenamewithextension1 = public_path("{$copyimgdir}originalslika_Mona-braon-kaput-odlicno-stanje-258048225.jpg");
        $filesystemObj->copy($filenamewithextension, $filenamewithextension1);

        if(!$filesystemObj->exists(public_path($copyimgdir))) {
            $filesystemObj->makeDirectory(public_path($copyimgdir));
        }
        $filenametostore = public_path($copyimgdir . $filename . "_400x150" . "." . $extension);
        $filesystemObj->copy($filenamewithextension1, $filenametostore);

        $img = Image::make($filenametostore);
        $img->resize(400, 150, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save();

    }
}
