<?php

use Illuminate\Database\Seeder;

class ClaimTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ClaimTypes::truncate();

        $data = [
            ['name' => 'Brand'],
            ['name' => 'Vandskade'],
            ['name' => 'Kortslutning/lynnedslag'],
            ['name' => 'Storm'],
            ['name' => 'Indbrud'],
            ['name' => 'Svamp/insekt'],
            ['name' => 'Påkørsel'],
            ['name' => 'Glas/Sanitet'],
            ['name' => 'Stikledning'],
            ['name' => 'Rørskade'],
        ];

        \App\ClaimTypes::insert($data);
    }
}
