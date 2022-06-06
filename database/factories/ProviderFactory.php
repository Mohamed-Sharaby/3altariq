<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'country_code' =>02,
            'phone' => $this->faker->phoneNumber(),
            'password' => 123456,
            'image'=>'placeholder/400.jpeg',
            'country_id' => 1,
            'is_confirmed' => 1
        ];
    }
}
