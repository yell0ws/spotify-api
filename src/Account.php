<?php
declare(strict_types=1);

namespace App;

class Account
{
    private $username;
    private $password;

    private function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public static function createFromData(string $username, string $password): Account
    {
        return new self(
            $username,
            $password
        );
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function transformToSave(): string
    {
        return $this->getUsername() .
            PATH_SEPARATOR .
            $this->getPassword();
    }
}
