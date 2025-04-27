<?php declare(strict_types = 1);

namespace Database\Factories;

use App\Project\Models\Project;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Project\Models\Project>
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
            'name'        => $this->faker->randomElement(['Wakami', 'Gestione', 'MFA', 'IWantControl', 'ABBA']),
            'hourly_rate' => $this->faker->randomNumber(5),
            'user_id'     => User::factory(),
        ];
    }
}
