<?php declare(strict_types = 1);

namespace Database\Factories;

use App\Expense\Models\Project;
use App\Service\Models\PostingProjectActivity;
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
        $initialTime = $this->faker->time();
        $finalTime   = $this->faker->time();
        $duration    = $finalTime - $initialTime;
        $project     = Project::find($this->faker->numberBetween(1, 5));

        return [
            'scope'        => $this->faker->word,
            'description'  => $this->faker->sentence,
            'initial_time' => $initialTime,
            'final_time'   => $finalTime,
            'duration'     => $duration,
            'project_id'   => $project->id,
        ];
    }
}
