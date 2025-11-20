<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Auth::user()->wishlistItems()
            ->with(['product.images'])
            ->latest()
            ->get();

        return view('customer.wishlist.index', compact('wishlistItems'));
    }

    public function store(Product $product)
    {
        // Check if product is already in wishlist
        $existingWishlistItem = Auth::user()->wishlistItems()
            ->where('product_id', $product->id)
            ->first();

        if ($existingWishlistItem) {
            return redirect()->back()->with('info', 'Product is already in your wishlist.');
        }

        Auth::user()->wishlistItems()->create([
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully.');
    }

    public function destroy(Wishlist $wishlistItem)
    {
        if ($wishlistItem->user_id !== Auth::id()) {
            abort(404);
        }

        $wishlistItem->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist successfully.');
    }
}
