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

        // Apply filters from session or request
        $filters = $request->session()->get('product_filters', []);

        // If it's a POST request, update filters in session
        if ($request->isMethod('post')) {
            $filters = $request->except(['_token', 'page']);
            $request->session()->put('product_filters', $filters);
        }

        // Apply filters from session
        if (!empty($filters['sizes'])) {
            $sizeIds = is_array($filters['sizes']) ? $filters['sizes'] : explode(',', $filters['sizes']);
            $query->whereHas('sizes', function($q) use ($sizeIds) {
                $q->whereIn('sizes.id', $sizeIds);
            });
        }

        if (!empty($filters['availability'])) {
            $availability = is_array($filters['availability']) ? $filters['availability'] : explode(',', $filters['availability']);
            if (in_array('in_stock', $availability)) {
                $query->where('stock_quantity', '>', 0);
            }
            if (in_array('out_of_stock', $availability)) {
                $query->where('stock_quantity', '<=', 0);
            }
        }

        if (!empty($filters['min_price']) && !empty($filters['max_price'])) {
            $query->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
        }

        if (!empty($filters['embellishments'])) {
            $embellishments = is_array($filters['embellishments']) ? $filters['embellishments'] : explode(',', $filters['embellishments']);
            $query->whereIn('embellishment', $embellishments);
        }

        if (!empty($filters['cuts'])) {
            $cuts = is_array($filters['cuts']) ? $filters['cuts'] : explode(',', $filters['cuts']);
            $query->whereIn('cut', $cuts);
        }

        if (!empty($filters['fabrics'])) {
            $fabrics = is_array($filters['fabrics']) ? $filters['fabrics'] : explode(',', $filters['fabrics']);
            $query->whereIn('fabric', $fabrics);
        }

        // Apply sorting
        $sort = $request->get('sort', $filters['sort'] ?? 'latest');
        switch ($sort) {
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

        if ($request->ajax()) {
            return response()->json([
                'html' => view('website.partials.products-grid', compact('products'))->render(),
                'total' => $products->total()
            ]);
        }

        return view('website.products', compact('products', 'sizes', 'embellishments', 'cuts', 'fabrics', 'filters'));
    }

    public function clearFilters(Request $request)
    {
        $request->session()->forget('product_filters');
        return redirect()->route('products.index');
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
