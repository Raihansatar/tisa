<?php

namespace Database\Seeders;

use App\Models\Product;
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
        Product::create([
            'user_id' => 1,
            'name' => 'Baju',
            'brand' => 10,
            'category' => 8,
            'buying_price' => 45.03,
            'selling_price' => 50.03,
            'stock' => 60
        ]);
    }
}
