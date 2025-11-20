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
            ->with(['product.images', 'product.categories'])
            ->latest()
            ->get();

        return view('customer.wishlist.index', compact('wishlistItems'));
    }

    public function store(Request $request, Product $product)
    {
        // Check if product is already in wishlist
        $existingWishlistItem = Auth::user()->wishlistItems()
            ->where('product_id', $product->id)
            ->first();

        if ($existingWishlistItem) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in your wishlist.'
                ]);
            }
            return redirect()->back()->with('info', 'Product is already in your wishlist.');
        }

        // Add to wishlist
        Auth::user()->wishlistItems()->create([
            'product_id' => $product->id,
        ]);

        // Get updated wishlist count
        $wishlistCount = Auth::user()->wishlistItems()->count();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist successfully.',
                'wishlistCount' => $wishlistCount
            ]);
        }

        return redirect()->back()->with('success', 'Product added to wishlist successfully.');
    }

    public function destroy($id)
    {
        $wishlistItem = Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $wishlistItem->delete();

        // Get updated wishlist count
        $wishlistCount = Auth::user()->wishlistItems()->count();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist successfully.',
                'wishlistCount' => $wishlistCount
            ]);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist successfully.');
    }

    public function toggle(Request $request, Product $product)
    {
        $existingWishlistItem = Auth::user()->wishlistItems()
            ->where('product_id', $product->id)
            ->first();

        if ($existingWishlistItem) {
            // Remove from wishlist
            $existingWishlistItem->delete();
            $added = false;
            $message = 'Product removed from wishlist.';
        } else {
            // Add to wishlist
            Auth::user()->wishlistItems()->create([
                'product_id' => $product->id,
            ]);
            $added = true;
            $message = 'Product added to wishlist.';
        }

        // Get updated wishlist count
        $wishlistCount = Auth::user()->wishlistItems()->count();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'added' => $added,
                'message' => $message,
                'wishlistCount' => $wishlistCount
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function getCount()
    {
        $wishlistCount = Auth::check() ? Auth::user()->wishlistItems()->count() : 0;

        return response()->json([
            'success' => true,
            'wishlistCount' => $wishlistCount
        ]);
    }

    public function clear()
    {
        Auth::user()->wishlistItems()->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Wishlist cleared successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Wishlist cleared successfully.');
    }
}
