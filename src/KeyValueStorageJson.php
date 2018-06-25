<?php
declare(strict_types=1);

namespace App\Storage;

class KeyValueStorageJson implements KeyValueStorageInterface
{
    private $jsonStorage = [];
    private $jsonPath;

    public function __construct(string $jsonPath)
    {
        $this->jsonPath = $jsonPath;
    }

    public function set(string $key, $value): void
    {
        $this->jsonStorage[$key] = $value;
        \file_put_contents($this->jsonPath,\json_encode($this->jsonStorage));
    }

    public function get(string $key)
    {
        $dataObject = \json_decode(\file_get_contents($this->jsonPath));
        if (isset($dataObject->{$key})){
            return $dataObject->{$key};
        }
    }

    public function has(string $key): bool
    {
        $dataObject = \json_decode(\file_get_contents($this->jsonPath));
        if (isset($dataObject->{$key})){
            return true;
        }

        return false;
    }

    public function remove(string $key): void
    {
        $dataObject = \json_decode(\file_get_contents($this->jsonPath));
        if (isset($dataObject->{$key})){
            unset($dataObject->{$key});
            \file_put_contents($this->jsonPath,\json_encode($dataObject));
        }

    }

    public function clear(): void
    {
        \file_put_contents($this->jsonPath,\json_encode($this->jsonStorage = []));
    }
}