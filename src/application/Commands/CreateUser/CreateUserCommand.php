<?php

namespace Src\application\Commands\CreateUser;

use Src\domain\ValueObjects\Email;

class CreateUserCommand
{
    public function __construct(
        protected string $name,
        protected string $email,
        protected string $password
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
