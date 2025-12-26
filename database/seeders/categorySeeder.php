<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'Otomotif',
                'description' => 'Description for Category 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sparepart',
                'description' => 'Description for Category 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
