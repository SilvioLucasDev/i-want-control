<?php declare(strict_types = 1);

namespace App\Project\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Project\Models\PostingProjectActivity;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<PostingProjectActivity>
 */
class PostingProjectActivityRepository extends BaseRepository
{
    public function __construct(protected PostingProjectActivity $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return Collection<int, PostingProjectActivity>
     */
    public function getPostingActivitiesByMonthlyProjectControlId(int $monthlyProjectControlId): Collection
    {
        return $this->repository
            ->query()
            ->where("monthly_project_control_id", $monthlyProjectControlId)
            ->get();
    }
}
