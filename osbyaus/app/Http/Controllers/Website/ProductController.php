<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function show($slug)
    {
        $product = Product::with(['images', 'categories', 'colors', 'sizes', 'variants'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPopular = Product::with('images')
            ->where('slug', '!=', $slug)
            ->whereHas('categories', function ($q) use ($product) {
                $q->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->popularThisWeek()
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('website.show', compact('product', 'relatedPopular'));
    }


}
