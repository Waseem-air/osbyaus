<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // ✅ Show Product List with AJAX support
    public function product_list(Request $request)
    {
        $query = Product::with([
            'categories',
            'images',
            'colors',
            'sizes',
            'variants',
        ]);

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('sku', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== 'all') {
            switch ($request->status) {
                case 'active':
                    $query->where('status', true);
                    break;
                case 'inactive':
                    $query->where('status', false);
                    break;
                case 'in_stock':
                    $query->where('stock_quantity', '>', 0);
                    break;
                case 'out_of_stock':
                    $query->where('stock_quantity', '<=', 0);
                    break;
            }
        }

        // Sort filter
        switch ($request->sort ?? 'newest') {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
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
        }

        // Pagination
        $products = $query->paginate(15)->withQueryString();

        // AJAX request - return HTML only
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.products.partials.product_list', compact('products'))->render(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ]
            ]);
        }

        // Regular request - return full view
        return view('admin.products.index', compact('products'));
    }


    // ✅ Show Add Product Form
    public function add_product()
    {
        $categories = Category::where('is_active', true)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();

        return view('admin.products.addproduct', compact('categories', 'colors', 'sizes'));
    }

    // ✅ Store Product (AJAX)
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
            $product->status = $request->has('status') && $request->status === 'active' ? true : false;
            $product->save();

            // Attach categories
            $product->categories()->attach($request->categories);

            // Create ProductColor records
            foreach ($request->colors as $colorId) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $colorId,
                ]);
            }

            // Create ProductSize records
            foreach ($request->sizes as $sizeId) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_id' => $sizeId,
                ]);
            }

            // Create variants for all color-size combinations
            $productColors = ProductColor::where('product_id', $product->id)->get();
            $productSizes = ProductSize::where('product_id', $product->id)->get();

            foreach ($productColors as $productColor) {
                foreach ($productSizes as $productSize) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'product_color_id' => $productColor->id,
                        'product_size_id' => $productSize->id,
                        'price' => $request->regular_price,
                        'stock_quantity' => $request->stock_quantity,
                        'sku' => $request->sku . '-' . $productColor->color_id . '-' . $productSize->size_id,
                    ]);
                }
            }

            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = 'uploads/products/' . $imageName;
                    $productImage->is_main = $key === 0;
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

    // ✅ Show Single Product
    public function show_product($id)
    {
        $product = Product::with([
            'categories',
            'images',
            'colors',
            'sizes',
            'variants.color',
            'variants.size'
        ])->findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    public function edit_product($id)
    {
        $product = Product::with([
            'categories',
            'images',
            'colors',
            'sizes',
            'variants.color',
            'variants.size'
        ])->findOrFail($id);

        $categories = Category::where('is_active', true)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::where('is_active', true)->get();
        return view('admin.products.editproduct', compact('categories', 'colors', 'sizes','product'));
    }

    // ✅ Get Product Data for Edit (AJAX)
    public function get_product($id)
    {
        try {
            $product = Product::with([
                'categories',
                'images',
                'colors.color',
                'sizes.size',
                'variants'
            ])->findOrFail($id);

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
    // ✅ Update Product
    public function update_product(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id,
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
            'images' => 'sometimes|array',
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

            $product = Product::findOrFail($id);
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
            $product->status = $request->has('status') && $request->status === 'active' ? true : false;
            $product->save();

            // Sync categories
            $product->categories()->sync($request->categories);

            // Sync colors - delete existing and create new
            ProductColor::where('product_id', $product->id)->delete();
            foreach ($request->colors as $colorId) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $colorId,
                ]);
            }

            // Sync sizes - delete existing and create new
            ProductSize::where('product_id', $product->id)->delete();
            foreach ($request->sizes as $sizeId) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_id' => $sizeId,
                ]);
            }

            // Handle new images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = 'uploads/products/' . $imageName;
                    $productImage->is_main = false; // New images are not main by default
                    $productImage->save();
                }
            }

            // Update variants if needed (optional - you can add this if you want to update variant prices/stock)
            $this->updateProductVariants($product, $request);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully!',
                'product_id' => $product->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product Update Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update product. Please try again.'
            ], 500);
        }
    }

// ✅ Optional: Update Product Variants
    private function updateProductVariants(Product $product, Request $request)
    {
        // If you want to update variant prices and stock when product details change
        $product->variants()->update([
            'price' => $request->regular_price,
            'stock_quantity' => $request->stock_quantity,
        ]);
    }
    // ✅ Delete Product
    public function delete_product($id)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            // Delete related records
            $product->variants()->delete();
            $product->categories()->detach();
            ProductColor::where('product_id', $product->id)->delete();
            ProductSize::where('product_id', $product->id)->delete();

            // Delete images and their files
            foreach ($product->images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }
                $image->delete();
            }

            // Delete main product
            $product->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Product Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product. Please try again.'
            ], 500);
        }
    }

    // ✅ Delete Product Image
    public function delete_product_image($id)
    {
        try {
            $image = ProductImage::findOrFail($id);

            // Delete file from storage
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }

            $image->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Image deleted successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Product Image Delete Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete image. Please try again.'
            ], 500);
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

    // Add this method to your ProductController
    public function set_main_image($id)
    {
        try {
            DB::beginTransaction();

            $image = ProductImage::findOrFail($id);

            // Remove main status from all images of this product
            ProductImage::where('product_id', $image->product_id)
                ->update(['is_main' => false]);

            // Set this image as main
            $image->is_main = true;
            $image->save();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Main image updated successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Set Main Image Error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update main image. Please try again.'
            ], 500);
        }
    }
}
