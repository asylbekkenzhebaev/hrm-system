<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PositionControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected $user;
    protected $position;
    protected $department;


    /**
     * @group position_test
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->department = Department::factory()->create();
        $this->position = Position::factory()->create();
    }

    /**
     * for all
     * @group position_test
     * @return void
     */
    public function testIndex()
    {
        $position = $this->position;

        $this->get(route('positions.index'))
            ->assertOk()
            ->assertSee($position->name);
    }

    /**
     * for an authorized user
     * @group position_test
     * @return void
     */
    public function testCreateFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);

        $response = $this->get(route('positions.create'));
        $response->assertOK()
            ->assertSeeText('Create a new position');
    }

    /**
     * for an authorized user
     * @group position_test
     * @return void
     */
    public function testStoreForAuthUser()
    {
        $user = $this->user;
        $department = $this->department;
        $this->actingAs($user);

        $positionData = [
            'name' => $this->faker->name,
            'department_id' => $department->id
        ];
        $response = $this->post(route('positions.store'), $positionData);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('positions', $positionData);
    }


    /**
     * for an authorized user
     * @group position_test
     * @return void
     */
    public function testEditFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $position = $this->position;
        $response = $this->get(route('positions.edit', $position));
        $response->assertOk()
            ->assertSeeText('Edit a position');
    }

    /**
     * for an authorized user
     * @group position_test
     * @return void
     */
    public function testUpdateForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $position = $this->position;

        $positionData = [
            'name' => $this->faker->name
        ];

        $response = $this->put(
            route('positions.update', ['position' => $position]),
            $positionData
        );

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('positions', array_merge($positionData, ['id' => $position->id]));
    }

    /**
     * for an authorized user
     * @group position_test
     * @return void
     */
    public function testDestroyForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $position = $this->position;

        $this->delete(route('positions.destroy', $position))
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();
        $this->assertDatabaseMissing('positions', ['id' => $position->id]);
    }

    /**
     * for a guest
     * @group position_test
     * @return void
     */
    public function testCreateForGuest()
    {
        $response = $this->get(route('positions.create'));
        $response->assertRedirect('/login');
    }

    /**
     * for a guest
     * @group position_test
     * @return void
     */
    public function testStoreForGuest()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $response = $this->post(route('positions.store'), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('positions', $data);
    }


    /**
     * for a guest
     * @group position_test
     * @return void
     */
    public function testEditFormForGuest()
    {
        $position = $this->position;
        $response = $this->get(route('positions.edit', $position));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('positions', ['id' => $position->id]);
    }

    /**
     * for a guest
     * @group position_test
     * @return void
     */
    public function testUpdateForGuest()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $position = $this->position;
        $response = $this->put(route('positions.update', $position), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('positions', ['id' => $position->id]);
    }

    /**
     * for a guest
     * @group position_test
     * @return void
     */
    public function testDestroyForGuest()
    {
        $position = $this->position;
        $response = $this->delete(route('positions.destroy', ['position' => $position]));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('positions', ['id' => $position->id]);
    }
}
