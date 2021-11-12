<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public mixed $status;
    public array $data = ['name' => 'TaskStatusTest'];

    public function setUp(): void
    {
        parent::setUp();

        $this->status = TaskStatus::where('name', 'в работе')->first();
    }

    public function testHome(): void
    {
        $response = $this->get(route('welcome'));
        $response->assertOk();
    }


}
