<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use TestSeeder;

class ParticipantRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->refreshDatabase();
        $this->seed(TestSeeder::class);
    }

    /**
     * Тест аутентификации
     *
     * @return void
     */
    public function testAuth()
    {
        $response = $this->getJson('/api/participants');
        $response->assertStatus(401);

        $token = 'someToken';
        config(['auth.token' => $token]);
        $response = $this->getJson('/api/participants', ['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);
    }

    /**
     * Тест эндпоинтов
     *
     * @return void
     */
    public function testEndpoints()
    {
        $this->withoutMiddleware();

        $response = $this->getJson('/api/participants');
        $response->assertStatus(200)->assertJsonStructure(['data', 'links' => ['first', 'last', 'prev','next'],
            'meta' => ['current_page', 'from', 'last_page', 'path', 'per_page', 'to', 'total']]);

        $response = $this->getJson('/api/participants/2');
        $response->assertStatus(404);

        $response = $this->getJson('/api/participants/1');
        $response->assertStatus(200)->assertJsonFragment(['id' => 1]);

        $response = $this->postJson('/api/participants', ['firstName' => 'test', 'lastName' => 'test', 'email' => 'test@mail.ru']);
        $response->assertStatus(422);

        $response = $this->postJson('/api/participants', ['firstName' => 'test', 'lastName' => 'test', 'email' => 'test@mail.ru', 'eventId' => 1]);
        $response->assertStatus(200)->assertJson(['status' => 'success', 'data' => null]);

        $response = $this->putJson('/api/participants/2', ['firstName' => 'test1', 'lastName' => 'test1', 'email' => 'test1@mail.ru', 'eventId' => 1]);
        $response->assertStatus(200)->assertJson(['status' => 'success', 'data' => null]);

        $response = $this->deleteJson('/api/participants/2');
        $response->assertStatus(200)->assertJson(['status' => 'success', 'data' => null]);
    }
}
