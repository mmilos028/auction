<?php

namespace App\Http\Controllers\ProtectedRoutes;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setupAuction()
    {
        $categories = Category::getTopLevelCategories();

        return view('welcome', [
            'categories' => $categories
        ]);
    }
}
