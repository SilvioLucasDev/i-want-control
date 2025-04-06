<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Project\Models\PostingProjectActivity;
use App\Project\Models\Project;
use Illuminate\Database\Seeder;

class PostingProjectActivitySeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::with('monthlyProjectControls')->get();

        foreach ($projects as $project) {
            $monthlyProjectControl = $project->monthlyProjectControls->first();

            for ($i = 0; $i < 3; $i++) {
                PostingProjectActivity::factory([
                    'scope'                      => fake()->randomElement(['Dev', 'Test', 'Deploy', 'Design', 'Review']),
                    'project_id'                 => $project->id,
                    'monthly_project_control_id' => $monthlyProjectControl->id,
                ])->create();
            }
        }
    }
}
