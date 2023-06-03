<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Position::factory()->count(5)->create();

        $positions = [
            [
                'department_id' => 1,
                'name' => 'фин. директор'
            ],
            [
                'department_id' => 1,
                'name' => 'глав. бухгалтер'
            ],
            [
                'department_id' => 1,
                'name' => 'кассир'
            ],
            [
                'department_id' => 1,
                'name' => 'кассир'
            ],
            [
                'department_id' => 2,
                'name' => 'исполнитель менеджер'
            ],
            [
                'department_id' => 2,
                'name' => 'управляющий менеджер'
            ],
            [
                'department_id' => 2,
                'name' => 'офис менеджер'
            ],
            [
                'department_id' => 3,
                'name' => 'веб программист'
            ],
            [
                'department_id' => 3,
                'name' => 'веб программист'
            ],
            [
                'department_id' => 3,
                'name' => 'системный администратор'
            ],
            [
                'department_id' => 3,
                'name' => 'системный администратор'
            ],
            [
                'department_id' => 4,
                'name' => 'руководитель'
            ],
            [
                'department_id' => 4,
                'name' => 'охранник'
            ],
            [
                'department_id' => 4,
                'name' => 'охранник'
            ]
        ];

        foreach ($positions as $position) {
            \App\Models\Position::factory()->create([
                'department_id' => $position['department_id'],
                'name' => $position['name'],
            ]);
        }

    }
}
