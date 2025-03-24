<?php declare(strict_types = 1);

namespace App\Expense\Http\Resources;

use App\Expense\Models\Project;
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
            "type"        => $this->resource->type,
            "hourly_rate" => convert_to_decimal($this->resource->hourly_rate),
        ];
    }
}
