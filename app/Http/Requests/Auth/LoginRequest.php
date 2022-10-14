<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

/**
 * Class LoginRequest
 *
 * @OA\Schema(
 *     schema="AuthLoginRequest",
 *     required={"email", "password", "password_confirmation"},
 *     @OA\Property(property="email", type="string", format="email", example="test@example.com"),
 *     @OA\Property(property="password", type="string", example="000000"),
 * )
 *
 * @property string $email
 * @property string $password
 *
 * @package App\Http\Requests\Auth
 */
final class LoginRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'exists:users,email'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $user = User::query()->select('password')->where('email', '=', $this->email)->first();

            if (!Hash::check($this->password, $user->password)) {
                $validator->errors()->add('password', 'Password is incorrect.');
            }
        });
    }
}
