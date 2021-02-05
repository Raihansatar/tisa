<?php

namespace Database\Seeders;

use App\Models\ProductBrand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductBrand::create(['name' => 'Nestle']);
        ProductBrand::create(['name' => 'Wonda']);
        ProductBrand::create(['name' => 'Mirinda']);
        ProductBrand::create(['name' => 'F&N']);
        ProductBrand::create(['name' => 'Yeos']);
        ProductBrand::create(['name' => 'BadLab']);
        ProductBrand::create(['name' => 'Lenovo']);
        ProductBrand::create(['name' => 'Mikasa']);
        ProductBrand::create(['name' => 'Molten']);
        ProductBrand::create(['name' => 'Polo']);
        ProductBrand::create(['name' => 'Alcatroz']);
    }
}
