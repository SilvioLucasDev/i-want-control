<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Project\Models\Project;
use App\User\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            ["name" => "Wakami", "hourly_rate" => 1099],
            ["name" => "Gestione", "hourly_rate" => 1200],
            ["name" => "MFA", "hourly_rate" => 3240],
            ["name" => "IWantControl", "hourly_rate" => 900050],
            ["name" => "ABBA", "hourly_rate" => 59455],
        ];

        $user = User::first();

        foreach ($projects as $project) {
            Project::create(
                [
                    "name"        => $project["name"],
                    "hourly_rate" => $project["hourly_rate"],
                    "user_id"     => $user ? $user->id : 1,
                ]
            );
        }
    }
}
