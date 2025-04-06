<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Project\Models\MonthlyProjectControl;
use App\Project\Models\Project;
use Illuminate\Database\Seeder;

class MonthlyProjectControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            MonthlyProjectControl::factory(
                [
                    "project_id"  => $project->id,
                    "month"       => now()->format("m"),
                    "year"        => now()->format("Y"),
                    "hourly_rate" => $project->hourly_rate,
                ]
            )->create();
        }
    }
}
