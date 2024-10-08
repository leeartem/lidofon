<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    public function create(array $data): User;

    public function findByEmail(string $email): ?User;

    public function findByToken(string $token): ?User;

    public function deleteUsers(Collection|User $users): void;

    public function findOrFail(string $id): ?User;

    public function update(User $user, array $data): User;

    public function get(?array $ids = null, bool $withDeleted = false): Collection;

    public function getDeleted(?array $ids = null): Collection;

    public function restoreUsers(Collection|User $users): void;

    public function forceDeleteUsers(Collection|User $users): void;
}
