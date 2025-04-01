<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Project\Models\PostingProjectActivity;
use App\Project\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostingProjectActivitySeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            for ($i = 0; $i < 3; $i++) {
                $day = Carbon::today();

                $initial = $day->copy()->setTime(random_int(6, 12), random_int(0, 59));
                $final   = $initial->copy()->addMinutes(random_int(120, 240)); // 2h ~ 4h

                $durationInSeconds = (int) $initial->diffInSeconds($final);
                $durationFormatted = gmdate('H:i:s', $durationInSeconds);

                PostingProjectActivity::create([
                    'scope'        => fake()->randomElement(['Dev', 'Test', 'Deploy', 'Design', 'Review']),
                    'description'  => fake()->sentence(),
                    'initial_time' => $initial->format('H:i:s'),
                    'final_time'   => $final->format('H:i:s'),
                    'duration'     => $durationFormatted,
                    'project_id'   => $project->id,
                ]);
            }
        }
    }
}
