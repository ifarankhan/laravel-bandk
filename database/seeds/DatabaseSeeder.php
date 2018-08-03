<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AddressesSeeder::class);
         $this->call(ClaimMechanicsSeeder::class);
         $this->call(ClaimTypesSeeder::class);
         $this->call(DepartmentSeeder::class);
         $this->call(RolesSeeder::class);
         $this->call(ModulesSeeder::class);
    }
}
