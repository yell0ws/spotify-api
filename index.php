<?php
declare(strict_types=1);

use App\{
    Random,
    Account,
    Store
};
use App\Client\SpotifyApiClient;
use GuzzleHttp\Client;

require __DIR__ . '/vendor/autoload.php';

$config = include __DIR__ . '/config.php';

$api = SpotifyApiClient::create(new Client(), $config);
$store = new Store($config['FILE_PATH']);

$account = Account::createFromData(
    Random::username(),
    Random::password()
);

$response = $api->signup($account);

if ($response->isSuccess()) {
    $store->saveAccount($account);
}
