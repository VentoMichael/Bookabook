<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *w
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'ordered', 'file_name' => 'ordered.svg']);
        Status::create(['name' => 'paid', 'file_name' => 'paid.svg']);
        Status::create(['name' => 'available', 'file_name' => 'available.svg']);
        Status::create(['name' => 'delivered', 'file_name' => 'delivered.svg']);
    }
}
