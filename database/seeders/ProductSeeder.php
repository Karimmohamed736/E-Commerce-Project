<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name'=>'Product one',
            'desc'=>'This is Product one',
            'price'=>2000,
            'quantity'=>3
        ]);
            Product::create([
            'name'=>'Product two',
            'desc'=>'This is Product two',
            'price'=>3000,
            'quantity'=>5
        ]);
    }
}
