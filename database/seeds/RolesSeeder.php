<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Roles::truncate();

        $data = [
            [
                'name' => 'ADMIN'
            ],
            [
                'name' => 'MANAGER'
            ],
            [
                'name' => 'AGENT'
            ],
        ];

        \App\Roles::insert($data);
    }
}
