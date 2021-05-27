<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'client_id' => 1,
                'order_status_id' => 1,
                'address' => 'Bravo 209, Zona Centro, 64700, Monterrey, Nuevo León',
                'description' => 'Empaquetado regular',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
            [
                'client_id' => 1,
                'order_status_id' => 1,
                'address' => 'Revolución 401, Del Paeo, 64760, Monterrey, Nuevo León',
                'description' => 'Empaquetado regular',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
            [
                'client_id' => 2,
                'order_status_id' => 1,
                'address' => 'Cotopaxi 622, Tecnológico, 65890, Monterrey, Nuevo León',
                'description' => 'Empaquetado con moño rosa',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ],
        ]);
    }
}
