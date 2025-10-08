<?php

namespace Src\domain\Contracts;

use Src\domain\Models\User;

interface IUserRepository
{
    public function create(User $user): User;
}
