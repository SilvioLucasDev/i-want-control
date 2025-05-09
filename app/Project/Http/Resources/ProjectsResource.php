<?php declare(strict_types = 1);

namespace App\Project\Http\Resources;

use App\Project\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Project $resource
 */

class ProjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"          => $this->resource->id,
            "name"        => $this->resource->name,
            "hourly_rate" => convert_to_decimal($this->resource->hourly_rate),
        ];
    }
}
