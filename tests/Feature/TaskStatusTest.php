<?php

namespace Tests\Feature;

use App\Http\Requests\StoreStatusRequest;
use App\Models\TaskStatus;
use Database\Seeders\TaskStatusTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;
    //public int $id;
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $data = TaskStatus::first();
        $response->assertSee($data->name);
    }

    public function testCreate()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $this->post(route('login'), ['email'=> 'test@mail.user', 'password' => 'testPass']);

        $data = ['name' => 'test'];

        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testEdit()
    {
        $status = TaskStatus::where('name', 'новый')->first();
        $response = $this->get(route('task_statuses.edit', $status));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $this->post(route('login'), ['email'=> 'test@mail.user', 'password' => 'testPass']);

        $data = ['name' => 'NewTest'];
        $status = TaskStatus::where('name', 'новый')->first();

        $response = $this->patch(route('task_statuses.update', $status), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $this->post(route('login'), ['email'=> 'test@mail.user', 'password' => 'testPass']);

        $status = TaskStatus::where('name', 'новый')->first();

        $response = $this->delete(route('task_statuses.destroy', $status));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('task_statuses', ['name' => 'новый']);
    }
}
