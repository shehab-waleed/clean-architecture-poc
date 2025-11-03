<?php

namespace Src\domain\Models;

use Src\domain\ValueObjects\Email;

final readonly class User
{
    public function __construct(
        public string $name,
        public Email $email,
        public string $password,
        public ?int $id = null
    )
    {
    }
}
