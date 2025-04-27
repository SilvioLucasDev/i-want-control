<?php declare(strict_types = 1);

namespace Database\Factories;

use App\Expense\Models\Investment;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Expense\Models\Investment>
 */
class InvestmentFactory extends Factory
{
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type'    => $this->faker->randomElement(['FII', 'Criptomoeda', 'Renda Fixa', 'Tesouro']),
            'income'  => $this->faker->randomFloat(2, 0, 100),
            'user_id' => User::factory(),
        ];
    }
}
