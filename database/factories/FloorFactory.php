<?php

namespace Database\Factories;

use App\Models\Floor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FloorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Floor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'          => $this->faker->word,
            'created_by'    => function() {
                return User::inRandomOrder()->first()->id;
            },
            'created_at' => now()
        ];
    }
}
