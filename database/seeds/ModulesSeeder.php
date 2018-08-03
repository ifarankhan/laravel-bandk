<?php

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Modules::truncate();

        $data = [
            [
                'name' => 'CLAIM_FORM'
            ],
            [
                'name' => 'INFO_APP'
            ],
            [
                'name' => 'MANAGER'
            ],
        ];

        \App\Modules::insert($data);
    }
}
