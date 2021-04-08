<?php

namespace Tests\Unit;

use Tests\TestCase;

class ParticleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_basic_request() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
