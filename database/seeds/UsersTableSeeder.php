<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@mrent.com',
            'first_name' => 'admin',
            'phone_number' => '0718844836',
            'last_name' => 'mrent',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);
        $user->roles()->attach(Role::where('name', '=', 'admin')->first());
    }
}
