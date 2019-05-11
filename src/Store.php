<?php
declare(strict_types=1);

namespace App;

class Store
{
    private $storePath;

    public function __construct(string $filePath)
    {
        $this->storePath = $filePath;
    }

    public function getAccount()
    {
        return file_get_contents($this->storePath);
    }

    public function saveAccount(Account $account): void
    {
        $data = $account->transformToSave();

        file_put_contents($this->storePath, $data . PHP_EOL, FILE_APPEND);
    }
}
