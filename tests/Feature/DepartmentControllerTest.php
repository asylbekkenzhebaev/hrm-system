<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected $user;
    protected $department;


    /**
     * @group department_test
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->department = Department::factory()->create();
    }

    /**
     * for all
     * @group department_test
     * @return void
     */
    public function testIndex()
    {
        $department = $this->department;

        $this->get(route('departments.index'))
            ->assertOk()
            ->assertSee($department->name);
    }

    /**
     * for an authorized user
     * @group department_test
     * @return void
     */
    public function testCreateFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);

        $response = $this->get(route('departments.create'));
        $response->assertOK()
            ->assertSeeText('Create a new department');
    }

    /**
     * for an authorized user
     * @group department_test
     * @return void
     */
    public function testStoreForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);

        $departmentData = [
            'name' => $this->faker->name
        ];
        $response = $this->post(route('departments.store'), $departmentData);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('departments', $departmentData);
    }


    /**
     * for an authorized user
     * @group department_test
     * @return void
     */
    public function testEditFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $department = $this->department;
        $response = $this->get(route('departments.edit', $department));
        $response->assertOk()
            ->assertSeeText('Edit a department');
    }

    /**
     * for an authorized user
     * @group department_test
     * @return void
     */
    public function testUpdateForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $department = $this->department;

        $departmentData = [
            'name' => $this->faker->name
        ];

        $response = $this->put(
            route('departments.update', ['department' => $department]),
            $departmentData
        );

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('departments', array_merge($departmentData, ['id' => $department->id]));
    }

    /**
     * for an authorized user
     * @group department_test
     * @return void
     */
    public function testDestroyForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $department = $this->department;

        $this->delete(route('departments.destroy', $department))
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

    /**
     * for a guest
     * @group department_test
     * @return void
     */
    public function testCreateForGuest()
    {
        $response = $this->get(route('departments.create'));
        $response->assertRedirect('/login');
    }

    /**
     * for a guest
     * @group department_test
     * @return void
     */
    public function testStoreForGuest()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $response = $this->post(route('departments.store'), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('departments', $data);
    }


    /**
     * for a guest
     * @group department_test
     * @return void
     */
    public function testEditFormForGuest()
    {
        $department = $this->department;
        $response = $this->get(route('departments.edit', $department));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('departments', ['id' => $department->id]);
    }

    /**
     * for a guest
     * @group department_test
     * @return void
     */
    public function testUpdateForGuest()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $department = $this->department;
        $response = $this->put(route('departments.update', $department), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('departments', ['id' => $department->id]);
    }

    /**
     * for a guest
     * @group department_test
     * @return void
     */
    public function testDestroyForGuest()
    {
        $department = $this->department;
        $response = $this->delete(route('departments.destroy', ['department' => $department]));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('departments', ['id' => $department->id]);
    }
}
