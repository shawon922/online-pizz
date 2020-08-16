<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $usdToEurExchangeRate = config('global.usd_to_eur_rate');

        factory(App\Models\Product::class, 20)->create()
            ->each(function ($product) use ($usdToEurExchangeRate) {
                $product->setCurrency($product->unit_price, 'USD');
                $product->setCurrency($product->unit_price * $usdToEurExchangeRate, 'EUR');
            });
        // $this->call(UserSeeder::class);
    }
}
