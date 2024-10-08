<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Exceptions\InvalidResetTokenException;
use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SetNewPasswordService
{
    public function __construct(
        private IUserRepository $userRepository,
    ) {}

    public function run(array $data): User
    {
        $user = $this->userRepository->findByEmail($data['email']);
        if (! $user) {
            abort(404);
        }

        if ($user->reset_token !== $data['token']) {
            throw new InvalidResetTokenException;
        }

        DB::transaction(function () use (&$user, $data) {
            $this->userRepository->update(
                $user,
                [
                    'reset_token' => null,
                    'password' => Hash::make($data['password']),
                    'auth_token' => Str::random(40),
                ]
            );
        });

        return $user;
    }
}
