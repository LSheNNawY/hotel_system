<?php

namespace Database\Factories;

use App\Models\Floor;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'capacity'  => $this->faker->randomElement([2, 4, 6]),
            'price'     => $this->faker->numberBetween(600, 1200),
            'available' => $this->faker->boolean,
            'created_by'=> function() {
                return User::inRandomOrder()->first()->id;
            },
            'floor_id'  => function() {
                return Floor::inRandomOrder()->first()->id;
            },
            'created_at'=> now()
        ];
    }
}
