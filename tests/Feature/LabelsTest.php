<?php

namespace Tests\Feature;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelsTest extends TestCase
{
    use RefreshDatabase;

    public mixed $label;

    public function setUp(): void
    {
        parent::setUp();

        $this->label = Label::factory()->create();
    }

    public function testIndex(): void
    {
        $labelName = $this->label->name;
        $response = $this->get(route('labels.index'));
        $response->assertSee($labelName);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = ['name' => $this->faker->name()];
        $response = $this->actingAs($this->user)->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit(): void
    {
        $response = $this->get(route('labels.edit', $this->label));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $data = ['name' => $this->faker->name()];
        $response = $this->actingAs($this->user)->patch(route('labels.update', $this->label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy(): void
    {
        $labelName = $this->label->name;
        $response = $this->delete(route('labels.destroy', $this->label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', ['name' => $labelName]);
    }
}
