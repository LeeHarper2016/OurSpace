<?php

namespace Database\Factories;

use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Space::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->catchPhrase,
            'description' => $this->faker->realText(200, 2),
            'owner_id' => User::factory()->create()->id,
            'icon_picture_path' => $this->faker->imageUrl(),
            'banner_picture_path' => $this->faker->imageUrl()
        ];
    }

    /*******************************************************************************
     * Function: SpaceFactory.configure().
     * Purpose: Configures the Space model factory, mainly attaching the owner as
     *          a user of the space.
     *
     * @return SpaceFactory The configured SpaceFactory object.
     *
     ******************************************************************************/
    public function configure() {
        return $this->afterCreating(function (Space $space) {
            $space->users()->attach($space->owner->id);
        });
    }
}
