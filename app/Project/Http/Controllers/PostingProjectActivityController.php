<?php declare(strict_types = 1);

namespace App\Project\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Project\Http\Requests\StorePostingProjectActivityRequest;
use App\Project\Http\Requests\UpdatePostingProjectActivityRequest;
use App\Project\Http\Resources\PostingProjectActivityResource;
use App\Project\Models\PostingProjectActivity;
use App\Project\Services\PostingProjectActivityService;
use App\Project\Services\ProjectService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostingProjectActivityController extends Controller
{
    public function __construct(
        protected PostingProjectActivityService $postingProjectActivityService,
        protected ProjectService $projectService
    ) {
    }

    public function store(StorePostingProjectActivityRequest $request): PostingProjectActivityResource
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $createdPostingProjectActivity = $this->postingProjectActivityService->create($data);

            DB::commit();

            return new PostingProjectActivityResource($createdPostingProjectActivity);
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Error creating posting project activity', [
                'error' => $th->getMessage(),
                'data'  => $data,
            ]);

            throw $th;
        }
    }

    public function update(UpdatePostingProjectActivityRequest $request, PostingProjectActivity $postingProjectActivity): Response
    {
        $data = $request->validated();

        $userId = logged_in_user_id();

        try {
            DB::beginTransaction();

            $this->postingProjectActivityService->update($userId, $postingProjectActivity->id, $data);

            DB::commit();

            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Error updating posting project activity', [
                'error' => $th->getMessage(),
                'data'  => $data,
            ]);

            throw $th;
        }
    }

    public function destroy(PostingProjectActivity $postingProjectActivity): Response
    {
        $userId = logged_in_user_id();

        try {
            DB::beginTransaction();

            $this->postingProjectActivityService->delete($userId, $postingProjectActivity->id);

            DB::commit();

            return response()->noContent();
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Error deleting posting project activity', [
                'error' => $th->getMessage(),
                'data'  => $postingProjectActivity,
            ]);

            throw $th;
        }
    }
}
