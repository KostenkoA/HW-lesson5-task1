<?php
declare(strict_types=1);

namespace App\Storage;

abstract class AbstractKeyValueStorage implements KeyValueStorageInterface
{
    protected $storage = [];
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function set(string $key, $value): void
    {
        $data = $this->load();
        if (!isset($data[$key])){
            $this->storage[$key]=$value;
            $this->update($this->storage);
        }
    }

    public function get(string $key)
    {
        $data = $this->load();
        if (isset($data[$key])){
            return $data[$key];
        };

    }

    public function has(string $key): bool
    {
        $data = $this->load();

        return isset($data[$key]);

    }

    public function remove(string $key): void
    {
        $data = $this->load();
        if (isset($data[$key])){
            unset($data[$key]);
            $this->update($data);
        }

    }

    public function clear(): void
    {
        $this->update('');
    }
}