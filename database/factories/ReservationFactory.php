<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' =>$this->faker->numberBetween(0,50),
            'order_id' =>$this->faker->numberBetween(0,4),
            'quantity' => $this->faker->numberBetween(0,10)
        ];
    }
}
