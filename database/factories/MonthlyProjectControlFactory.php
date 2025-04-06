<?php declare(strict_types = 1);

namespace Database\Factories;

use App\Project\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Project\Models\MonthlyProjectControl>
 */
class MonthlyProjectControlFactory extends Factory
{
    protected $model = \App\Project\Models\MonthlyProjectControl::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'month'       => $this->faker->numberBetween(1, 12),
            'year'        => $this->faker->year,
            'hourly_rate' => $this->faker->randomNumber(5),
            'project_id'  => Project::find($this->faker->numberBetween(1, 5)),
        ];
    }
}
