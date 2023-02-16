<?php

namespace Database\Factories;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enterprise>
 */
class EnterpriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Enterprise::class;
    
    public function definition()
    {
        return [
            'reeup' => $this->faker->unique()->numerify('###.#.#####'),
            'name' => ucwords($this->faker->words(nb:5,asText:true)),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
