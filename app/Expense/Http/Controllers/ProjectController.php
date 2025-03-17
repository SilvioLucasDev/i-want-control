<?php declare(strict_types = 1);

namespace App\Expense\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Expense\Http\Requests\StoreProjectRequest;
use App\Expense\Http\Requests\UpdateProjectRequest;
use App\Expense\Http\Resources\ProjectsResource;
use App\Expense\Models\Project;
use App\Expense\Services\ProjectService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $userId = loggedInUserId();

        $projects = $this->projectService->getProjectsByUserId($userId);

        return ProjectsResource::collection($projects);
    }

    public function store(StoreProjectRequest $request): ProjectsResource
    {
        $data = $request->validated();

        $userId = loggedInUserId();

        $createdProject = $this->projectService->create($userId, $data);

        return new ProjectsResource($createdProject);
    }

    public function update(UpdateProjectRequest $request, Project $project): Response
    {
        $data = $request->validated();

        $userId = loggedInUserId();

        $this->projectService->update($userId, $project->id, $data);

        return response()->noContent();
    }

    public function destroy(Project $project): Response
    {
        $userId = loggedInUserId();

        $this->projectService->delete($userId, $project->id);

        return response()->noContent();
    }
}
