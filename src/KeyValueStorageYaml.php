<?php
declare(strict_types=1);

namespace App\Storage;

use Symfony\Component\Yaml\Yaml;

class KeyValueStorageYaml extends AbstractKeyValueStorage
{
    protected function update($data): void
    {
        file_put_contents($this->path,Yaml::dump($data), \LOCK_EX);
    }

    protected function load(): array
    {
        $yaml = Yaml::parseFile($this->path);

        return \is_array($yaml) ? $yaml : [];
    }
}