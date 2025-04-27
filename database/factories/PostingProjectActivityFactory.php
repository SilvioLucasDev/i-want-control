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

        $startTime = $day->copy()->setTime(random_int(6, 12), random_int(0, 59));
        $endTime   = $startTime->copy()->addMinutes(random_int(120, 240)); // 2h ~ 4h

        $durationInSeconds = (int) $startTime->diffInSeconds($endTime);
        $durationFormatted = gmdate('H:i:s', $durationInSeconds);

        $project               = Project::with('monthlyProjectControls')->find($this->faker->numberBetween(1, 5));
        $monthlyProjectControl = $project->monthlyProjectControls->first();

        return [
            'scope'                      => $this->faker->word,
            'description'                => $this->faker->sentence,
            'start_time'                 => $startTime,
            'end_time'                   => $endTime,
            'duration'                   => $durationFormatted,
            'project_id'                 => $project->id,
            'monthly_project_control_id' => $monthlyProjectControl->id,
        ];
    }
}
