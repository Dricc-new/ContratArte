<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Enterprise;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Contract::class;
    
    public function definition()
    {
        $company = Enterprise::inRandomOrder()->first();
        $type = Type::inRandomOrder()->first();
        $date = $this->faker->date();
        return [
            'enterprise_id' => $company->id,
            'number' => $this->faker->numerify('#####'),
            'type_id' => $type->id,
            'start_date' => $date,
            'end_date' => $date,
        ];
    }
}
