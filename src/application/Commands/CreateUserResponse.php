<?php

namespace Src\application\Commands;

use Src\domain\Models\User;

final readonly class CreateUserResponse
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password
    ) {}

    public static function from(User $user): self
    {
        return new self(
            id: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail()->getRaw(),
            password: $user->getPassword()
        );
    }
}
