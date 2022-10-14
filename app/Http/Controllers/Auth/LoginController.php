<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DataTransfers\Auth\RegisteredUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\ViewResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/api/login",
 *     summary="Авторизация",
 *     @OA\RequestBody(
 *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest"),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/ViewAuthResource",
 *              )
 *          )
 *     ),
 *     @OA\Response(response="400", ref="#/components/responses/error:bad_request"),
 *     @OA\Response(response="422", ref="#/components/responses/error:validation"),
 *     @OA\Response(response="500", ref="#/components/responses/error:server"),
 *     security={ }
 * )
 *
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
final class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResource
     */
    public function __invoke(LoginRequest $request): JsonResource
    {
        $user = User::query()->where('email', '=', $request->email)->first();
        $token = $user->createToken(User::TOKEN_NAME);

        return ViewResource::make(
            new RegisteredUser(
                $token->plainTextToken,
                $user,
            )
        );
    }
}
