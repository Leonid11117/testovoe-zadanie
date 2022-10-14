<?php

declare(strict_types=1);

namespace App\DataTransfers\Auth;

use App\Models\User;

/**
 * Class RegisteredUser
 * @package App\DataTransfers\Auth
 */
final class RegisteredUser
{
    public function __construct(
        private string $token,
        private User $user
    ) {}

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
