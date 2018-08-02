<?php

use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Addresses::truncate();

        $data = [
            [
                'name' => 'Lundvej 24',
                'department_id' => 1,
                'child' => [
                    'A',
                    'B',
                    'C',
                ],
            ],
            [
                'name' => 'Aavangen',
                'department_id' => 1,
                'child' => [
                    '1',
                    '2',
                    '3',
                    '4',
                    '5',
                ],
            ],
            [
                'name' => 'Østergade',
                'department_id' => 2,
                'child' => [
                    '8',
                    '9',
                    '10',
                ],
            ],
            [
                'name' => 'Vestre Landevej',
                'department_id' => 4,
                'child' => [
                    '2',
                    '3',
                    '4',
                ],
            ],
            [
                'name' => 'Ortenvej',
                'department_id' => 4,
                'child' => [
                    '1A',
                    '1B',
                    '1C',
                    '1D',
                ],
            ],
            [
                'name' => 'Ringkøbingvej',
                'department_id' => 5,
                'child' => [
                    '12',
                    '13',
                    '14',
                    '15',
                    '16',
                    '17',
                    '18',
                ],
            ],
            [
                'name' => 'Pramstedvej',
                'department_id' => 6,
                'child' => [
                    '7',
                    '8',
                    '9',
                    '10',
                    '11'
                ],
            ],
            [
                'name' => 'K. Kristoffersvej',
                'department_id' => 6,
                'child' => [
                    '1',
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7',
                    '8',
                    '9',
                    '10',
                ],
            ],
            [
                'name' => 'Dr. Margrethes Vej',
                'department_id' => 6,
                'child' => [
                    '10',
                ],
            ],
            [
                'name' => 'Abildvej',
                'department_id' => 7,
                'child' => [
                    '20',
                    '21',
                    '22',
                    '23',
                    '24',
                    '25',
                    '26',
                    '27',
                    '28',
                    '29',
                    '30',
                    '31',
                    '32',
                ],
            ],
            [
                'name' => 'Skolebakken',
                'department_id' => 7,
                'child' => [
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7',
                    '8',
                    '9',
                    '10',
                    '11',
                    '12',
                    '13',
                    '14',
                    '15',
                    '16',
                    '17',
                    '18',
                    '19',
                    '20',
                ],
            ],
            [
                'name' => 'Skansen',
                'department_id' => 8,
                'child' => [
                    '6',
                    '7',
                    '8',
                    '9',
                    '10',
                ],
            ],
            [
                'name' => 'Østergade',
                'department_id' => 8,
                'child' => [
                    '6',
                ],
            ],
            [
                'name' => 'Aavangen',
                'department_id' => 9,
                'child' => [
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7',
                    '8',
                    '9',
                    '10',
                    '11',
                    '12',
                    '13',
                    '14',
                    '15',
                    '16',
                    '17',
                    '18',
                    '19',
                    '20',
                ],
            ],

        ];

        foreach ($data as $address) {
            $addressObj = new \App\Addresses();
            $addressObj->address = $address['name'];
            $addressObj->department_id = $address['department_id'];
            $addressObj->postal_no = '6800';
            $addressObj->save();

            foreach ($address['child'] as $child) {
                $subAddressObj = new \App\Addresses();
                $subAddressObj->address = $child;
                $subAddressObj->postal_no = '6800';
                $subAddressObj->parent_id = $addressObj->id;
                $subAddressObj->save();
            }
        }
    }
}
