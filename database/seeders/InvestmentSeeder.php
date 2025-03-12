<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Expense\Models\Investment;
use App\User\Models\User;
use Illuminate\Database\Seeder;

class InvestmentSeeder extends Seeder
{
    public function run(): void
    {
        $investments = [
            ["name" => "FII", "income" => 1],
            ["name" => "Criptomoeda", "income" => null],
            ["name" => "Renda Fixa", "income" => 0.9],
            ["name" => "Tesouro", "income" => 2],
        ];

        $user = User::first();

        foreach ($investments as $investment) {
            Investment::create(
                [
                    "name"    => $investment["name"],
                    "income"  => $investment["income"],
                    "user_id" => $user ? $user->id : 1,
                ]
            );
        }
    }
}
