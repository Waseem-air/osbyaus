<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['images', 'categories', 'sizes'])
            ->where('status', 'active');

        // Apply filters
        if ($request->has('sizes')) {
            $sizeIds = explode(',', $request->sizes);
            $query->whereHas('sizes', function($q) use ($sizeIds) {
                $q->whereIn('sizes.id', $sizeIds);
            });
        }

        if ($request->has('availability')) {
            $availability = explode(',', $request->availability);
            if (in_array('in_stock', $availability)) {
                $query->where('stock_quantity', '>', 0);
            }
            if (in_array('out_of_stock', $availability)) {
                $query->where('stock_quantity', '<=', 0);
            }
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if ($request->has('embellishments')) {
            $embellishments = explode(',', $request->embellishments);
            $query->whereIn('embellishment', $embellishments);
        }

        if ($request->has('cuts')) {
            $cuts = explode(',', $request->cuts);
            $query->whereIn('cut', $cuts);
        }

        if ($request->has('fabrics')) {
            $fabrics = explode(',', $request->fabrics);
            $query->whereIn('fabric', $fabrics);
        }

        // Apply sorting
        switch ($request->get('sort', 'latest')) {
            case 'featured':
                $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);

        // Get filter options
        $sizes = Size::where('is_active', true)->get();
        $embellishments = Product::distinct()->whereNotNull('embellishment')->pluck('embellishment');
        $cuts = Product::distinct()->whereNotNull('cut')->pluck('cut');
        $fabrics = Product::distinct()->whereNotNull('fabric')->pluck('fabric');

        dd($request->all());

        if ($request->ajax()) {
            return response()->json([
                'html' => view('website.partials.products-grid', compact('products'))->render(),
                'total' => $products->total()
            ]);
        }

        return view('website.products', compact('products', 'sizes', 'embellishments', 'cuts', 'fabrics'));
    }

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
