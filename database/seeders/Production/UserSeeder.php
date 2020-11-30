<?php

namespace Database\Seeders\Production;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'cartoon.cloudware@gmail.com',
            'banned' => false,
            'email_verified_at' => null,
            'password' => Hash::make(env('TEMP_ADMIN_PASS'))
        ])->assignRole(User::ROLE_SUPER_ADMIN);

        event(new Registered($user));
    }
}
