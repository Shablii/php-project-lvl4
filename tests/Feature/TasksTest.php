<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    public Task $task;
    public array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->post(route('login'), ['email' => 'test@mail.user', 'password' => 'testPass']);

        //$task = Task::where('name', 'newTask')->first();
        $task = new Task();

        /** @var TaskStatus */
        $statusId = TaskStatus::first()->id;

        /** @var Task */
        $this->task = $task->where('name', 'newTask')->first();

        $this->data = [
            'name' => 'testTask',
            'status_id' => $statusId
        ];
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertSee(Task::first()->name);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->post(route('tasks.store'), $this->data);
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
        $response = $this->patch(route('tasks.update', $this->task), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testDestroy(): void
    {
        $response = $this->delete(route('tasks.destroy', $this->task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', $this->data);
    }
}
