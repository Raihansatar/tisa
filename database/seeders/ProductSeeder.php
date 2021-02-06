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
            'buying_price' => 20,
            'selling_price_per_unit' => 0.30,
            'stock' => 60
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'attribute' => 'Size',
            'value' => 'Large',
        ]);
        ProductVariant::create([
            'product_id' => $product->id,
            'attribute' => 'Size',
            'value' => 'Mini',
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'attribute' => 'Flavor',
            'value' => 'Smoky BBQZ',
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'attribute' => 'Flavor',
            'value' => 'BBQ',
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'attribute' => 'Flavor',
            'value' => 'Original',
        ]);

        $product = Product::create([
            'user_id' => 1,
            'name' => '',
            'brand' => 1,
            'category' => 1,
            'buying_price' => 45.03,
            'selling_price_per_unit' => 50.03,
            'stock' => 60
        ]);

        ProductVariant::create([
            'product_id' => $product->id,
            'attribute' => 'Flavor',
            'value' => 'Smoky BBQZ',
        ]);
    }
}
