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
        if (User::where('email', 'test@mail.user')->first() == null) {
            User::create([
                'name' => 'testUser',
                'email'=> 'test@mail.user',
                'password' => Hash::make('testPass'),
            ]);
        }

    }
}
