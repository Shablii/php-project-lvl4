<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public mixed $status;

    public function setUp(): void
    {
        parent::setUp();

        $this->status = TaskStatus::factory()->create();
    }

    public function testIndex(): void
    {
        $statusName = $this->status->name;
        $response = $this->get(route('task_statuses.index'));
        $response->assertSee($statusName);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = ['name' => $this->faker->name()];
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('task_statuses.edit', $this->status));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $data = ['name' => $this->faker->name()];
        $response = $this->actingAs($this->user)->patch(route('task_statuses.update', $this->status), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy(): void
    {
        $name = $this->status->name;
        $response = $this->delete(route('task_statuses.destroy', $this->status));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', ['name' => $name]);
    }
}
