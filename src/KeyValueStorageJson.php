<?php
declare(strict_types=1);

namespace App\Storage;

class KeyValueStorageJson extends AbstractKeyValueStorage {

    protected function update($data): void
    {
        $json = \json_encode($data);
        \file_put_contents($this->path, $json, \LOCK_EX);
    }

    protected function load(): array
    {
        $dataObject = \file_get_contents($this->path);
        $data = \json_decode(($dataObject), true);
        return \is_array($data) ? $data : [];
    }
}