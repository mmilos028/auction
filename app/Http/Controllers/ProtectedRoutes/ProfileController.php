<?php

namespace App\Http\Controllers\ProtectedRoutes;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
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

    public function profile()
    {

        $user = auth()->user();

        return view('protected.profile.profile', [
            //'categories' => $categories
            'user' => $user
        ]);
    }
}

