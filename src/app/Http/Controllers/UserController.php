<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Interfaces\IUserRepository;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public const CACHE_TTL = 60 * 60;

    public function __construct(
        private IUserRepository $userRepository
    ) {}

    public function getAll()
    {
        $users = \Cache::remember('users', self::CACHE_TTL, function () {
            return $this->userRepository->get();
        });

        return new UserResourceCollection($users);
    }

    public function getUser(string $id)
    {
        $user = $this->userRepository->findOrFail($id);

        return new UserResource($user);
    }

    public function updateUser(string $id, UpdateUserRequest $request, UpdateUserService $service)
    {
        $user = $service->run($id, $request->validated());

        return new UserResource($user);
    }

    public function delete(string $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->deleteUsers($user);

        return response()->json('ok');
    }

    public function forceDelete(string $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->forceDeleteUsers($user);

        return response()->json('ok');
    }

    public function deletedUsers()
    {
        $deletedUsers = $this->userRepository->getDeleted();

        return new UserResourceCollection($deletedUsers);
    }

    public function restoreUser(string $id)
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->restoreUsers($user);

        return response()->json('ok');
    }

    public function massDelete(Request $request)
    {
        $users = $this->userRepository->get($request->input('ids'));
        $this->userRepository->deleteUsers($users);

        return response()->json('ok');
    }

    public function massRestore(Request $request)
    {
        $users = $this->userRepository->getDeleted($request->input('ids'));
        $this->userRepository->restoreUsers($users);

        return response()->json('ok');
    }

    public function massForceDelete(Request $request)
    {
        $users = $this->userRepository->get($request->input('ids'), true);
        $this->userRepository->forceDeleteUsers($users);

        return response()->json('ok');
    }
}
