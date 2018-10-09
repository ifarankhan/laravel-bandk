<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@bnk.com',
                'department_id' => NULL,
                'password' => bcrypt('123456')
            ]

        ];


        \App\Roles::insert($data);
    }
}
