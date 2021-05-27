<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            DepositsTableSeeder::class,
            UnitsTableSeeder::class,
            ProductsTableSeeder::class,
            InventoriesTableSeeder::class,
            OrderStatusesTableSeeder::class,
            ClientsTableSeeder::class,
            OrdersTableSeeder::class,
            OrderProductsTableSeeder::class,
        ]);
    }
}
