<?php declare(strict_types = 1);

namespace Database\Factories;

use App\Project\Models\PostingProjectActivity;
use App\Project\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\PostingProjectActivity>
 */
class PostingProjectActivityFactory extends Factory
{
    protected $model = PostingProjectActivity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $day = Carbon::today();

        $initialTime = $day->copy()->setTime(random_int(6, 12), random_int(0, 59));
        $finalTime   = $initialTime->copy()->addMinutes(random_int(120, 240)); // 2h ~ 4h

        $durationInSeconds = (int) $initialTime->diffInSeconds($finalTime);
        $durationFormatted = gmdate('H:i:s', $durationInSeconds);

        $project               = Project::with('monthlyProjectControls')->find($this->faker->numberBetween(1, 5));
        $monthlyProjectControl = $project->monthlyProjectControls->first();

        return [
            'scope'                      => $this->faker->word,
            'description'                => $this->faker->sentence,
            'initial_time'               => $initialTime,
            'final_time'                 => $finalTime,
            'duration'                   => $durationFormatted,
            'project_id'                 => $project->id,
            'monthly_project_control_id' => $monthlyProjectControl->id,
        ];
    }
}
