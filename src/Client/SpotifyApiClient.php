<?php
declare(strict_types=1);

namespace App\Client;

use App\{
    Account,
    Response,
    Request
};
use GuzzleHttp\ClientInterface;

class SpotifyApiClient extends ApiClient
{
    const API_URL = 'https://www.spotify.com/%s/%s';
    const API_SIGN_UP_URL = 'xhr/json/sign-up/';
    const API_LANG = 'us';

    private $client;
    private $config;

    protected function __construct(ClientInterface $client, array $config = [])
    {
        $this->client = $client;
        $this->config = $config;
        parent::__construct($client, $config);
    }

    public static function create(ClientInterface $client, array $config = []): SpotifyApiClient
    {
        return new self(
            $client,
            $config
        );
    }

    public function signup(Account $account): Response
    {
        $request = (new Request(
            $account->getUsername(),
            $account->getPassword(),
            $this->getConfigApiDomainMail()
        ));

        $body = $request->body();
        $headers = $request->headers();

        $data = $this->post(
            self::API_SIGN_UP_URL,
            $body,
            $headers
        );

        return Response::createFromArray($data);
    }

    private function getConfigApiDomainMail(): ?string
    {
        return $this->config['DOMAIN_MAIL'] ?? null;
    }
}
