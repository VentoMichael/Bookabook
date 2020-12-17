<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->firstName),
            'email' => $this->faker->unique()->safeEmail,
            'surname' => ucfirst($this->faker->lastName),
            'group' => $this->faker->randomElement($array = array ('2181','2281','2381','2182','2282','2382','2183','2283','2383')),
            'bank_account'=> $this->faker->bankAccountNumber(),
            'file_name' => 'users/default.svg',
        'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
