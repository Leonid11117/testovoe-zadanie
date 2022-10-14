<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ViewResource
 *
 * @property-read User $resource
 *
 * @OA\Schema(
 *     schema="ViewUserResource",
 *     @OA\Property(property="id", type="integer", example="234"),
 *     @OA\Property(property="email", type="string", format="email", example="test@example.com"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2022-10-05T12:12:12.000Z"),
 * )
 *
 * @package App\Http\Resources\User
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
            'email' => $this->resource->email,
            'created_at' => $this->resource->created_at,
        ];
    }
}
