<?php

namespace Database\Seeders;

use App\Models\Space;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Space::factory(10)
            ->create();
    }
}
