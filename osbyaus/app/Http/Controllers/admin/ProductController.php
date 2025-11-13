<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // ✅ Show Product List
    public function product_list()
    {
        $products = Product::with(['categories', 'images'])->latest()->get();
        return view('admin.products.productlist', compact('products'));
    }

    // ✅ Show Add Product Form
    public function add_product()
    {
        $categories = Category::where('is_active', true)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('admin.products.addproduct', compact('categories', 'colors', 'sizes'));
    }

    // ✅ Store Product (AJAX) - Simplified without variants
    public function store_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'fabric' => 'required|string|max:255',
            'embellishment' => 'required|string|max:255',
            'cut' => 'required|string|max:255',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'exists:sizes,id',
            'colors' => 'required|array|min:1',
            'colors.*' => 'exists:colors,id',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create main product
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->price = $request->regular_price;
            $product->discount_price = $request->sale_price;
            $product->stock_quantity = $request->stock_quantity;
            $product->fabric = $request->fabric;
            $product->embellishment = $request->embellishment;
            $product->cut = $request->cut;
            $product->status = $request->status === 'active' ? true : false;
            $product->save();

            // Attach categories
            $product->categories()->attach($request->categories);

            // Store selected sizes (for filtering/search)
            $product->sizes()->attach($request->sizes);

            // Store selected colors (for filtering/search)
            $product->colors()->attach($request->colors);

            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = 'uploads/products/' . $imageName;
                    $productImage->is_main = $key === 0; // First image as main
                    $productImage->save();
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added successfully!',
                'product_id' => $product->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product Store Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add product. Please try again.'
            ], 500);
        }
    }

    // ✅ Get Product Data for Edit (AJAX)
    public function get_product($id)
    {
        try {
            $product = Product::with(['categories', 'images', 'sizes', 'colors'])->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'product' => $product
            ]);
        } catch (\Exception $e) {
            Log::error('Product Fetch Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
    }

    // ✅ Get Dynamic Data (Categories, Colors, Sizes)
    public function get_dynamic_data()
    {
        try {
            $categories = Category::where('is_active', true)->get(['id', 'name']);
            $colors = Color::where('is_active', true)->get(['id', 'name', 'hex_code']);
            $sizes = Size::where('is_active', true)->get(['id', 'name', 'short_code']);

            return response()->json([
                'status' => 'success',
                'categories' => $categories,
                'colors' => $colors,
                'sizes' => $sizes
            ]);
        } catch (\Exception $e) {
            Log::error('Dynamic Data Fetch Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to load data'
            ], 500);
        }
    }
}
