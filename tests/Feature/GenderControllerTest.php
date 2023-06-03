<?php

namespace Tests\Feature;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenderControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected $user;
    protected $gender;


    /**
     * @group gender_test
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->gender = Gender::factory()->create();
    }

    /**
     * for all
     * @group gender_test
     * @return void
     */
    public function testIndex()
    {
        $gender = $this->gender;

        $this->get(route('genders.index'))
            ->assertOk()
            ->assertSee($gender->name);
    }

    /**
     * for an authorized user
     * @group gender_test
     * @return void
     */
    public function testCreateFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);

        $response = $this->get(route('genders.create'));
        $response->assertOK()
            ->assertSeeText('Create a new gender');
    }

    /**
     * for an authorized user
     * @group gender_test
     * @return void
     */
    public function testStoreForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);

        $genderData = [
            'name' => $this->faker->name
        ];
        $response = $this->post(route('genders.store'), $genderData);
        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('genders', $genderData);
    }


    /**
     * for an authorized user
     * @group gender_test
     * @return void
     */
    public function testEditFormForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $gender = $this->gender;
        $response = $this->get(route('genders.edit', $gender));
        $response->assertOk()
            ->assertSeeText('Edit a gender');
    }

    /**
     * for an authorized user
     * @group gender_test
     * @return void
     */
    public function testUpdateForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $gender = $this->gender;

        $genderData = [
            'name' => $this->faker->name
        ];

        $response = $this->put(
            route('genders.update', ['gender' => $gender]),
            $genderData
        );

        $response->assertSessionDoesntHaveErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('genders', array_merge($genderData, ['id' => $gender->id]));
    }

    /**
     * for an authorized user
     * @group gender_test
     * @return void
     */
    public function testDestroyForAuthUser()
    {
        $user = $this->user;
        $this->actingAs($user);
        $gender = $this->gender;

        $this->delete(route('genders.destroy', $gender))
            ->assertRedirect()
            ->assertSessionDoesntHaveErrors();
        $this->assertDatabaseMissing('genders', ['id' => $gender->id]);
    }

    /**
     * for a guest
     * @group gender_test
     * @return void
     */
    public function testCreateForGuest()
    {
        $response = $this->get(route('genders.create'));
        $response->assertRedirect('/login');
    }

    /**
     * for a guest
     * @group gender_test
     * @return void
     */
    public function testStoreForGuest()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $response = $this->post(route('genders.store'), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('genders', $data);
    }


    /**
     * for a guest
     * @group gender_test
     * @return void
     */
    public function testEditFormForGuest()
    {
        $gender = $this->gender;
        $response = $this->get(route('genders.edit', $gender));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('genders', ['id' => $gender->id]);
    }

    /**
     * for a guest
     * @group gender_test
     * @return void
     */
    public function testUpdateForGuest()
    {
        $data = [
            'name' => $this->faker->name
        ];
        $gender = $this->gender;
        $response = $this->put(route('genders.update', $gender), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('genders', ['id' => $gender->id]);
    }

    /**
     * for a guest
     * @group gender_test
     * @return void
     */
    public function testDestroyForGuest()
    {
        $gender = $this->gender;
        $response = $this->delete(route('genders.destroy', ['gender' => $gender]));
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('genders', ['id' => $gender->id]);
    }
}
