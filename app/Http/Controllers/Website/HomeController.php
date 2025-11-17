<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        // Fetch popular products this week
        $products = Product::with(['images', 'categories', 'colors', 'sizes', 'variants'])
            ->popularThisWeek()
            ->take(8)
            ->get();

        // If less than 8, fill with random products
        if ($products->count() < 8) {
            $remaining = 8 - $products->count();
            $randomProducts = Product::with(['images', 'categories', 'colors', 'sizes', 'variants'])
                ->whereNotIn('id', $products->pluck('id'))
                ->inRandomOrder()
                ->take($remaining)
                ->get();

            $products = $products->merge($randomProducts);
        }
        return view('website.index', compact('products'));
    }


}
