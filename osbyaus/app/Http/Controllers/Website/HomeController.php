<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $products = Product::with(['images','categories','colors','sizes','variants'])
            ->popularThisWeek()->take(8)->get();
        return view('website.index', compact('products'));
    }

}
