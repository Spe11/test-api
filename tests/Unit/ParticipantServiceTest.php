<?php

namespace Tests\Feature;

use App\Services\ParticipantService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use TestSeeder;

class ParticipantServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->refreshDatabase();
        $this->seed(TestSeeder::class);
    }

    /**
     * Тест поиска
     *
     * @return void
     */
    public function testSearch()
    {
        $request = new Request(['page' => 1, 'eventId' => 1]);

        $service = new ParticipantService;
        $result = $service->search($request);

        $this->assertEquals(count($result->items()), 1);

        $request = new Request(['page' => 1, 'eventId' => 10]);

        $service = new ParticipantService;
        $result = $service->search($request);

        $this->assertEquals(count($result->items()), 0);
    }
}
