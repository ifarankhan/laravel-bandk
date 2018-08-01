<?php

use Illuminate\Database\Seeder;

class ClaimMechanicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ClaimMechanics::truncate();

        $data = [
            ['name' => 'Plumber'],
            ['name' => 'Painter'],
        ];

        \App\ClaimMechanics::insert($data);
    }
}
