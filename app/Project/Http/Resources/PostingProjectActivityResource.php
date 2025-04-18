<?php declare(strict_types = 1);

namespace App\Project\Http\Resources;

use App\Project\Models\PostingProjectActivity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property PostingProjectActivity $resource
 */

class PostingProjectActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"                         => $this->resource->id,
            "scope"                      => $this->resource->scope,
            "start_time"                 => $this->resource->start_time,
            "end_time"                   => $this->resource->end_time,
            "duration"                   => $this->resource->duration,
            "project_id"                 => $this->resource->project_id,
            "monthly_project_control_id" => $this->resource->monthly_project_control_id,
        ];
    }
}
