<?php

declare(strict_types=1);

namespace App\Http\Resources\Auth;

use App\DataTransfers\Auth\RegisteredUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ViewResource
 *
 * @property-read RegisteredUser $resource
 *
 * @OA\Schema(
 *     schema="ViewAuthResource",
 *     @OA\Property(property="token", type="string", example="1|Bjb2QGYzxKgqRFLbnHxeUkqR6drD7TpeF7Va3mgU"),
 *     @OA\Property(
 *         property="user",
 *         type="object",
 *         ref="#/components/schemas/ViewUserResource",
 *     ),
 * )
 *
 * @package App\Http\Resources\Auth
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
            'token' => $this->resource->getToken(),
            'user' => \App\Http\Resources\User\ViewResource::make($this->resource->getUser()),
        ];
    }
}
