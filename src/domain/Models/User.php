<?php

namespace Src\domain\Models;

use Src\domain\ValueObjects\Email;

final readonly class User
{
    public function __construct(
        protected string $name,
        protected Email $email,
        protected string $password,
        protected ?int $id = null
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
