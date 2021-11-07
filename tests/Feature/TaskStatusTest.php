<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public mixed $status;
    public mixed $data = ['name' => 'TaskStatusTest'];

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->post(route('login'), ['email' => 'test@mail.user', 'password' => 'testPass']);

        $this->status = TaskStatus::where('name', 'в работе')->first();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertSee(TaskStatus::first()->name);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->post(route('task_statuses.store'), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('task_statuses.edit', $this->status));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this->patch(route('task_statuses.update', $this->status), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function testDestroy(): void
    {
        $response = $this->delete(route('task_statuses.destroy', $this->status));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', ['name' => 'в работе']);
    }
}
