<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);

        $user = User::create([
            'name' => 'elAdmin',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            'birthdate'=> '06-06-1665',
            'isGold' => false,
        ]);
        $user->attachRole('administrator');
        event(new Registered($user));

    }
}
