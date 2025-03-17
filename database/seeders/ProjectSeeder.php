<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Expense\Models\Project;
use App\User\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            ["type" => "Wakami", "hourly_rate" => 10],
            ["type" => "Gestione", "hourly_rate" => null],
            ["type" => "MFA", "hourly_rate" => 32.6],
            ["type" => "IWantControl", "hourly_rate" => 90.2],
            ["type" => "ABBA", "hourly_rate" => 59],
        ];

        $user = User::first();

        foreach ($projects as $project) {
            Project::create(
                [
                    "type"        => $project["type"],
                    "hourly_rate" => $project["hourly_rate"],
                    "user_id"     => $user ? $user->id : 1,
                ]
            );
        }
    }
}
