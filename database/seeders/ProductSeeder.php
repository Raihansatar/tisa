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

        // $variant[0]['attribute'] = 'Flavor';
        // $variant[0]['value'] = 'Large';
        // $variant[1]['attribute'] = 'Size';
        // $variant[1]['value'] = 'Large';
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
            // 'attribute' => 'Size',
            // 'value' => 'Large',
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
            'selling_price_per_unit' => 0.30,
            'stock' => 60
        ]);

        $product = Product::create([
            'user_id' => 1,
            'name' => 'Air Milo',
            'brand' => 1,
            'category' => 1,
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
            'selling_price_per_unit' => 0.30,
            'stock' => 60
        ]);
    }
}
