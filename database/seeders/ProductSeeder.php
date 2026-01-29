<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usd = Currency::where('symbol', 'USD')->first();
        $ves = Currency::where('symbol', 'VES')->first();
        $ars = Currency::where('symbol', 'ARS')->first();

        $laptop = Product::create([
            'name' => 'Dell XPS 15 Laptop',
            'description' => 'Laptop de alto rendimiento con procesador Intel i7, 16GB RAM y 512GB SSD',
            'price' => 1299.99,
            'currency_id' => $usd->id,
            'tax_cost' => 129.99,
            'manufacturing_cost' => 800.00,
        ]);

        ProductPrice::create([
            'product_id' => $laptop->id,
            'currency_id' => $ves->id,
            'price' => 47450.00,
        ]);

        ProductPrice::create([
            'product_id' => $laptop->id,
            'currency_id' => $ars->id,
            'price' => 1250000.00,
        ]);

        $mouse = Product::create([
            'name' => 'Logitech MX Master 3',
            'description' => 'Mouse inalámbrico avanzado con diseño ergonómico y botones personalizables',
            'price' => 99.99,
            'currency_id' => $usd->id,
            'tax_cost' => 9.99,
            'manufacturing_cost' => 45.00,
        ]);

        ProductPrice::create([
            'product_id' => $mouse->id,
            'currency_id' => $ves->id,
            'price' => 3650.00,
        ]);

        $keyboard = Product::create([
            'name' => 'Mechanical Keyboard RGB',
            'description' => 'Teclado mecánico gaming con retroiluminación RGB y switches Cherry MX',
            'price' => 149.99,
            'currency_id' => $usd->id,
            'tax_cost' => 14.99,
            'manufacturing_cost' => 75.00,
        ]);

        ProductPrice::create([
            'product_id' => $keyboard->id,
            'currency_id' => $ars->id,
            'price' => 145000.00,
        ]);
    }
}
