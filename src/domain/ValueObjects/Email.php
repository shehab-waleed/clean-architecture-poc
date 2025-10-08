<?php

namespace Src\domain\ValueObjects;

final readonly class Email
{
    public function __construct(protected string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email address");
        }
    }

    public function getRaw(): string
    {
        return $this->email;
    }
}
