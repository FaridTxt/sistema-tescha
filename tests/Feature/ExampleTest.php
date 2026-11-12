<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Verifica que la aplicación responde correctamente.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/planeacion/gps-4701');

        $response->assertStatus(200);
    }
}
