<?php

namespace App\Http\Controllers;

use App\Category;
use App\Auction;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

    public function listAuctionsFromCategorySlug($seo_url_path = null, $page = 1)
    {
        $path = [];

        //dd($seo_url_path);

        $perPage = 20;

        if(!isset($seo_url_path))
        {
            $path = [];
            $auctions = [];

            //$category = Category::getCategoryFromSlug($seo_url_path);
            $category_id = null;
        }else {
            $category = Category::getCategoryFromSlug($seo_url_path);

            $category_id = $category->id;

            $path = Category::getPath($category_id);

            $auctions = Auction::getAuctionsFromCategory($category_id, $page, $perPage)->paginate($perPage);

            $auctions->withPath($category->seo_url_path);
        }

        $current_category = Category::getCategory($category_id);

        //$categories = Category::getTopLevelCategories();
        $categories = (new Category())->getTopLevelCategoriesWithAuctionsCount();

        //$sub_categories = Category::getSubcategories($category_id);
        $sub_categories = (new Category())->getSubcategoriesWithAuctionsCount($category_id);

        //dd($path);
        //dd($auctions);

        return view('category.list-auctions-from-category', [
            'path' => $path,
            'auctions' => $auctions,
            'current_category' => $current_category,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
    }

    public function listAuctionsFromCategory($category_id = null, $page = 1)
    {
        //$category_id = $request->get('category_id', null);

        //$page = $request->get('page', 1);

        $path = [];

        if(!isset($category_id))
        {
            $path = [];
            $auctions = [];
        }else {

            $path = Category::getPath($category_id);

            $auctions = Auction::getAuctionsFromCategory($category_id, $page);
        }

        $current_category = Category::getCategory($category_id);

        //$categories = Category::getTopLevelCategories();
        $categories = (new Category())->getTopLevelCategoriesWithAuctionsCount();

        //$sub_categories = Category::getSubcategories($category_id);
        $sub_categories = (new Category())->getSubcategoriesWithAuctionsCount($category_id);

        //dd($path);

        return view('category.list-auctions-from-category', [
            'path' => $path,
            'auctions' => $auctions,
            'current_category' => $current_category,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
    }

    public function welcome()
    {
        $categories = Category::getTopLevelCategories();

        return view('welcome', [
            'categories' => $categories
        ]);
    }
}