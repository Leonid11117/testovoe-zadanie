<?php

declare(strict_types=1);

namespace App\Http\Resources\Tasks;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ViewResource
 *
 * @OA\Schema(
 *     schema="TasksViewResource",
 *     @OA\Property(property="id", type="integer", example="234"),
 *     @OA\Property(property="name", type="string", example="test"),
 *     @OA\Property(property="description", type="string", example="test"),
 *     @OA\Property(property="category", type="string", example="work", enum={"work", "personal"}),
 *     @OA\Property(property="deadline", type="string", format="date", example="2022-10-05"),
 *     @OA\Property(property="completed", type="boolean", example="false"),
 *     @OA\Property(property="urgent", type="boolean", example="false"),
 *     @OA\Property(property="image", type="string", format="uri", example="http://test.dok/storage/52/download.jpeg"),
 * )
 *
 * @property-read Task $resource
 *
 * @package App\Http\Resources\Tasks
 */
final class ViewResource extends JsonResource
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
            'description' => $this->resource->description,
            'category' => $this->resource->category,
            'deadline' => $this->resource->deadline,
            'completed' => $this->resource->completed,
            'urgent' => $this->resource->urgent,
            'image' => $this->resource->getFirstMedia(Task::MEDIA_COLLECTION_IMAGE)->getFullUrl(),
        ];
    }
}
