<?php

namespace Src\application\Commands\CreateUser;

use Src\domain\Contracts\IUserRepository;
use Src\domain\Models\User;

class CreateUserCommandHandler
{
    public function __construct(
        private readonly IUserRepository $userRepository
    )
    {
    }

    public function handle(
        CreateUserCommand $command
    ): CreateUserResponse
    {
        $user = $this->userRepository->create(
            new User(
                name: $command->getName(),
                email: $command->getEmail(),
                password: password_hash($command->getPassword(), PASSWORD_BCRYPT)
            )
        );

        return CreateUserResponse::from($user);
    }
}
