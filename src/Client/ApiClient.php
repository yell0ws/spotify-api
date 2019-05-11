<?php
declare(strict_types=1);

namespace App\Client;

use GuzzleHttp\ClientInterface;

abstract class ApiClient
{
    private $client;
    private $config;

    protected function __construct(ClientInterface $client, array $config = [])
    {
        $this->client = $client;
        $this->config = $config;
    }

    private function getConfigApiUrl(): string
    {
        return $this->config['API_URL'] ?? static::API_URL;
    }

    private function getConfigApiLang(): string
    {
        return $this->config['API_LANG'] ?? static::API_LANG;
    }

    private function buildUri(string $resource): string
    {
        $url = $this->getConfigApiUrl();
        $lang = $this->getConfigApiLang();

        return sprintf($url, $lang, $resource);
    }

    private function buildOptions(array $body = [], array $headers = []): array
    {
        return [
            'form_params' => $body,
            'headers' => $headers,
        ];
    }

    protected function post(string $resource, array $body = [], array $headers = []): array
    {
        $options = $this->buildOptions($body, $headers);

        return $this->request(
            'POST',
            $resource,
            $options
        );
    }

    protected function get(string $resource, array $body = [], array $headers = []): array
    {
        $options = $this->buildOptions($body, $headers);

        return $this->request(
            'GET',
            $resource,
            $options
        );
    }

    protected function request(string $method, string $resource, array $options = []): array
    {
        $uri = $this->buildUri($resource);

        $response = $this->client->request($method, $uri, $options);
        $contents = $response->getBody()->getContents();

        return json_decode($contents, true);
    }
}