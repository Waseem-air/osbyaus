<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\CustomSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartController extends Controller
{
    const CART_COOKIE_NAME = 'cart_session_id';
    const COOKIE_EXPIRY = 525600; // 1 year
    /**
     * Display main cart page
     */
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cart->load([
            'items.product.images',
            'items.variant.color.color',
            'items.variant.size.size',
            'items.customSize'
        ]);

        if ($cart->exists) {
            $cart->updateTotals();
        }

        return view('website.cart.index', compact('cart'));
    }


    /**
     * Get cart page items (AJAX)
     */
    public function getCartItems()
    {
        $cart = $this->getOrCreateCart();
        $cart->load([
            'items.product.images',
            'items.variant.color.color',
            'items.variant.size.size',
            'items.customSize'
        ]);

        if ($cart->exists) {
            $cart->updateTotals();
        }

        return response()->json([
            'success' => true,
            'html' => view('website.cart.partials.cart-items', compact('cart'))->render(),
            'cartCount' => $cart->items_count ?? 0,
            'cartSubtotal' => number_format($cart->subtotal ?? 0, 2),
            'cartTotal' => number_format($cart->total ?? 0, 2),
        ]);
    }
    /**
     * Display cart sidebar (AJAX)
     */
    public function sidebar()
    {
        try {
            $cart = $this->getOrCreateCart();
            $cart->load(['items.product.images', 'items.variant.size', 'items.variant.color', 'items.customSize']);
            if ($cart->exists) {
                $cart->updreateTotals();
            }

            return response()->json([
                'success' => true,
                'html' => view('website.partials.cart-sidebar', [
                    'cart' => $cart,
                    'cartCount' => $cart->items_count ?? 0,
                    'cartSubtotal' => number_format($cart->subtotal ?? 0, 2),
                ])->render(),
                'cartCount' => $cart->items_count ?? 0,
                'cartSubtotal' => number_format($cart->subtotal ?? 0, 2),
                'cartTotal' => number_format($cart->total ?? 0, 2),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading cart',
                'html' => '
                <div class="text-center py-4">
                    <i class="fi-rr-exclamation" style="font-size: 3rem; color: #dc3545;"></i>
                    <p class="mt-2 text-danger">Error loading cart <strong><strong>' . e($e->getMessage()) . '</strong> </strong> </p>
                    <button class="btn btn-dark btn-sm mt-2" onclick="window.shoppingCart.loadCartSidebar()">
                        Retry
                    </button>
                </div>
            '
            ], 500);
        }
    }
    /**
     * Add regular product to cart (AJAX)
     */

    /**
     * Add regular product to cart (AJAX)
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color_id' => 'nullable|exists:colors,id',
            'size_id' => 'nullable|exists:sizes,id',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $cart = $this->getOrCreateCart();
                $product = Product::with('images')->findOrFail($request->product_id);

                // Check stock
                if ($product->stock_quantity < $request->quantity) {
                    throw new \Exception('Insufficient stock available');
                }

                // Find variant
                $variant = null;
                $selectedOptions = [];
                if ($request->color_id || $request->size_id) {
                    // Get the intermediate IDs from product_colors and product_sizes tables
                    $productColorId = null;
                    $productSizeId = null;

                    if ($request->color_id) {
                        $productColor = ProductColor::where('product_id', $product->id)
                            ->where('color_id', $request->color_id)
                            ->first();

                        if (!$productColor) {
                            throw new \Exception('Selected color not available for this product');
                        }
                        $productColorId = $productColor->id;
                        $selectedOptions['color_id'] = $request->color_id;
                    }

                    if ($request->size_id) {
                        $productSize = ProductSize::where('product_id', $product->id)
                            ->where('size_id', $request->size_id)
                            ->first();

                        if (!$productSize) {
                            throw new \Exception('Selected size not available for this product');
                        }
                        $productSizeId = $productSize->id;
                        $selectedOptions['size_id'] = $request->size_id;
                    }

                    // Find variant using the correct column names
                    $variant = ProductVariant::where('product_id', $product->id)
                        ->when($productColorId, function ($query) use ($productColorId) {
                            $query->where('product_color_id', $productColorId);
                        })
                        ->when($productSizeId, function ($query) use ($productSizeId) {
                            $query->where('product_size_id', $productSizeId);
                        })
                        ->first();

                    if (!$variant) {
                        throw new \Exception('Selected variant not available');
                    }

                    // Check variant stock
                    if ($variant->stock_quantity < $request->quantity) {
                        throw new \Exception('Insufficient stock for selected variant');
                    }
                } else {
                    // Check main product stock
                    if ($product->stock_quantity < $request->quantity) {
                        throw new \Exception('Insufficient stock available');
                    }
                }

                // Calculate price
                $price = $variant ? $variant->price : $product->final_price;

                // Check if identical item exists
                $existingItem = $cart->items()
                    ->where('product_id', $product->id)
                    ->where('product_variant_id', $variant?->id)
                    ->whereNull('custom_size_id')
                    ->whereJsonContains('selected_options', $selectedOptions)
                    ->first();

                if ($existingItem) {
                    $newQuantity = $existingItem->quantity + $request->quantity;

                    // Check stock for updated quantity
                    if ($variant && $variant->stock_quantity < $newQuantity) {
                        throw new \Exception('Insufficient stock for selected variant');
                    }
                    if (!$variant && $product->stock_quantity < $newQuantity) {
                        throw new \Exception('Insufficient stock available');
                    }

                    $existingItem->update([
                        'quantity' => $newQuantity,
                        'price' => $price
                    ]);
                    $existingItem->updateTotal();
                } else {
                    $cartItem = $cart->items()->create([
                        'product_id' => $product->id,
                        'product_variant_id' => $variant?->id,
                        'custom_size_id' => null,
                        'quantity' => $request->quantity,
                        'price' => $price,
                        'selected_options' => $selectedOptions,
                    ]);
                    $cartItem->updateTotal();
                }

                $cart->updateTotals();
                $this->updateCartCookie($cart);
            });

            return $this->getCartResponse('Item added to cart successfully!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
    /**
     * Add custom size product to cart (AJAX)
     */
    public function addCustomSizeToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'custom_size' => 'required|array',
            'custom_size.shirt_length' => 'required|numeric|min:1',
            'custom_size.shoulder' => 'required|numeric|min:1',
            'custom_size.chest' => 'required|numeric|min:1',
            'custom_size.waist' => 'required|numeric|min:1',
            'custom_size.sleeves_length' => 'required|numeric|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $cart = $this->getOrCreateCart();
                $product = Product::with('images')->findOrFail($request->product_id);

                // Create custom size record
                $customSize = CustomSize::create([
                    'product_id' => $product->id,
                    ...$request->custom_size
                ]);

                // Calculate price (base price + custom size fee)
                $price = $product->final_price + 500; // Custom size fee

                // Create cart item with custom size
                $cartItem = $cart->items()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => null,
                    'custom_size_id' => $customSize->id,
                    'quantity' => 1, // Custom size usually 1 quantity
                    'price' => $price,
                    'selected_options' => ['is_custom_size' => true],
                ]);

                $cartItem->updateTotal();
                $cart->updateTotals();
                $this->updateCartCookie($cart);
            });

            return $this->getCartResponse('Custom size item added to cart successfully!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding custom size: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * Update cart item quantity (AJAX)
     */

    /**
     * Update cart item quantity (AJAX)
     */
    public function updateQuantity(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $cart = $this->getOrCreateCart();
            $cartItem = $cart->items()->where('id', $cartItemId)->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart item not found'
                ], 404);
            }

            // Check stock for regular products
            if (!$cartItem->custom_size_id) {
                if ($cartItem->variant) {
                    if ($cartItem->variant->stock_quantity < $request->quantity) {
                        throw new \Exception('Insufficient stock for selected variant');
                    }
                } else {
                    if ($cartItem->product->stock_quantity < $request->quantity) {
                        throw new \Exception('Insufficient stock available');
                    }
                }
            }

            $cartItem->update(['quantity' => $request->quantity]);
            $cartItem->updateTotal();
            $cart->updateTotals();

            return $this->getCartResponse('Quantity updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Error updating cart quantity: ' . $e->getMessage(), [
                'cartItemId' => $cartItemId,
                'quantity' => $request->quantity,
                'message' =>  $e->getMessage().$e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
    /**
     * Remove item from cart (AJAX)
     */
    public function removeItem($cartItemId)
    {
        try {
            // Check if cart item exists and belongs to current user's cart
            $cart = $this->getOrCreateCart();
            $cartItem = $cart->items()->where('id', $cartItemId)->first();
            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart item not found or already removed'
                ], 404);
            }

            DB::transaction(function () use ($cartItem, $cart) {
                if ($cartItem->customSize) {
                    $cartItem->customSize->delete();
                }

                $cartItem->delete();
                if ($cart->items()->count() === 0) {
                    $cart->delete();
                    Cookie::queue(Cookie::forget(self::CART_COOKIE_NAME));
                } else {
                    $cart->updateTotals();
                }
            });

            return $this->getCartResponse('Item removed from cart!');

        } catch (\Exception $e) {
            \Log::error('Error removing cart item: ' . $e->getMessage(), [
                'cartItemId' => $cartItemId,
                'session_id' => $this->getCartSessionId(),
                'message' =>  $e->getMessage().$e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error removing item: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Clear entire cart (AJAX)
     */
    public function clearCart()
    {
        try {
            $cart = $this->getOrCreateCart();

            DB::transaction(function () use ($cart) {
                // Delete all custom size records
                $customSizeIds = $cart->items()->whereNotNull('custom_size_id')->pluck('custom_size_id');
                if ($customSizeIds->count() > 0) {
                    CustomSize::whereIn('id', $customSizeIds)->delete();
                }

                $cart->items()->delete();
                $cart->delete();
                Cookie::queue(Cookie::forget(self::CART_COOKIE_NAME));
            });

            return $this->getCartResponse('Cart cleared successfully!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart count (AJAX)
     */
    public function getCartCount()
    {
        $cart = $this->getOrCreateCart();

        return response()->json([
            'success' => true,
            'cartCount' => $cart->items_count ?? 0,
            'cartSubtotal' => number_format($cart->subtotal ?? 0, 2),
        ]);
    }

    /**
     * Get cart response for AJAX requests
     */
    protected function getCartResponse($message = '')
    {
        $cart = $this->getOrCreateCart();
        $cart->load(['items.product.images', 'items.variant.size', 'items.variant.color', 'items.customSize']);

        return response()->json([
            'success' => true,
            'message' => $message,
            'cartCount' => $cart->items_count ?? 0,
            'cartSubtotal' => number_format($cart->subtotal ?? 0, 2),
            'cartTotal' => number_format($cart->total ?? 0, 2),
            'html' => view('website.partials.cart-sidebar', [
                'cart' => $cart,
                'cartCount' => $cart->items_count ?? 0,
                'cartSubtotal' => number_format($cart->subtotal ?? 0, 2),
            ])->render(),
        ]);
    }

    /**
     * Retrieve or create cart
     */
    protected function getOrCreateCart()
    {
        $sessionId = $this->getCartSessionId();

        $cart = Cart::withCount('items')->firstOrCreate(
            ['session_id' => $sessionId],
            ['session_id' => $sessionId]
        );

        return $cart;
    }

    /**
     * Get cart session ID
     */
    protected function getCartSessionId()
    {
        $sessionId = Cookie::get(self::CART_COOKIE_NAME);

        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
            Cookie::queue(self::CART_COOKIE_NAME, $sessionId, self::COOKIE_EXPIRY);
        }

        return $sessionId;
    }

    /**
     * Update cart cookie
     */
    protected function updateCartCookie(Cart $cart)
    {
        Cookie::queue(self::CART_COOKIE_NAME, $cart->session_id, self::COOKIE_EXPIRY);
    }
}
