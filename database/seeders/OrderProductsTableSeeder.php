<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_products')->insert([
            [
                'product_id' => 1,
                'order_id' => 1,
            ],
            [
                'product_id' => 2,
                'order_id' => 1,
            ],
            [
                'product_id' => 2,
                'order_id' => 2,
            ],
            [
                'product_id' => 1,
                'order_id' => 3,
            ]
        ]);
    }
}
