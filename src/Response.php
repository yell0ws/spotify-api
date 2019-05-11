<?php
declare(strict_types=1);

namespace App;

class Response
{
    const STATUS_SUCCESS = 1;

    private $status;
    private $country;
    private $errors;
    private $username;

    private function __construct(int $status, string $country, ?string $username, ?array $errors)
    {
        $this->status = $status;
        $this->country = $country;
        $this->errors = $errors;
        $this->username = $username;
    }

    public static function createFromArray(array $data): self
    {
        return new self(
            $data['status'],
            $data['country'],
            $data['username'] ?? null,
            $data['errors'] ?? null
        );
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return $this->getErrors() !== null;
    }

    public function isSuccess(): bool
    {
        return $this->hasErrors() === false &&
            $this->getStatus() === self::STATUS_SUCCESS;
    }
}
