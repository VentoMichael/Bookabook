<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'surname' => 'Michael',
            'name' => 'Vento',
            'email' => 'vento.michael0705@hotmail.com',
            'password' => Hash::make('a'),
            'file_name'=> 'users/default.svg'
        ]);
        User::factory()->times(3)->create();
    }
}
