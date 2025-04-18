<?php declare(strict_types = 1);

namespace App\Project\Services;

use App\Project\Repositories\MonthlyProjectControlRepository;
use App\Project\Repositories\PostingProjectActivityRepository;
use App\Project\Repositories\ProjectRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;

class PostingProjectActivityService
{
    public function __construct(
        protected PostingProjectActivityRepository $postingProjectActivityRepository,
        protected MonthlyProjectControlRepository $monthlyProjectControlRepository,
        protected ProjectRepository $projectRepository,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): Model
    {
        $data['duration'] = calculate_duration($data['start_time'], $data['end_time']);

        $monthlyProjectControlId = $data['monthly_project_control_id'] ?? null;

        if (!$monthlyProjectControlId) {
            $project = $this->projectRepository->find($data['project_id']);

            $totalReceivable = calculate_total_receivable($project->hourly_rate, $data['duration']);

            $selectedMonth = (int) now()->format('m');
            $selectedYear  = (int) now()->format('Y');

            $createdMonthlyProjectControl = $this->monthlyProjectControlRepository->create([
                'project_id'         => $data['project_id'],
                'hourly_rate'        => $project->hourly_rate,
                'month'              => $selectedMonth,
                'year'               => $selectedYear,
                'total_hours_worked' => $data['duration'],
                'total_receivable'   => $totalReceivable,
            ]);

            $data['monthly_project_control_id'] = $createdMonthlyProjectControl->id;
        } else {
            $monthlyProjectControl = $this->monthlyProjectControlRepository->find($monthlyProjectControlId);

            $monthlyProjectControl->total_hours_worked = add_up_times(
                [
                    $monthlyProjectControl->total_hours_worked,
                    $data['duration'],
                ]
            );

            $totalReceivable = calculate_total_receivable($monthlyProjectControl->hourly_rate, $data['duration']);

            $this->monthlyProjectControlRepository->update($monthlyProjectControlId, [
                'total_hours_worked' => $monthlyProjectControl->total_hours_worked,
                'total_receivable'   => $monthlyProjectControl->total_receivable + $totalReceivable,
            ]);
        }

        return $this->postingProjectActivityRepository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(int $userId, int $postingProjectActivityId, array $data): void
    {
        $postingProjectActivity = $this->postingProjectActivityRepository->find($postingProjectActivityId);

        $project = $postingProjectActivity->project;

        if ($userId !== $project->user_id) {
            throw new AuthorizationException("Você não tem permissão para realizar essa operação.");
        }

        $monthlyProjectControl = $this->monthlyProjectControlRepository->find($postingProjectActivity->monthly_project_control_id);

        $monthlyProjectControl->total_hours_worked = subtract_times(
            $monthlyProjectControl->total_hours_worked,
            $postingProjectActivity->duration,
        );

        $data['duration'] = calculate_duration($data['start_time'], $data['end_time']);

        $monthlyProjectControl->total_hours_worked = add_up_times(
            [
                $monthlyProjectControl->total_hours_worked,
                $data['duration'],
            ]
        );

        $totalReceivable = calculate_total_receivable($monthlyProjectControl->hourly_rate, $monthlyProjectControl->total_hours_worked);

        $this->monthlyProjectControlRepository->update($monthlyProjectControl->id, [
            'total_hours_worked' => $monthlyProjectControl->total_hours_worked,
            'total_receivable'   => $totalReceivable,
        ]);

        $this->postingProjectActivityRepository->update($postingProjectActivityId, $data);
    }

    public function delete(int $userId, int $postingProjectActivityId): void
    {
        $postingProjectActivity = $this->postingProjectActivityRepository->find($postingProjectActivityId);

        $project = $postingProjectActivity->project;

        if ($userId !== $project->user_id) {
            throw new AuthorizationException("Você não tem permissão para realizar essa operação.");
        }

        $monthlyProjectControl = $this->monthlyProjectControlRepository->find($postingProjectActivity->monthly_project_control_id);

        $monthlyProjectControl->total_hours_worked = subtract_times(
            $monthlyProjectControl->total_hours_worked,
            $postingProjectActivity->duration,
        );

        $totalReceivable = calculate_total_receivable($monthlyProjectControl->hourly_rate, $monthlyProjectControl->total_hours_worked);

        $this->monthlyProjectControlRepository->update($monthlyProjectControl->id, [
            'total_hours_worked' => $monthlyProjectControl->total_hours_worked,
            'total_receivable'   => $totalReceivable,
        ]);

        $this->postingProjectActivityRepository->delete($postingProjectActivityId);
    }
}
