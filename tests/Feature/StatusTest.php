<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    public mixed $status;
    public array $data = ['name' => 'TaskStatusTest'];

    public function setUp(): void
    {
        parent::setUp();

        $this->status = TaskStatus::where('name', 'в работе')->first();
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
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $this->data);
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
        $response = $this->actingAs($this->user)->patch(route('task_statuses.update', $this->status), $this->data);
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
