<?php declare(strict_types = 1);

namespace App\Expense\Http\Resources;

use App\Expense\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property PaymentMethod $resource
 */
class PaymentMethodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"         => $this->resource->id,
            "name"       => $this->resource->name,
            "created_at" => $this->resource->created_at->format("Y-m-d H:i:s"),
            "updated_at" => $this->resource->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
