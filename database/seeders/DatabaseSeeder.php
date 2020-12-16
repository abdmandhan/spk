<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class
        ]);

        // \App\Models\User::factory(10)->create();
        $data = [
            'name'      => 'Falyan Zuril',
            'email'     => 'falyan@gmail.com',
            'password'  => Hash::make('12341234'),

        ];

        $user = User::create($data);
        $user->assignRole(['admin']);
    }
}
