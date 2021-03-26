<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ReceptionistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(5),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar'=>$this->faker->url,
            'remember_token' => Str::random(10),   
            'mobile' => $this->faker->phoneNumber,
            'approved' => $this->faker->boolean,
            'country' => $this->faker->sentence(5),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'approved' => $this->faker->boolean,
        ];
    }
}
