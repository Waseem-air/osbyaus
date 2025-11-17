<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class AdditionalProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing data
        $categories = Category::where('is_active', true)->get();
        $colors = Color::where('is_active', true)->get();
        $sizes = Size::all();

        // Get all existing product images to reuse
        $existingImages = ProductImage::all();

        $products = [
            [
                'name' => 'Embroidered Maxi Dress',
                'description' => 'Beautiful embroidered maxi dress with delicate patterns and flowy silhouette. Perfect for weddings and special occasions.',
                'fabric' => 'Chiffon',
                'embellishment' => 'Embroidery',
                'cut' => 'A-Line',
                'regular_price' => 125.99,
                'sale_price' => 112.99,
                'stock_quantity' => 35,
                'sku' => 'EMB-MAXI-101'
            ],
            [
                'name' => 'Silk Blouse with Ruffles',
                'description' => 'Elegant silk blouse with ruffle details and button-down front. Perfect for office wear and formal events.',
                'fabric' => 'Silk',
                'embellishment' => 'Ruffles',
                'cut' => 'Fitted',
                'regular_price' => 89.99,
                'sale_price' => 79.99,
                'stock_quantity' => 40,
                'sku' => 'SLK-BLS-102'
            ],
            [
                'name' => 'Denim Wide Leg Pants',
                'description' => 'Trendy wide leg denim pants with high waist and comfortable fit. Perfect for casual outings and street style.',
                'fabric' => 'Denim',
                'embellishment' => 'None',
                'cut' => 'Wide Leg',
                'regular_price' => 65.99,
                'sale_price' => 55.99,
                'stock_quantity' => 50,
                'sku' => 'DNM-PNT-103'
            ],
            [
                'name' => 'Sequined Evening Gown',
                'description' => 'Stunning sequined evening gown with mermaid cut and open back. Perfect for red carpet events and galas.',
                'fabric' => 'Satin',
                'embellishment' => 'Sequins',
                'cut' => 'Mermaid',
                'regular_price' => 299.99,
                'sale_price' => 269.99,
                'stock_quantity' => 15,
                'sku' => 'SEQ-GWN-104'
            ],
            [
                'name' => 'Linen Jumpsuit',
                'description' => 'Comfortable linen jumpsuit with wide legs and adjustable belt. Perfect for summer vacations and casual events.',
                'fabric' => 'Linen',
                'embellishment' => 'None',
                'cut' => 'Wide Leg',
                'regular_price' => 78.99,
                'sale_price' => 68.99,
                'stock_quantity' => 30,
                'sku' => 'LIN-JMP-105'
            ],
            [
                'name' => 'Velvet Midi Dress',
                'description' => 'Luxurious velvet midi dress with long sleeves and crew neck. Perfect for winter parties and formal gatherings.',
                'fabric' => 'Velvet',
                'embellishment' => 'None',
                'cut' => 'Bodycon',
                'regular_price' => 145.99,
                'sale_price' => 129.99,
                'stock_quantity' => 25,
                'sku' => 'VLV-MDI-106'
            ],
            [
                'name' => 'Cotton Wrap Top',
                'description' => 'Flattering cotton wrap top with tie waist and v-neck. Versatile piece that can be dressed up or down.',
                'fabric' => 'Cotton',
                'embellishment' => 'None',
                'cut' => 'Wrap',
                'regular_price' => 42.99,
                'sale_price' => 36.99,
                'stock_quantity' => 45,
                'sku' => 'CTN-TOP-107'
            ],
            [
                'name' => 'Embroidered Kimono Jacket',
                'description' => 'Bohemian style kimono jacket with intricate embroidery and fringe details. Perfect layering piece.',
                'fabric' => 'Georgette',
                'embellishment' => 'Embroidery',
                'cut' => 'Oversized',
                'regular_price' => 68.99,
                'sale_price' => 58.99,
                'stock_quantity' => 35,
                'sku' => 'KIM-JKT-108'
            ],
            [
                'name' => 'Pleated Midi Skirt',
                'description' => 'Elegant pleated midi skirt with elastic waistband and flowy silhouette. Perfect for office and casual wear.',
                'fabric' => 'Polyester',
                'embellishment' => 'Pleated',
                'cut' => 'A-Line',
                'regular_price' => 55.99,
                'sale_price' => 47.99,
                'stock_quantity' => 40,
                'sku' => 'PLT-SKT-109'
            ],
            [
                'name' => 'Knit Sweater Set',
                'description' => 'Cozy knit sweater set with turtleneck top and matching cardigan. Perfect for cold weather styling.',
                'fabric' => 'Wool Knit',
                'embellishment' => 'Ribbed',
                'cut' => 'Regular',
                'regular_price' => 95.99,
                'sale_price' => 85.99,
                'stock_quantity' => 28,
                'sku' => 'KNT-SET-110'
            ],
            [
                'name' => 'Satin Slip Dress',
                'description' => 'Elegant satin slip dress with adjustable straps and bias cut. Perfect for evening events and special occasions.',
                'fabric' => 'Satin',
                'embellishment' => 'Lace Trim',
                'cut' => 'Bias',
                'regular_price' => 88.99,
                'sale_price' => 75.99,
                'stock_quantity' => 32,
                'sku' => 'SAT-SLP-111'
            ],
            [
                'name' => 'Leather Moto Jacket',
                'description' => 'Classic leather moto jacket with zipper details and quilted shoulders. Edgy addition to any wardrobe.',
                'fabric' => 'Genuine Leather',
                'embellishment' => 'Zipper',
                'cut' => 'Fitted',
                'regular_price' => 225.99,
                'sale_price' => 199.99,
                'stock_quantity' => 18,
                'sku' => 'LTH-JKT-112'
            ],
            [
                'name' => 'Chiffon Party Dress',
                'description' => 'Elegant chiffon party dress with embroidered details and flowy cut, perfect for festive occasions.',
                'fabric' => 'Chiffon',
                'embellishment' => 'Embroidery',
                'cut' => 'A-Line',
                'regular_price' => 110.99,
                'sale_price' => 105.99,
                'stock_quantity' => 50,
                'sku' => 'CHF-PTY-113'
            ],
            [
                'name' => 'Wool Blend Blazer',
                'description' => 'Structured wool blend blazer with notched lapel and tailored fit. Perfect for professional settings.',
                'fabric' => 'Wool Blend',
                'embellishment' => 'None',
                'cut' => 'Tailored',
                'regular_price' => 135.99,
                'sale_price' => 119.99,
                'stock_quantity' => 22,
                'sku' => 'WOL-BLZ-114'
            ],
            [
                'name' => 'Printed Palazzo Pants',
                'description' => 'Comfortable printed palazzo pants with elastic waist and flowy legs. Perfect for summer and beach wear.',
                'fabric' => 'Rayon',
                'embellishment' => 'Print',
                'cut' => 'Wide Leg',
                'regular_price' => 52.99,
                'sale_price' => 45.99,
                'stock_quantity' => 38,
                'sku' => 'PAL-PNT-115'
            ]
        ];

        foreach ($products as $productData) {
            try {
                DB::beginTransaction();

                // Create main product
                $product = new Product();
                $product->name = $productData['name'];
                $product->slug = Str::slug($productData['name']);
                $product->sku = $productData['sku'];
                $product->description = $productData['description'];
                $product->price = $productData['regular_price'];
                $product->discount_price = $productData['sale_price'];
                $product->stock_quantity = $productData['stock_quantity'];
                $product->fabric = $productData['fabric'];
                $product->embellishment = $productData['embellishment'];
                $product->cut = $productData['cut'];
                $product->status = 'active';
                $product->save();

                // Attach random categories (1-2 categories)
                $randomCategories = $categories->random(rand(1, 2))->pluck('id')->toArray();
                $product->categories()->attach($randomCategories);

                // Attach random colors (2-3 colors)
                $randomColors = $colors->random(rand(2, 3))->pluck('id')->toArray();
                foreach ($randomColors as $colorId) {
                    ProductColor::create([
                        'product_id' => $product->id,
                        'color_id' => $colorId,
                    ]);
                }

                // Attach random sizes (3-4 sizes)
                $randomSizes = $sizes->random(rand(3, 4))->pluck('id')->toArray();
                foreach ($randomSizes as $sizeId) {
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
                            'price' => $productData['regular_price'],
                            'stock_quantity' => $productData['stock_quantity'],
                            'sku' => $productData['sku'] . '-' . $productColor->color_id . '-' . $productSize->size_id,
                        ]);
                    }
                }

                // Use existing product images (3-4 random images per product)
                $numberOfImages = rand(3, 4);
                $randomExistingImages = $existingImages->random($numberOfImages);

                $isFirst = true;
                foreach ($randomExistingImages as $existingImage) {
                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = $existingImage->image_path;
                    $productImage->is_main = $isFirst;
                    $productImage->save();
                    $isFirst = false;
                }

                DB::commit();

                $this->command->info("Created product: {$productData['name']} with {$numberOfImages} images");

            } catch (\Exception $e) {
                DB::rollBack();
                $this->command->error("Failed to create product {$productData['name']}: " . $e->getMessage());
            }
        }

        $this->command->info('Successfully created 15 additional fashion products with existing images!');
    }
}
