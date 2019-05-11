<?php
declare(strict_types=1);

namespace App;

class Request
{
    const DOMAIN_MAIL = 'gmail.com';

    private $username;
    private $password;
    private $domainMail;

    public function __construct(string $username, string $password, string $domainMail = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->domainMail = $domainMail;
    }

    private function getPassword(): string
    {
        return $this->password;
    }

    private function getUsername(): string
    {
        return $this->username;
    }

    private function getDomainMail(): string
    {
        return $this->domainMail ?? self::DOMAIN_MAIL;
    }

    private function getMail(): string
    {
        return sprintf('%s@%s', $this->getUsername(), $this->getDomainMail());
    }

    public function body(): array
    {
        return [
            'platform' => 'Android-ARM',
            'password' => $this->getPassword(),
            'password_repeat' => $this->getPassword(),
            'iagree' => '1',
            'birth_year' => '2000',
            'birth_month' => '2',
            'birth_day' => '2',
            'invitecode' => '',
            'postal_code' => '90001',
            'gender' => 'male',
            'creation_point' => 'client_mobile',
            'creation_flow' => 'client_mobile',
            'key' => '142b583129b2df829de3656f9eb484e6',
            'email' => $this->getMail(),
            'username' => $this->getUsername()
        ];
    }

    public function headers(): array
    {
        return [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'User-Agent' => 'Spotify/8.3.0 Android/17 (SM-G935F)'
        ];
    }

}
