<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence($nbWords = 3, $variableNbWords = true),
            'picture' => 'books/bookOrange.svg',
            'author' => $this->faker->name(),
            'orientation' => $this->faker->randomElement($array = array ('Web','2D','3D')),
            'academic_years' => $this->faker->randomElement($array = array ('1','2','3')),
            'publishing_house' => $this->faker->company(),
            'isbn' => $this->faker->isbn10('-'),
            'public_price' => $this->faker->biasedNumberBetween($min = 10, $max = 20, $function = 'sqrt'),
            'proposed_price' => $this->faker->numberBetween(4.99,9.99),
            'presentation'=> $this->faker->text(),
            'stock'=> $this->faker->numberBetween(1,100),
        ];
    }
}
