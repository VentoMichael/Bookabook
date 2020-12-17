<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'vento.michael0705@hotmail.com')->first();
        $roleId = Role::where('name', 'administrator')
            ->first()
            ->id;
        $user->roles()->attach($roleId);

        $otherUsers = User::where('email', '!=', 'vento.michael0705@hotmail.com')
            ->get();

        foreach ($otherUsers as $user) {
            $user->roles()
                ->attach(Role::where('name', 'student')
                    ->first()
                    ->id);
        }
    }
}
