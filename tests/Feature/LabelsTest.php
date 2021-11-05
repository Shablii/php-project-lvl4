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

    /**
     * @var
     */
    public Label $label;
    public array $data;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->post(route('login'), ['email' => 'test@mail.user', 'password' => 'testPass']);

        $this->label = Label::where('name', 'newLabel')->first();

        $this->data = ['name' => 'testLabels'];
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertSee(Label::first()->name);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $response = $this->post(route('labels.store'), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $response = $this->patch(route('labels.update', $this->label), $this->data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testDestroy(): void
    {
        $response = $this->delete(route('labels.destroy', $this->label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', $this->data);
    }
}
