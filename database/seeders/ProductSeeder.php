<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 9; $i++) {
            $price = mt_rand(5, 59) + 0.99;

            DB::table('products')->insert([
                'title' => 'Produit ' . $i,
                'description' => 'Un super produit',
                'price' => $price
            ]);
        }
    }
}
