<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::create([
            'book_id' => 1,
            'public-price' => 20,
            'price' => 10,
        ]);
        Sale::create([
            'book_id' => 2,
            'public-price' => 20,
            'price' => 10,
        ]);
        Sale::create([
            'book_id' => 3,
            'public-price' => 20,
            'price' => 10,
        ]);
    }
}
