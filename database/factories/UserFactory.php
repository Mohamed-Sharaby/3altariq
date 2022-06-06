<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            //'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            //'image' => $this->faker->imageUrl(),
            'country_code' => '999',
            //'email_verified_at' => now(),
            'password' => '123456', // password
            'is_active' =>  $this->faker->boolean ,
            'is_confirmed' =>  $this->faker->boolean ,
            'remember_token' => Str::random(10),
        ];
    }
}
