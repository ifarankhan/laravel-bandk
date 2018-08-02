<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Departments::truncate();

        $data = [
            ['name' => 'department 1', 'code' => 1],
            ['name' => 'department 2', 'code' => 2],
            ['name' => 'department 4', 'code' => 4],
            ['name' => 'department 5', 'code' => 5],
            ['name' => 'department 6', 'code' => 6],
            ['name' => 'department 7', 'code' => 7],
            ['name' => 'department 8', 'code' => 8],
            ['name' => 'department 9', 'code' => 9],
            ['name' => 'department 10', 'code' => 10],
            ['name' => 'department 11', 'code' => 11],
            ['name' => 'department 17', 'code' => 17],
            ['name' => 'department 19', 'code' => 19],
            ['name' => 'department 20', 'code' => 20],
            ['name' => 'department 21', 'code' => 21],
            ['name' => 'department 22', 'code' => 22],
            ['name' => 'department 23', 'code' => 23],
            ['name' => 'department 24', 'code' => 24],
        ];

        \App\Departments::insert($data);
    }
}
