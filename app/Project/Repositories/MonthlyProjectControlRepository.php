<?php declare(strict_types = 1);

namespace App\Project\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Project\Models\MonthlyProjectControl;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<MonthlyProjectControl>
 */
class MonthlyProjectControlRepository extends BaseRepository
{
    public function __construct(protected MonthlyProjectControl $repository)
    {
        parent::__construct($repository);
    }

    public function getMonthlyProjectControlByProjectIdAndDate(int $projectId, int $selectedMonth, int $selectedYear): ?MonthlyProjectControl
    {
        return $this->repository
            ->query()
            ->where("project_id", $projectId)
            ->where("month", $selectedMonth)
            ->where("year", $selectedYear)
            ->first();
    }

    /**
     * @return Collection<int, MonthlyProjectControl>|Collection<never, never>
     */
    public function getMonthlyProjectControlsByProjectId(int $projectId): Collection
    {
        return $this->repository
            ->query()
            ->where("project_id", $projectId)
            ->get();
    }
}
