<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create(['name' => 'Food']);
        ProductCategory::create(['name' => 'Drink']);
        ProductCategory::create(['name' => 'Laptop']);
        ProductCategory::create(['name' => 'Accessory']);
        ProductCategory::create(['name' => 'Sport']);
        ProductCategory::create(['name' => 'Ball']);
        ProductCategory::create(['name' => 'Stationary']);
        ProductCategory::create(['name' => 'Shirt']);
    }
}
