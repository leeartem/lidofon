<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Interfaces\IUserRepository;
use Illuminate\Support\Str;

class ResetUserPasswordService
{
    public function __construct(
        private IUserRepository $userRepository,
    ) {}

    public function run(string $email): void
    {
        $user = $this->userRepository->findByEmail($email);
        if (! $user) {
            abort(404);
        }

        $this->userRepository->update(
            $user,
            ['reset_token' => Str::random(40)]
        );

        // sending email with token
    }
}
