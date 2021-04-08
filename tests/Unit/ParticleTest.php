<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ParticleTest extends TestCase
{
    /*******************************************************************
     *
     * Test: user post particle success.
     * Purpose: Tests if a user that has joined the space can post a
     *          particle.
     *
     * TODO: Implement factories for self-contained testing.
     *
     ******************************************************************/
    public function test_user_post_particle_success() {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post('/spaces/1/particles', ['body' => 'test']);

        $response->assertStatus(201);
    }

    /*******************************************************************
     *
     * Test: user post particle fail.
     * Purpose: Tests if a user that has not joined the space can post a
     *          particle.
     *
     * TODO: Implement factories for self-contained testing.
     *
     ******************************************************************/
    public function test_user_post_particle_failure() {
        $user = User::find(3);

        $response = $this->actingAs($user)
            ->post('/spaces/1/particles', ['body' => 'test']);

        $response->assertStatus(401);
    }
}
