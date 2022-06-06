<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ar_name' => $this->faker->name(),
            'en_name'=>$this->faker->name(),
            'ar_description' =>   $this->faker->text(),
            'en_description' => $this->faker->text(),
            'image' => 'placeholders/400.jpeg'
        ];
    }
}
