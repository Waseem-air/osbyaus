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
            ],
            // Additional 15 products
            [
                'name' => 'Tulle Ball Gown',
                'description' => 'Dreamy tulle ball gown with layered skirt and sweetheart neckline. Perfect for proms and formal dances.',
                'fabric' => 'Tulle',
                'embellishment' => 'Sequins',
                'cut' => 'Ball Gown',
                'regular_price' => 189.99,
                'sale_price' => 169.99,
                'stock_quantity' => 20,
                'sku' => 'TUL-GWN-116'
            ],
            [
                'name' => 'Cashmere Turtleneck Sweater',
                'description' => 'Luxurious cashmere turtleneck sweater with ribbed details. Ultra-soft and perfect for winter elegance.',
                'fabric' => 'Cashmere',
                'embellishment' => 'Ribbed',
                'cut' => 'Regular',
                'regular_price' => 156.99,
                'sale_price' => 139.99,
                'stock_quantity' => 25,
                'sku' => 'CSH-SWT-117'
            ],
            [
                'name' => 'Brocade Blazer Dress',
                'description' => 'Sophisticated brocade blazer dress with gold thread details and structured silhouette. Office to evening wear.',
                'fabric' => 'Brocade',
                'embellishment' => 'Metallic Thread',
                'cut' => 'Blazer',
                'regular_price' => 178.99,
                'sale_price' => 159.99,
                'stock_quantity' => 18,
                'sku' => 'BRC-DRS-118'
            ],
            [
                'name' => 'Floral Print Sundress',
                'description' => 'Charming floral print sundress with smocked bodice and tiered skirt. Perfect for summer brunches and dates.',
                'fabric' => 'Cotton Blend',
                'embellishment' => 'Floral Print',
                'cut' => 'Fit and Flare',
                'regular_price' => 67.99,
                'sale_price' => 57.99,
                'stock_quantity' => 42,
                'sku' => 'FLR-SUN-119'
            ],
            [
                'name' => 'Sequin Mini Dress',
                'description' => 'Sparkling sequin mini dress with sleeveless design and crew neck. Perfect for New Year parties and club nights.',
                'fabric' => 'Polyester',
                'embellishment' => 'Sequins',
                'cut' => 'Bodycon',
                'regular_price' => 98.99,
                'sale_price' => 84.99,
                'stock_quantity' => 30,
                'sku' => 'SEQ-MIN-120'
            ],
            [
                'name' => 'Corduroy Overall Dress',
                'description' => 'Trendy corduroy overall dress with button front and adjustable straps. Vintage inspired casual wear.',
                'fabric' => 'Corduroy',
                'embellishment' => 'None',
                'cut' => 'A-Line',
                'regular_price' => 72.99,
                'sale_price' => 62.99,
                'stock_quantity' => 35,
                'sku' => 'CRD-OVR-121'
            ],
            [
                'name' => 'Lace Trim Camisole Set',
                'description' => 'Elegant lace trim camisole set with matching shorts. Perfect for layering or sleepwear.',
                'fabric' => 'Satin',
                'embellishment' => 'Lace Trim',
                'cut' => 'Fitted',
                'regular_price' => 45.99,
                'sale_price' => 38.99,
                'stock_quantity' => 50,
                'sku' => 'LAC-CAM-122'
            ],
            [
                'name' => 'Wool Blend Trench Coat',
                'description' => 'Classic wool blend trench coat with double-breasted front and belt. Timeless outerwear piece.',
                'fabric' => 'Wool Blend',
                'embellishment' => 'None',
                'cut' => 'Regular',
                'regular_price' => 198.99,
                'sale_price' => 179.99,
                'stock_quantity' => 20,
                'sku' => 'WOL-TRN-123'
            ],
            [
                'name' => 'Embroidered Peplum Top',
                'description' => 'Feminine embroidered peplum top with three-quarter sleeves and flared hem. Creates beautiful silhouette.',
                'fabric' => 'Crepe',
                'embellishment' => 'Embroidery',
                'cut' => 'Peplum',
                'regular_price' => 58.99,
                'sale_price' => 49.99,
                'stock_quantity' => 40,
                'sku' => 'PEP-TOP-124'
            ],
            [
                'name' => 'Velour Track Set',
                'description' => 'Comfortable velour track set with zip-up hoodie and matching pants. Sporty luxury for casual days.',
                'fabric' => 'Velour',
                'embellishment' => 'None',
                'cut' => 'Regular',
                'regular_price' => 89.99,
                'sale_price' => 76.99,
                'stock_quantity' => 33,
                'sku' => 'VEL-TRK-125'
            ],
            [
                'name' => 'Chiffon Tiered Maxi Skirt',
                'description' => 'Flowy chiffon tiered maxi skirt with elastic waist and multiple layers. Bohemian and romantic.',
                'fabric' => 'Chiffon',
                'embellishment' => 'Tiered',
                'cut' => 'A-Line',
                'regular_price' => 63.99,
                'sale_price' => 54.99,
                'stock_quantity' => 38,
                'sku' => 'CHF-SKT-126'
            ],
            [
                'name' => 'Faux Fur Coat',
                'description' => 'Luxurious faux fur coat with shawl collar and full length. Makes a bold fashion statement in winter.',
                'fabric' => 'Faux Fur',
                'embellishment' => 'None',
                'cut' => 'Oversized',
                'regular_price' => 167.99,
                'sale_price' => 149.99,
                'stock_quantity' => 15,
                'sku' => 'FUR-CT-127'
            ],
            [
                'name' => 'Denim Shirt Dress',
                'description' => 'Versatile denim shirt dress with button front and belt. Can be dressed up or down for various occasions.',
                'fabric' => 'Denim',
                'embellishment' => 'None',
                'cut' => 'Shirt',
                'regular_price' => 74.99,
                'sale_price' => 64.99,
                'stock_quantity' => 28,
                'sku' => 'DNM-DRS-128'
            ],
            [
                'name' => 'Metallic Knit Dress',
                'description' => 'Eye-catching metallic knit dress with long sleeves and crew neck. Perfect for holiday parties and events.',
                'fabric' => 'Metallic Knit',
                'embellishment' => 'Metallic Thread',
                'cut' => 'Bodycon',
                'regular_price' => 112.99,
                'sale_price' => 96.99,
                'stock_quantity' => 22,
                'sku' => 'MTL-KNT-129'
            ],
            [
                'name' => 'Organza Blouse',
                'description' => 'Delicate organza blouse with puff sleeves and ribbon tie neck. Feminine and elegant for special occasions.',
                'fabric' => 'Organza',
                'embellishment' => 'Ribbon Tie',
                'cut' => 'Relaxed',
                'regular_price' => 82.99,
                'sale_price' => 69.99,
                'stock_quantity' => 26,
                'sku' => 'ORG-BLS-130'
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

        $this->command->info('Successfully created 30 fashion products with existing images!');
    }
}
