<?php

declare(strict_types=1);

namespace App\Http\Resources\Tasks;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class IndexResource
 *
 * @OA\Schema(
 *     schema="TasksIndexResource",
 *     @OA\Property(property="id", type="integer", example="234"),
 *     @OA\Property(property="name", type="string", example="test"),
 *     @OA\Property(property="category", type="string", example="work", enum={"work", "personal"}),
 *     @OA\Property(property="deadline", type="string", format="date", example="2022-10-05"),
 *     @OA\Property(property="completed", type="boolean", example="false"),
 * )
 *
 * @property-read Task $resource
 *
 * @package App\Http\Resources\Tasks
 */
final class IndexResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'category' => $this->resource->category,
            'deadline' => $this->resource->deadline,
            'completed' => $this->resource->completed,
        ];
    }
}
