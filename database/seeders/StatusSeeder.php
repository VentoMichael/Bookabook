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
        Status::create(['name' => 'ordered', 'nameFr' => 'Commandé', 'file_name' => 'ordered.svg']);
        Status::create(['name' => 'paid', 'nameFr' => 'Payé', 'file_name' => 'paid.svg']);
        Status::create(['name' => 'available', 'nameFr' => 'Disponible', 'file_name' => 'available.svg']);
        Status::create(['name' => 'delivered', 'nameFr' => 'Delivré', 'file_name' => 'delivered.svg']);
    }
}
