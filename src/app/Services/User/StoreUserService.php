<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Interfaces\IUserRepository;
use App\Models\User;

class StoreUserService
{
    public function __construct(
        private IUserRepository $userRepository
    ) {}

    public function run(array $data): User
    {
        return $this->userRepository->create($data);
    }
}
