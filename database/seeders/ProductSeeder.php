<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'user_id' => 1,
            'name' => 'Corntoz',
            'brand' => null,
            'category' => 1,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Flavor',
                        'value' => 'Smoke BBQ'
                    ),
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Mini'
                    )
                )
            ),
            'buying_price' => 20,
            'selling_price_per_unit' => 0.30,
            'stock' => 60
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Flavor',
                        'value' => 'Original'
                    ),
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Mini'
                    )
                )
            ),
            'buying_price' => 20,
            'selling_price_per_unit' => 0.30,
            'stock' => 60
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Flavor',
                        'value' => 'Smoke BBQ'
                    ),
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Large'
                    )
                )
            ),
            'buying_price' => 20,
            'selling_price_per_unit' => 0.30,
            'stock' => 60
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Flavor',
                        'value' => 'Spicy'
                    ),
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Mini'
                    )
                )
            ),
            'buying_price' => 20,
            'selling_price_per_unit' => 0.30,
            'stock' => 60
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Flavor',
                        'value' => 'Spicy'
                    ),
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Large'
                    )
                )
            ),
            'buying_price' => 20,
            'selling_price_per_unit' => 1.00,
            'stock' => 60
        ]);

        $product = Product::create([
            'user_id' => 1,
            'name' => 'Air Milo',
            'brand' => 1,
            'category' => 2,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Mini'
                    )
                )
            ),
            'buying_price' => 20,
            'selling_price_per_unit' => 1.80,
            'stock' => 60
        ]);

        $product = Product::create([
            'user_id' => 1,
            'name' => 'Air Batu',
            'brand' => null,
            'category' => 2,
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Besar'
                    )
                )
            ),
            'buying_price' => 2.50,
            'selling_price_per_unit' => 3.00,
            'stock' => 5
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'variant' => json_encode(
                array(
                    array(
                        'attribute'=> 'Size',
                        'value' => 'Kecik'
                    )
                )
            ),
            'buying_price' => null,
            'selling_price_per_unit' => 1.00,
            'stock' => 3
        ]);
    }
}
