<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        $records = [
            [
                'creator_id' => 1,
                'updator_id' => 1,
                'name' => 'Product 001',
                'price' => 10,
                'status' => Product::STATUS_ACTIVE,
                'type' => Product::TYPE_PRODUCT,
            ],
            [
                'creator_id' => 1,
                'updator_id' => 1,
                'name' => 'Product 002',
                'price' => 20,
                'status' => Product::STATUS_ACTIVE,
                'type' => Product::TYPE_PRODUCT,
            ],
            [
                'creator_id' => 1,
                'updator_id' => 1,
                'name' => 'Service 001',
                'price' => 200,
                'status' => Product::STATUS_INACTIVE,
                'type' => Product::TYPE_SERVICE,
            ],
            [
                'creator_id' => 1,
                'updator_id' => 1,
                'name' => 'Service 002',
                'price' => 100,
                'status' => Product::STATUS_ACTIVE,
                'type' => Product::TYPE_SERVICE,
            ]
        ];

        DB::table('products')->insert($records);


    }
}
