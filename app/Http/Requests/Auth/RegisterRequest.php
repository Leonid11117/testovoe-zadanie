<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 *
 * @OA\Schema(
 *     schema="AuthRegisterRequest",
 *     required={"email", "password", "password_confirmation"},
 *     @OA\Property(property="email", type="string", format="email", example="test@example.com"),
 *     @OA\Property(property="password", type="string", example="000000"),
 *     @OA\Property(property="password_confirmation", type="string", example="000000"),
 * )
 *
 * @property string $email
 * @property string $password
 * @property string $password_confirmation
 *
 * @package App\Http\Requests\Auth
 */
final class RegisterRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
        ];
    }
}
