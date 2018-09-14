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
                'name' => 'CLAIM_FORM',
                'text' => 'Skadeanmeldelse'
            ],
            [
                'name' => 'INFO_APP',
                'text' => 'Beredskabsplan'
            ],
            [
                'name' => 'OWN_COMPANY_CLAIMS',
                'text' => 'Skadeanmeldelse og Beredskabsplan'
            ],
        ];

        \App\Modules::insert($data);
    }
}
