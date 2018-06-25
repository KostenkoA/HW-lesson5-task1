<?php
declare(strict_types=1);

namespace App\Storage;


class KeyValueStorage implements KeyValueStorageInterface
{

    private $storage = [];

    public function set(string $key, $value): void
    {
        $this->storage[$key] = $value;
    }

    public function get(string $key)
    {
        if (isset($this->storage[$key])) {
            return $this->storage[$key];
        }
    }

    public function has(string $key): bool
    {
        if (isset($this->storage[$key])){
            return true;
        }

        return false;
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