<?php declare(strict_types = 1);

namespace App\Expense\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Expense\Models\Project;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends BaseRepository<Project>
 */
class ProjectRepository extends BaseRepository
{
    public function __construct(protected Project $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjectsByUserId(int $userId): Collection
    {
        return $this->repository
            ->query()
            ->where("user_id", $userId)
            ->get();
    }
}
