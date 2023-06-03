<?php

namespace Database\Factories;

use App\Models\Deparment;
use App\Models\Department;
use App\Models\Gender;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fio' => fake()->unique()->name(),
            'birthday' => fake()->date(),
            'gender_id' => Gender::all()->random()
        ];
    }
}
