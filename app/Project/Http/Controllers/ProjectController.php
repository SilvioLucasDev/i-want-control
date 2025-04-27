<?php declare(strict_types = 1);

namespace App\Project\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Project\Http\Requests\IndexProjectRequest;
use App\Project\Http\Requests\StoreProjectRequest;
use App\Project\Http\Requests\UpdateProjectRequest;
use App\Project\Http\Resources\ProjectsResource;
use App\Project\Models\Project;
use App\Project\Services\ProjectService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Inertia\{Inertia, Response as InertiaResponse};

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService)
    {
    }

    public function index(IndexProjectRequest $request): InertiaResponse
    {
        $projectId     = $request->input("project_id") ? intval($request->input("project_id")) : null;
        $selectedMonth = $request->input("selected_month") ? intval($request->input("selected_month")) : null;
        $selectedYear  = $request->input("selected_year") ? intval($request->input("selected_year")) : null;

        $userId = logged_in_user_id();

        $data = $this->projectService->getProjectAndPostingActivitiesByIdAndDate($userId, $projectId, $selectedMonth, $selectedYear);

        return Inertia::render('Project/Index', [
            'selected_month'             => $data->selectedMonth,
            'selected_year'              => $data->selectedYear,
            'project_id'                 => $data->projectId,
            'monthly_project_control'    => $data->monthlyProjectControl,
            'posting_project_activities' => $data->postingProjectActivities,
        ]);
    }

    public function getProjectsByUser(): AnonymousResourceCollection
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
