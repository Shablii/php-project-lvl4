<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    public $task;
    public array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->post(route('login'), ['email'=> 'test@mail.user', 'password' => 'testPass']);

        $this->task = Task::where('name', 'newTask')->first();

        $this->data = [
            'name' => 'testTask',
            'status_id' => TaskStatus::first()->id
        ];
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertSee(Task::first()->name);
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->post(route('tasks.store'), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testEdit()
    {
        $response = $this->get(route('tasks.edit', $this->task));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $response = $this->patch(route('tasks.update', $this->task), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('tasks.destroy', $this->task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('tasks', $this->data);
    }
}