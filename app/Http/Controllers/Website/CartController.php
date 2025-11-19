<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\CustomSize;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        // Get first product from cart for related products
        $firstItem = $cart->items->first();
        $relatedPopular = collect();

        if ($firstItem) {
            $product = $firstItem->product;
            $slug = $product->slug;
            $categoryIds = $product->categories->pluck('id');

            $relatedPopular = Product::with('images')
                ->where('slug', '!=', $slug)
                ->whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                })
                ->popularThisWeek()
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return view('website.cart.index', compact('cart', 'relatedPopular'));
    }

    /**
     * Bulk update cart quantities (AJAX) - For cart page only
     */
    public function updateCart(Request $request)
    {
        try {
            $quantities = $request->input('quantities', []);
            $cart = $this->getOrCreateCart();

            DB::transaction(function () use ($quantities, $cart) {
                foreach ($quantities as $itemId => $quantity) {
                    $cartItem = $cart->items()->where('id', $itemId)->first();

                    if ($cartItem) {
                        // Validate quantity
                        if ($quantity < 1) {
                            continue; // Skip invalid quantities
                        }

                        // Check stock for regular products
                        if (!$cartItem->custom_size_id) {
                            if ($cartItem->variant) {
                                if ($cartItem->variant->stock_quantity < $quantity) {
                                    throw new \Exception("Insufficient stock for {$cartItem->product->name} variant");
                                }
                            } else {
                                if ($cartItem->product->stock_quantity < $quantity) {
                                    throw new \Exception("Insufficient stock for {$cartItem->product->name}");
                                }
                            }
                        }

                        // Update quantity
                        $cartItem->update(['quantity' => $quantity]);
                        $cartItem->updateTotal();
                    }
                }

                $cart->updateTotals();
            });

            return $this->getCartPageResponse('Cart updated successfully!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Get cart page items (AJAX) - For cart page only
     */
    public function getCartPageItems()
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
     * Update cart item quantity (AJAX) - For cart page only
     */
    public function updateQuantityPage(Request $request, $cartItemId)
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

            return $this->getCartPageResponse('Quantity updated successfully!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Remove item from cart (AJAX) - For cart page only
     */
    public function removeItemPage($cartItemId)
    {
        try {
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

            return $this->getCartPageResponse('Item removed from cart!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing item: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear entire cart (AJAX) - For cart page only
     */
    public function clearCartPage()
    {
        try {
            $cart = $this->getOrCreateCart();

            DB::transaction(function () use ($cart) {
                $customSizeIds = $cart->items()->whereNotNull('custom_size_id')->pluck('custom_size_id');
                if ($customSizeIds->count() > 0) {
                    CustomSize::whereIn('id', $customSizeIds)->delete();
                }

                $cart->items()->delete();
                $cart->delete();
                Cookie::queue(Cookie::forget(self::CART_COOKIE_NAME));
            });

            return $this->getCartPageResponse('Cart cleared successfully!');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error clearing cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart page response for AJAX requests - For cart page only
     */
    protected function getCartPageResponse($message = '')
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
            'message' => $message,
            'cartCount' => $cart->items_count ?? 0,
            'cartSubtotal' => number_format($cart->subtotal ?? 0, 2),
            'cartTotal' => number_format($cart->total ?? 0, 2),
            'html' => view('website.cart.partials.cart-items', compact('cart'))->render(),
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
                $cart->updateTotals();
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
                    <p class="mt-2 text-danger">Error loading cart: ' . e($e->getMessage()) . '</p>
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

                // Find variant
                $variant = null;
                $selectedOptions = [];
                if ($request->color_id || $request->size_id) {
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

                    // Build variant query more carefully
                    $variantQuery = ProductVariant::where('product_id', $product->id);
                    if ($productColorId) {
                        $variantQuery->where('product_color_id', $productColorId);
                    } else {
                        $variantQuery->whereNull('product_color_id');
                    }

                    if ($productSizeId) {
                        $variantQuery->where('product_size_id', $productSizeId);
                    } else {
                        $variantQuery->whereNull('product_size_id');
                    }

                    $variant = $variantQuery->first();
                    if (!$variant) {
                        $variant = $this->findOrCreateVariant($product->id, $productColorId, $productSizeId);

                        if (!$variant) {
                            throw new \Exception('Selected variant not available and could not be created');
                        }
                    }

                    // Check variant stock
                    if ($variant->stock_quantity < $request->quantity) {
                        throw new \Exception('Insufficient stock for selected variant. Only ' . $variant->stock_quantity . ' available.');
                    }
                } else {
                    // No variant selected, check product stock
                    if ($product->stock_quantity < $request->quantity) {
                        throw new \Exception('Insufficient stock available. Only ' . $product->stock_quantity . ' available.');
                    }
                }

                $price = $variant ? $variant->price : $product->final_price;

                // Find existing cart item
                $existingItem = $cart->items()
                    ->where('product_id', $product->id)
                    ->where('product_variant_id', $variant?->id)
                    ->whereNull('custom_size_id')
                    ->first();

                if ($existingItem) {
                    $newQuantity = $existingItem->quantity + $request->quantity;

                    // Check stock for updated quantity
                    if ($variant) {
                        if ($variant->stock_quantity < $newQuantity) {
                            throw new \Exception('Insufficient stock for selected variant. Only ' . $variant->stock_quantity . ' available.');
                        }
                    } else {
                        if ($product->stock_quantity < $newQuantity) {
                            throw new \Exception('Insufficient stock available. Only ' . $product->stock_quantity . ' available.');
                        }
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
     * Find or create product variant
     */
    private function findOrCreateVariant($productId, $productColorId, $productSizeId)
    {
        // First, try to find existing variant
        $variant = ProductVariant::where('product_id', $productId)
            ->when($productColorId, function($q) use ($productColorId) {
                $q->where('product_color_id', $productColorId);
            }, function($q) {
                $q->whereNull('product_color_id');
            })
            ->when($productSizeId, function($q) use ($productSizeId) {
                $q->where('product_size_id', $productSizeId);
            }, function($q) {
                $q->whereNull('product_size_id');
            })
            ->first();

        if ($variant) {
            return $variant;
        }

        // If variant doesn't exist, create it
        $product = Product::find($productId);
        if (!$product) {
            return null;
        }

        // Create new variant
        $variant = ProductVariant::create([
            'product_id' => $productId,
            'product_color_id' => $productColorId,
            'product_size_id' => $productSizeId,
            'price' => $product->final_price, // Use product price as default
            'stock_quantity' => $product->stock_quantity, // Use product stock as default
            'sku' => $this->generateVariantSku($product, $productColorId, $productSizeId),
        ]);

        return $variant;
    }

    /**
     * Generate SKU for variant
     */
    private function generateVariantSku($product, $productColorId, $productSizeId)
    {
        $sku = $product->sku;

        if ($productColorId) {
            $productColor = ProductColor::with('color')->find($productColorId);
            if ($productColor && $productColor->color) {
                $sku .= '-' . strtoupper(substr($productColor->color->name, 0, 3));
            }
        }

        if ($productSizeId) {
            $productSize = ProductSize::with('size')->find($productSizeId);
            if ($productSize && $productSize->size) {
                $sku .= '-' . strtoupper($productSize->size->short_code ?? $productSize->size->name);
            }
        }

        return $sku;
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

                $customSize = CustomSize::create([
                    'product_id' => $product->id,
                    ...$request->custom_size
                ]);

                $price = $product->final_price + 500;

                $cartItem = $cart->items()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => null,
                    'custom_size_id' => $customSize->id,
                    'quantity' => 1,
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

    public function login(LoginRequest $request): JsonResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();
         return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => [
                    'name' => $user->username,
                    'email' => $user->email
                ]
            ]);
        }
}
