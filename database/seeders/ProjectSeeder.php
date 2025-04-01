<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Service\Models\Project;
use App\User\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            ["type" => "Wakami", "hourly_rate" => 1099],
            ["type" => "Gestione", "hourly_rate" => 1200],
            ["type" => "MFA", "hourly_rate" => 3240],
            ["type" => "IWantControl", "hourly_rate" => 900050],
            ["type" => "ABBA", "hourly_rate" => 59455],
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
