<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DataTransfers\Auth\RegisteredUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\ViewResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/api/register",
 *     summary="Регистрация",
 *     @OA\RequestBody(
 *         @OA\JsonContent(ref="#/components/schemas/AuthRegisterRequest"),
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
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
final class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     *
     * @return JsonResource
     *
     * @throws \Throwable
     */
    public function __invoke(RegisterRequest $request): JsonResource
    {
        $user = new User();

        $user->fill([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->saveOrFail();

        $token = $user->createToken(User::TOKEN_NAME);

        return ViewResource::make(
            new RegisteredUser(
                $token->plainTextToken,
                $user,
            )
        );
    }
}
