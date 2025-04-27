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
            ["type" => "FII", "income" => 1],
            ["type" => "Criptomoeda", "income" => null],
            ["type" => "Renda Fixa", "income" => 0.9],
            ["type" => "Tesouro", "income" => 2],
        ];

        $user = User::first();

        foreach ($investments as $investment) {
            Investment::create(
                [
                    "type"    => $investment["type"],
                    "income"  => $investment["income"],
                    "user_id" => $user ? $user->id : 1,
                ]
            );
        }
    }
}
