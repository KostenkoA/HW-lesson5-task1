<?php

namespace App\Storage;

class KeyValueStorage implements KeyValueStorageInterface
{

    private $storage = [];

    public function set(string $key, $value): void
    {
        if (!isset($this->storage[$key])) {
            $this->storage[$key] = $value;
        }
    }

    public function get(string $key)
    {
        return $this->storage[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($this->storage[$key]);
    }

    public function remove(string $key): void
    {
        if (isset($this->storage[$key])){
            unset($this->storage[$key]);
        }
    }

    public function clear(): void
    {
        $this->storage = [];
    }
}