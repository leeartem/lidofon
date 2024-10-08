<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Interfaces\IUserRepository;
use App\Models\User;

class UpdateUserService
{
    public function __construct(
        private IUserRepository $userRepository,
    ) {}

    public function run(string $id, array $data): User
    {
        $user = $this->userRepository->findOrFail($id);
        $user = $this->userRepository->update($user, $data);

        return $user;
    }
}
