<?php declare(strict_types = 1);

namespace Database\Factories;

use App\Expense\Models\PaymentMethod;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Expense\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type'    => $this->faker->randomElement(['Cartão de Crédito', 'Boleto', 'Pix', 'Dinheiro']),
            'user_id' => User::factory(),
        ];
    }
}
