<?php declare(strict_types = 1);

namespace App\Expense\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Expense\Http\Requests\StoreProjectRequest;
use App\Expense\Http\Requests\UpdateProjectRequest;
use App\Expense\Http\Resources\ProjectsResource;
use App\Expense\Models\Project;
use App\Expense\Services\ProjectService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }

    public function userProjects(): AnonymousResourceCollection
    {
        $projects = $this->projectService
            ->userProjects();

        return ProjectsResource::collection($projects);
    }

    public function store(StoreProjectRequest $request): void
    {
        $this->projectService
            ->create($request->validated());
    }

    public function update(UpdateProjectRequest $request, Project $project): void
    {
        $this->projectService
            ->update(
                $project->id,
                $request->validated()
            );
    }

    public function destroy(Project $project): void
    {
        $this->projectService->delete($project->id);
    }
}
