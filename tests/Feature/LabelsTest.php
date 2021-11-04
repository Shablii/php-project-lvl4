<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelsTest extends TestCase
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

        $this->data = ['name' => 'testLabels'];
    }

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertSee(Label::first()->name);
    }

    public function testCreate()
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $response = $this->post(route('labels.store'), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testEdit()
    {
        $response = $this->get(route('labels.edit', $this->task));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $response = $this->patch(route('labels.update', $this->task), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('labels.destroy', $this->task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', $this->data);
    }
}