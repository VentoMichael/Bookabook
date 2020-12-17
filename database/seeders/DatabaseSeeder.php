<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(StatusChangeSeeder::class);

    }
}
