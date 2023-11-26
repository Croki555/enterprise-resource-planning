<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insertOrIgnore([
            [
                'article' => 'mtokb2',
                'name' => 'MTOK-B2/216-1KT3645-K',
                'status' => 'available',
                'data' => '[
                        {"title": "Цвет", "value":"черный"},
                        {"title": "Размер", "value":"L"}
                ]',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'article' => 'mtokb3',
                'name' => 'MTOK-B3/216-1KT3645-K',
                'status' => 'unavailable',
                'data' => '[
                        {"title": "Цвет", "value":"серый"},
                        {"title": "Размер", "value":"XL"}
                ]',
                'created_at'=> now(),
                'updated_at'=> now()
            ]
        ]);
    }
}
