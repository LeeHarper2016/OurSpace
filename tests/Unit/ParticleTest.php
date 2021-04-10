<?php

namespace Tests\Unit;

use App\Models\Space;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticleTest extends TestCase {

    use RefreshDatabase;

    protected $seed = true;

    /*******************************************************************
     *
     * Test: user post particle success.
     * Purpose: Tests if a user that has joined the space can post a
     *          particle.
     *
     ******************************************************************/
    public function test_user_post_particle_success() {
        $user = User::find(1);
        $space = Space::find(1);

        $response = $this->actingAs($user)
            ->post('/spaces/' . $space->id . '/particles', ['body' => 'test']);

        $response->assertStatus(201);
    }

    /*******************************************************************
     *
     * Test: user post particle fail.
     * Purpose: Tests if a user that has not joined the space can post a
     *          particle.
     *
     ******************************************************************/
    public function test_user_post_particle_failure() {
        $user = User::find(1);
        $space = Space::find(3);

        $response = $this->actingAs($user)
            ->post('/spaces/' . $space->id . '/particles', ['body' => 'test']);

        $response->assertStatus(401);
    }
}
