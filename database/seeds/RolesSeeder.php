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
                'name' => 'CAN_ACCESS_CLAIM_FORM'
            ],
            [
                'name' => 'CAN_ACCESS_INFO_PAGE'
            ],
            [
                'name' => 'CAN_MANAGE_DEPARTMENT_CLAIMS'
            ],
            [
                'name' => 'ADMIN'
            ],
        ];

        \App\Roles::insert($data);
    }
}
