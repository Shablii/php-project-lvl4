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
    public mixed $data;
    public mixed $stustus;

    public function setUp(): void
    {
        parent::setUp();

        $this->task = Task::where('name', 'newTask')->first();
        $this->stustus = TaskStatus::first();

        $this->data = [
            'name' => 'testTask',
            'status_id' =>  $this->stustus->id
        ];
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
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this->actingAs($this->user)->patch(route('tasks.update', $this->task), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->data);
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
