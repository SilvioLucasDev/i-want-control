<?php declare(strict_types = 1);

namespace Database\Factories;

use App\Expense\Models\Project;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Expense\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type'        => $this->faker->randomElement(['Wakami', 'Gestione', 'MFA', 'IWantControl', 'ABBA']),
            'hourly_rate' => $this->faker->randomFloat(2, 0, 1000),
            'user_id'     => User::factory(),
        ];
    }
}
