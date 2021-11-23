<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    public mixed $task;
    public mixed $status;

    public function setUp(): void
    {
        parent::setUp();

        $this->task = Task::factory()->create();
        $this->status = TaskStatus::factory()->create();
    }

    public function testIndex(): void
    {
        $taskName = $this->task->name;
        $response = $this->get(route('tasks.index'));
        $response->assertSee($taskName);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = [
            'name' => $this->faker->name(),
            'status_id' =>  $this->status->id
        ];

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $data = [
            'name' => $this->faker->name(),
            'status_id' =>  $this->status->id
        ];

        $response = $this->actingAs($this->user)->patch(route('tasks.update', $this->task), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroy(): void
    {
        $taskName = $this->task->name;

        $response = $this->delete(route('tasks.destroy', $this->task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', ['name' => $taskName]);
    }
}
