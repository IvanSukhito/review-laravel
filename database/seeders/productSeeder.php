<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // random data seeder for products table
        // \App\Models\Product::factory()->count(10)->create();
        DB::table('products')->insert([
            [
                'name' => 'Oli Gardan',
                'price' => 10000,
                'code_product' => '11OL',
                'stock' => 200,
                'description' => 'Description for Product 1',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ban Motor',
                'price' => 20000,
                'code_product' => '11AN',
                'stock' => 100,
                'category_id' => 2,
                'description' => 'Description for Product 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aki Kering',
                'price' => 30000,
                'category_id' => 1,
                'code_product' => 'AK20',
                'stock' => 500,
                'description' => 'Description for Product 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
