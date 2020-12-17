<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'book_id' => '1',
            'order_id' => '1',
            'quantity' => '2'
        ]);
        Reservation::create([
            'book_id' => '3',
            'order_id' => '1',
            'quantity' => '12'
        ]);
        Reservation::create([
            'book_id' => '2',
            'order_id' => '1',
            'quantity' => '23'
        ]);
        Reservation::create([
            'book_id' => '10',
            'order_id' => '1',
            'quantity' => '221'
        ]);
        Reservation::create([
            'book_id' => '5',
            'order_id' => '1',
            'quantity' => '233'
        ]);
        Reservation::create([
            'book_id' => '4',
            'order_id' => '2',
            'quantity' => '8'
        ]);
        Reservation::create([
            'book_id' => '6',
            'order_id' => '3',
            'quantity' => '30'
        ]);
        Reservation::create([
            'book_id' => '7',
            'order_id' => '4',
            'quantity' => '63'
        ]);
        Reservation::create([
            'book_id' => '31',
            'order_id' => '1',
            'quantity' => '53'
        ]);
        Reservation::create([
            'book_id' => '13',
            'order_id' => '1',
            'quantity' => '4'
        ]);
        Reservation::create([
            'book_id' => '12',
            'order_id' => '1',
            'quantity' => '65'
        ]);
        Reservation::create([
            'book_id' => '11',
            'order_id' => '1',
            'quantity' => '42'
        ]);
        Reservation::create([
            'book_id' => '15',
            'order_id' => '1',
            'quantity' => '253'
        ]);
        Reservation::create([
            'book_id' => '14',
            'order_id' => '2',
            'quantity' => '27'
        ]);
        Reservation::create([
            'book_id' => '16',
            'order_id' => '3',
            'quantity' => '23'
        ]);
        Reservation::create([
            'book_id' => '17',
            'order_id' => '4',
            'quantity' => '23'
        ]);
    }
}
