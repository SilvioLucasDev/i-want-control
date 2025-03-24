<?php declare(strict_types = 1);

namespace App\Expense\Http\Resources;

use App\Expense\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Investment $resource
 */
class InvestmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"     => $this->resource->id,
            "type"   => $this->resource->type,
            "income" => $this->resource->income,
        ];
    }
}
