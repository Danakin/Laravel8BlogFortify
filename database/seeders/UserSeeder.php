<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
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
        //
        User::create([
            'name' => 'Danny Festor',
            'email' => 'danny@festor.info',
            'password' => Hash::make("12345678"),
        ]);

        User::factory()
            ->times(2)
            ->create();
    }
}
