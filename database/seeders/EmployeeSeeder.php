<?php

namespace Database\Seeders;

use App\Models\Deparment;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Employee::factory()->count(5)->create();
        $employees = [
            [
                'fio' => 'Эрлан Колбаев',
                'birthday' => fake()->date(),
                'gender_id' => 1
            ],
            [
                'fio' => 'Артем Марченко',
                'birthday' => fake()->date(),
                'gender_id' => 1
            ],
            [
                'fio' => 'Саидбек Халиков',
                'birthday' => fake()->date(),
                'gender_id' => 1
            ],
            [
                'fio' => 'Алина Бактыбек кызы',
                'birthday' => fake()->date(),
                'gender_id' => 2
            ],
            [
                'fio' => 'Бермет Салиева',
                'birthday' => fake()->date(),
                'gender_id' => 2
            ],
            [
                'fio' => 'Дарья Зинина',
                'birthday' => fake()->date(),
                'gender_id' => 2
            ],
            [
                'fio' => 'Манас Маматисаев',
                'birthday' => fake()->date(),
                'gender_id' => 2
            ]
        ];


        foreach ($employees as $item) {
            $employee = \App\Models\Employee::factory()->create([
                'fio' => $item['fio'],
                'birthday' => $item['birthday'],
                'gender_id' => $item['gender_id'],
            ]);
            Position::whereNUll('employee_id')->inRandomOrder()->limit(1)->update(['employee_id' => $employee->id]);
        }
    }
}
