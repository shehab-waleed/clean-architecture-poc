<?php

namespace Src\infrastructure\Repositories;

use Src\domain\Contracts\IUserRepository;
use Src\domain\Models\User;
use Src\infrastructure\Models\User as EloquentUser;

class EloquentUserRepository implements IUserRepository
{
    public function create(User $user): User
    {
        $eloquentUser = EloquentUser::create([
            'name' => $user->name,
            'email' => $user->email->getRaw(),
            'password' => $user->password
        ]);

        return new User(
            id: $eloquentUser->id,
            name: $eloquentUser->name,
            email: $user->email,
            password: $eloquentUser->password
        );
    }
}
