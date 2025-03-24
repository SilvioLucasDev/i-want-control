<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Expense\Models\PaymentMethod;
use App\User\Models\User;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            "Cartão de Crédito",
            "Pix",
            "Boleto Bancário",
            "Dinheiro",
        ];

        $user = User::first();

        foreach ($methods as $method) {
            PaymentMethod::create(
                [
                    "type"    => $method,
                    "user_id" => $user ? $user->id : 1,
                ]
            );
        }
    }
}
