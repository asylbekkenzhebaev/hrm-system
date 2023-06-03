<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected $user;
    protected $employee;


    /**
     * @group employee_test
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->department = Department::factory()->create();
        $this->position = Position::factory()->create();
        $this->gender = Gender::factory()->create();
        $this->employee = Employee::factory()->create();
    }

    /**
     * for all
     * @group employee_test
     * @return void
     */
    public function testIndex()
    {
        $employee = $this->employee;

        $this->get(route('employees.index'))
            ->assertOk()
            ->assertSee($employee->name);
    }

    /**
     * for an authorized user
     * @group employee_test
     * @return void
     */
    public function testCreateFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);

        $response = $this->get(route('employees.create'));
        $response->assertOK()
            ->assertSeeText('Create a new employee');
    }

    /**
     * for an authorized user
     * @group employee_test
     * @return void
     */
    public function testStoreForAuthUser()
    {
        $user = $this->user;
        $gender = $this->gender;
        $position = $this->position;
        $department = $this->department;
        $this->actingAs($user);

        $employeeData = [
            'fio' => $this->faker->name,
            'birthday' => $this->faker->date,
            'gender_id' => $gender->id,
            'department_id' => $department->id,
            'position_id' => $position->id,
        ];
        $response = $this->post(route('employees.store'), $employeeData);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        unset($employeeData['department_id']);
        unset($employeeData['position_id']);
        $this->assertDatabaseHas('employees', $employeeData);
    }


    /**
     * for an authorized user
     * @group employee_test
     * @return void
     */
    public function testEditFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $employee = $this->employee;
        $response = $this->get(route('employees.edit', $employee));
        $response->assertOk()
            ->assertSeeText('Edit a employee');
    }

    /**
     * for an authorized user
     * @group employee_test
     * @return void
     */
    public function testUpdateForAuthUser()
    {
        $user = $this->user;
        $gender = $this->gender;
        $position = $this->position;
        $department = $this->department;
        $this->actingAs($user);
        $employee = $this->employee;

        $employeeData = [
            'fio' => $this->faker->name,
            'birthday' => $this->faker->date,
            'gender_id' => $gender->id,
            'department_id' => $department->id,
            'position_id' => $position->id,
        ];

        $response = $this->put(
            route('employees.update', ['employee' => $employee]),
            $employeeData
        );

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        unset($employeeData['department_id']);
        unset($employeeData['position_id']);
        $this->assertDatabaseHas('employees', array_merge($employeeData, ['id' => $employee->id]));
    }

    /**
     * for an authorized user
     * @group employee_test
     * @return void
     */
    public function testDestroyForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $employee = $this->employee;

        $this->delete(route('employees.destroy', $employee))
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }

    /**
     * for a guest
     * @group employee_test
     * @return void
     */
    public function testCreateForGuest()
    {
        $response = $this->get(route('employees.create'));
        $response->assertRedirect('/login');
    }

    /**
     * for a guest
     * @group employee_test
     * @return void
     */
    public function testStoreForGuest()
    {
        $data = [
            'fio' => $this->faker->name
        ];
        $response = $this->post(route('employees.store'), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('employees', $data);
    }


    /**
     * for a guest
     * @group employee_test
     * @return void
     */
    public function testEditFormForGuest()
    {
        $employee = $this->employee;
        $response = $this->get(route('employees.edit', $employee));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('employees', ['id' => $employee->id]);
    }

    /**
     * for a guest
     * @group employee_test
     * @return void
     */
    public function testUpdateForGuest()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $employee = $this->employee;
        $response = $this->put(route('employees.update', $employee), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('employees', ['id' => $employee->id]);
    }

    /**
     * for a guest
     * @group employee_test
     * @return void
     */
    public function testDestroyForGuest()
    {
        $employee = $this->employee;
        $response = $this->delete(route('employees.destroy', ['employee' => $employee]));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('employees', ['id' => $employee->id]);
    }
}
