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
            ['name' => 'department', 'code' => 1],
            ['name' => 'department', 'code' => 2],
            ['name' => 'department', 'code' => 4],
            ['name' => 'department', 'code' => 5],
            ['name' => 'department', 'code' => 6],
            ['name' => 'department', 'code' => 7],
            ['name' => 'department', 'code' => 8],
            ['name' => 'department', 'code' => 9],
            ['name' => 'department', 'code' => 10],
            ['name' => 'department', 'code' => 11],
            ['name' => 'department', 'code' => 17],
            ['name' => 'department', 'code' => 19],
            ['name' => 'department', 'code' => 20],
            ['name' => 'department', 'code' => 21],
            ['name' => 'department', 'code' => 22],
            ['name' => 'department', 'code' => 23],
            ['name' => 'department', 'code' => 24],
        ];

        \App\Departments::insert($data);
    }
}
