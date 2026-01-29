<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'name' => 'US Dollar',
                'symbol' => 'USD',
                'exchange_rate' => 1.0000,
            ],
            [
                'name' => 'Venezuelan Bolívar',
                'symbol' => 'VES',
                'exchange_rate' => 36.5000,
            ],
            [
                'name' => 'Argentine Peso',
                'symbol' => 'ARS',
                'exchange_rate' => 950.0000,
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
