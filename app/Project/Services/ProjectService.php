<?php declare(strict_types = 1);

namespace App\Project\Services;

use App\Project\Models\MonthlyProjectControl;
use App\Project\Models\PostingProjectActivity;
use App\Project\Models\Project;
use App\Project\Repositories\MonthlyProjectControlRepository;
use App\Project\Repositories\PostingProjectActivityRepository;
use App\Project\Repositories\ProjectRepository;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class ProjectService
{
    public function __construct(
        protected ProjectRepository $projectRepository,
        protected PostingProjectActivityRepository $postingProjectActivityRepository,
        protected MonthlyProjectControlRepository $monthlyProjectControlRepository
    ) {
    }

    /**
     * @return object{
     *      selectedMonth: int,
     *      selectedYear: int,
     *      projectId: int,
     *      monthlyProjectControl: stdClass,
     *      postingProjectActivities: Collection<int, PostingProjectActivity>|Collection<never, never>
     * }
     */
    public function getProjectAndPostingActivitiesByIdAndDate(int $userId, ?int $projectId, ?int $selectedMonth, ?int $selectedYear): object
    {
        if (is_null($projectId)) {
            $project = $this->projectRepository->getLatestProjectByUserId($userId);
        } else {
            $project = $this->projectRepository->find($projectId);
        }

        if ($userId !== $project->user_id) {
            throw new AuthorizationException("Você não tem permissão para realizar essa operação.");
        }

        if (!$selectedMonth || !$selectedYear) {
            $currentDate   = now();
            $selectedMonth = intval($currentDate->format("m"));
            $selectedYear  = intval($currentDate->format("Y"));
        }

        $formattedMonthlyProjectControl = new stdClass();
        $postingProjectActivities       = collect();

        $monthlyProjectControl = $this->monthlyProjectControlRepository->getMonthlyProjectControlByProjectIdAndDate($project->id, $selectedMonth, $selectedYear);

        if ($monthlyProjectControl !== null) {
            $formattedMonthlyProjectControl->hourly_rate        = convert_to_decimal($monthlyProjectControl->hourly_rate);
            $formattedMonthlyProjectControl->total_receivable   = convert_to_decimal($monthlyProjectControl->total_receivable);
            $formattedMonthlyProjectControl->total_hours_worked = Carbon::parse($monthlyProjectControl->total_hours_worked)->format("H:i");

            $postingProjectActivities = $this->postingProjectActivityRepository->getPostingActivitiesByMonthlyProjectControlId($monthlyProjectControl->id);

            foreach ($postingProjectActivities as $postingProjectActivity) {
                $postingProjectActivity->initial_time = Carbon::parse($postingProjectActivity->initial_time)->format("H:i");
                $postingProjectActivity->final_time   = Carbon::parse($postingProjectActivity->final_time)->format("H:i");
            }
        }

        return (object) [
            "selectedMonth"            => $selectedMonth,
            "selectedYear"             => $selectedYear,
            "projectId"                => $project->id,
            "monthlyProjectControl"    => $formattedMonthlyProjectControl,
            "postingProjectActivities" => $postingProjectActivities,
        ];
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjectsByUserId(int $userId): Collection
    {
        return $this->projectRepository->getProjectsByUserId($userId);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function create(int $userId, array $data): Model
    {
        $data["user_id"] = $userId;

        $data["hourly_rate"] = convert_to_cents($data["hourly_rate"]);

        return $this->projectRepository->create($data);
    }

    /**
     * @param array<string, mixed> $data
     */
    public function update(int $userId, int $paymentMethodId, array $data): void
    {
        $paymentMethod = $this->projectRepository->find($paymentMethodId);

        if ($userId !== $paymentMethod->user_id) {
            throw new AuthorizationException("Você não tem permissão para realizar essa operação.");
        }

        $data["hourly_rate"] = convert_to_cents($data["hourly_rate"]);

        $this->projectRepository->update($paymentMethodId, $data);
    }

    public function delete(int $userId, int $paymentMethodId): void
    {
        $paymentMethod = $this->projectRepository->find($paymentMethodId);

        if ($userId !== $paymentMethod->user_id) {
            throw new AuthorizationException("Você não tem permissão para realizar essa operação.");
        }

        $this->projectRepository->delete($paymentMethodId);
    }
}
