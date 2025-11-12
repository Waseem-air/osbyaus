<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ✅ Show Product List
    public function product_list()
    {
        $products = Product::with(['category', 'images', 'sizes', 'colors'])->latest()->get();
        return view('admin.products.productlist', compact('products'));
    }

    // ✅ Show Add Product Form
    public function add_product()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.addproduct', compact('categories'));
    }

    // ✅ Store Product (AJAX)
    public function store_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'fabric' => 'required|string|max:255',
            'embellishment' => 'required|string|max:255',
            'cut' => 'required|string|max:255',
            'sizes' => 'required|array|min:1',
            'colors' => 'required|array|min:1',
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
            \DB::beginTransaction();

            // Create main product
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->price = $request->regular_price;
            $product->discount_price = $request->sale_price;
            $product->stock_quantity = $request->quantity;
            $product->fabric = $request->fabric;
            $product->embellishment = $request->embellishment;
            $product->cut = $request->cut;
            $product->status = $request->status === 'active' ? true : false;
            $product->save();

            // Handle sizes
            foreach ($request->sizes as $sizeName) {
                $size = new ProductSize();
                $size->product_id = $product->id;
                $size->name = $sizeName;
                $size->save();
            }

            // Handle colors
            foreach ($request->colors as $colorName) {
                $color = new ProductColor();
                $color->product_id = $product->id;
                $color->name = $colorName;
                
                // Get hex code from the color data if available
                $colorData = $this->getColorData($colorName);
                $color->hex_code = $colorData['hex'] ?? '#000000';
                $color->save();
            }

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

            \DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product added successfully!',
                'product_id' => $product->id
            ]);

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Product Store Error: ' . $e->getMessage());
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
            $product = Product::with(['images', 'sizes', 'colors'])->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'product' => $product
            ]);
        } catch (\Exception $e) {
            \Log::error('Product Fetch Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
    }

    // ✅ Update Product (AJAX)
    public function update_product(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'description' => 'required|string',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'fabric' => 'required|string|max:255',
            'embellishment' => 'required|string|max:255',
            'cut' => 'required|string|max:255',
            'sizes' => 'required|array|min:1',
            'colors' => 'required|array|min:1',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            \DB::beginTransaction();

            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->price = $request->regular_price;
            $product->discount_price = $request->sale_price;
            $product->stock_quantity = $request->quantity;
            $product->fabric = $request->fabric;
            $product->embellishment = $request->embellishment;
            $product->cut = $request->cut;
            $product->status = $request->status === 'active' ? true : false;
            $product->save();

            // Update sizes
            ProductSize::where('product_id', $product->id)->delete();
            foreach ($request->sizes as $sizeName) {
                $size = new ProductSize();
                $size->product_id = $product->id;
                $size->name = $sizeName;
                $size->save();
            }

            // Update colors
            ProductColor::where('product_id', $product->id)->delete();
            foreach ($request->colors as $colorName) {
                $color = new ProductColor();
                $color->product_id = $product->id;
                $color->name = $colorName;
                $colorData = $this->getColorData($colorName);
                $color->hex_code = $colorData['hex'] ?? '#000000';
                $color->save();
            }

            // Handle new images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);
                    
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = 'uploads/products/' . $imageName;
                    $productImage->is_main = false;
                    $productImage->save();
                }
            }

            \DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully!',
                'product_id' => $product->id
            ]);

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Product Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update product. Please try again.'
            ], 500);
        }
    }

    // ✅ Show Product Details
    public function show_product($id)
    {
        $product = Product::with(['category', 'images', 'sizes', 'colors'])->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // ✅ Delete Product (AJAX)
    public function delete_product($id)
    {
        try {
            \DB::beginTransaction();

            $product = Product::findOrFail($id);

            // Delete images from storage
            foreach ($product->images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }
            }

            // Delete product (cascade will delete related records)
            $product->delete();

            \DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully!'
            ]);

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Product Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product. Please try again.'
            ], 500);
        }
    }

    // ✅ Delete Product Image (AJAX)
    public function delete_product_image($id)
    {
        try {
            $image = ProductImage::findOrFail($id);
            
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
            
            $image->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Image deleted successfully!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Product Image Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete image. Please try again.'
            ], 500);
        }
    }

    // Helper function to get color data
    private function getColorData($colorName)
    {
        $colors = [
            'black' => ['hex' => '#000000', 'text' => '#ffffff'],
            'white' => ['hex' => '#ffffff', 'text' => '#000000'],
            'red' => ['hex' => '#ff0000', 'text' => '#ffffff'],
            'blue' => ['hex' => '#0000ff', 'text' => '#ffffff'],
            'green' => ['hex' => '#008000', 'text' => '#ffffff'],
            // Add all other colors from your select options
        ];

        return $colors[strtolower($colorName)] ?? ['hex' => '#000000', 'text' => '#ffffff'];
    }
}