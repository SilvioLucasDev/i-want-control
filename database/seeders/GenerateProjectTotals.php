<?php declare(strict_types = 1);

namespace Database\Seeders;

use App\Project\Models\MonthlyProjectControl;
use App\Project\Models\Project;
use Illuminate\Database\Seeder;

class GenerateProjectTotals extends Seeder
{
    public function run(): void
    {
        MonthlyProjectControl::with('postingProjectActivities')->get()->each(function (MonthlyProjectControl $monthlyProjectControl): void {
            $totalSeconds = $monthlyProjectControl->postingProjectActivities
                ->map(fn ($item): int => strtotime((string) $item->duration) - strtotime('TODAY'))
                ->sum();

            $totalHoursTime  = gmdate('H:i:s', $totalSeconds);
            $totalReceivable = ($totalSeconds / 3600) * $monthlyProjectControl->hourly_rate;

            $monthlyProjectControl->update([
                'total_hours_worked' => $totalHoursTime,
                'total_receivable'   => round($totalReceivable),
            ]);
        });

        Project::with('monthlyProjectControls')->get()->each(function (Project $project): void {
            $totalSeconds = $project->monthlyProjectControls
                ->map(fn ($item): int => strtotime((string) $item->total_hours_worked) - strtotime('TODAY'))
                ->sum();

            $totalHoursTime  = gmdate('H:i:s', $totalSeconds);
            $totalReceivable = ($totalSeconds / 3600) * $project->hourly_rate;

            $project->update([
                'total_hours_worked' => $totalHoursTime,
                'total_receivable'   => round($totalReceivable),
            ]);
        });
    }
}
