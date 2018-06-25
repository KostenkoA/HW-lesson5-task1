<?php
declare(strict_types=1);

namespace App\Storage;

class KeyValueStorageJson implements KeyValueStorageInterface
{
    private $jsonStorage = [];

    public function set(string $key, $value): void
    {
        $this->jsonStorage[$key] = $value;
        \file_put_contents('./Storage/KeyValueStorage.json',\json_encode($this->jsonStorage));
    }

    public function get(string $key)
    {
        $dataObject = \json_decode(\file_get_contents('./Storage/KeyValueStorage.json'));
        if (isset($dataObject->{$key})){
            return $dataObject->{$key};
        }
    }

    public function has(string $key): bool
    {
        $dataObject = \json_decode(\file_get_contents('./Storage/KeyValueStorage.json'));
        if (isset($dataObject->{$key})){
            return true;
        }

        return false;
    }

    public function remove(string $key): void
    {
        $dataObject = \json_decode(\file_get_contents('./Storage/KeyValueStorage.json'));
        if (isset($dataObject->{$key})){
            unset($dataObject->{$key});
            \file_put_contents('./Storage/KeyValueStorage.json',\json_encode($dataObject));
        }

    }

    public function clear(): void
    {
        \file_put_contents('./Storage/KeyValueStorage.json',\json_encode($this->jsonStorage = []));
    }
}