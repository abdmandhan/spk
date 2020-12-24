<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use App\Models\UserType;
use App\Models\Weight;
use Faker\Factory;
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

        $weight = [
            [
                'value'    =>  1, 'desc' => 'Kurang Baik',
            ],
            [
                'value'    =>  2, 'desc' => 'Cukup Baik',
            ],
            [
                'value'    =>  3, 'desc' => 'Baik',
            ],
            [
                'value'    =>  4, 'desc' => 'Sangat Baik',
            ]
        ];

        Weight::insert($weight);

        $question = [
            [
                'question'  => 'Cerdas dan Terampil',
            ],
            [
                'question'  => 'Kejujuran',
            ],
            [
                'question'  => 'Pengalaman Organisasi',
            ],
            [
                'question'  => 'Integritas Diri',
            ],
            [
                'question'  => 'Totalitas Diri',
            ]
        ];

        Question::insert($question);

        $user_type = [
            ['name' => 'Pemilih'],
            ['name' => 'Calon'],
        ];

        UserType::insert($user_type);

        $data = [
            [
                'name'      => 'Falyan Zuril',
                'email'     => 'falyan@gmail.com',
                'password'  => Hash::make('12341234'),
                'user_type_id' => 2
            ],
            [
                'name'      => 'Muhamad Lutfi Wildan',
                'email'     => 'lutfi@gmail.com',
                'password'  => Hash::make('12341234'),
                'user_type_id' => 2
            ],

            [
                'name'      => 'Miftah Irfan Basuki',
                'email'     => 'miftah@gmail.com',
                'password'  => Hash::make('12341234'),
                'user_type_id' => 2
            ],

            [
                'name'      => 'User1',
                'email'     => 'user1@gmail.com',
                'password'  => Hash::make('12341234'),
                'user_type_id' => 1
            ],
        ];

        User::insert($data);

        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make('12341234'),
                'user_type_id' => 1
            ]);
        }
    }
}
