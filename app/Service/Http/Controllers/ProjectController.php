<?php declare(strict_types = 1);

namespace App\Service\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Service\Http\Requests\StoreProjectRequest;
use App\Service\Http\Requests\UpdateProjectRequest;
use App\Service\Http\Resources\ProjectsResource;
use App\Service\Models\Project;
use App\Service\Services\ProjectService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $userId = logged_in_user_id();

        $projects = $this->projectService->getProjectsByUserId($userId);

        return ProjectsResource::collection($projects);
    }

    public function store(StoreProjectRequest $request): ProjectsResource
    {
        $data = $request->validated();

        $userId = logged_in_user_id();

        $createdProject = $this->projectService->create($userId, $data);

        return new ProjectsResource($createdProject);
    }

    public function update(UpdateProjectRequest $request, Project $project): Response
    {
        $data = $request->validated();

        $userId = logged_in_user_id();

        $this->projectService->update($userId, $project->id, $data);

        return response()->noContent();
    }

    public function destroy(Project $project): Response
    {
        $userId = logged_in_user_id();

        $this->projectService->delete($userId, $project->id);

        return response()->noContent();
    }
}
