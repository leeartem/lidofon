<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class UserRepository implements IUserRepository
{
    public function __construct(
        private User $model
    ) {}

    public function create(array $data): User
    {
        return $this->model
            ->newQuery()
            ->create([
                'auth_token' => Str::random(40),
                ...$data,
            ]);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model
            ->newQuery()
            ->whereEmail($email)
            ->first();
    }

    public function findByToken(string $token): ?User
    {
        return $this->model
            ->newQuery()
            ->whereAuthToken($token)
            ->first();
    }

    public function deleteUsers(Collection|User $users): void
    {
        if ($users instanceof User) {
            $users->delete();

            return;
        }

        foreach ($users as $user) {
            $user->delete();
        }
    }

    public function findOrFail(string $id): ?User
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }

    public function get(?array $ids = null, bool $withDeleted = false): Collection
    {
        $q = $this->model->newQuery();
        if ($ids !== null) {
            $q->whereIn('id', $ids);
        }

        if ($withDeleted) {
            $q->withTrashed();
        }

        return $q->get();
    }

    public function getDeleted(?array $ids = null): Collection
    {
        $q = $this->model->newQuery();
        if ($ids !== null) {
            $q->whereIn('id', $ids);
        }

        return $q->onlyTrashed()->get();
    }

    public function restoreUsers(Collection|User $users): void
    {
        if ($users instanceof User) {
            $users->restore();

            return;
        }

        foreach ($users as $user) {
            $user->restore();
        }
    }

    public function forceDeleteUsers(Collection|User $users): void
    {
        if ($users instanceof User) {
            $users->forceDelete();

            return;
        }

        foreach ($users as $user) {
            $user->forceDelete();
        }
    }
}
