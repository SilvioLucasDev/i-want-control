<?php declare(strict_types = 1);

namespace App\Expense\Services;

use App\Common\Services\BaseService;
use App\Expense\Models\Project;
use App\Expense\Repositories\ProjectRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseService<Project, ProjectRepository>
 */
class ProjectService extends BaseService
{
    public function __construct(ProjectRepository $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): Model
    {
        $data['name']        = $data['type'];
        $data['hourly_rate'] = $data['hourlyRate'];
        $data["user_id"]     = auth()->id();
        unset($data['hourlyRate']);
        unset($data['type']);

        return $this->repository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['hourly_rate'] = $data['hourlyRate'];
        unset($data['hourlyRate']);

        return $this->repository->update($id, $data);
    }

    /**
     * @return Collection<int, Project>
     */
    public function userProjects(): Collection
    {
        return $this->repository
            ->userProjects(auth()->id());
    }
}
