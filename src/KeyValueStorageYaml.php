<?php
declare(strict_types=1);

namespace App\Storage;

use Symfony\Component\Yaml\Yaml;

class KeyValueStorageYaml implements KeyValueStorageInterface
{
    private $yamlStorage = [];

    public function set(string $key, $value): void
    {
        $this->yamlStorage[$key]=$value;
        file_put_contents('./Storage/KeyValueStorage.yaml',Yaml::dump($this->yamlStorage));
    }

    public function get(string $key)
    {
        $parse = Yaml::parseFile('./Storage/KeyValueStorage.yaml');
        if (isset($parse[$key])){
            return $parse[$key];
        }
    }

    public function has(string $key): bool
    {
        $parse = Yaml::parseFile('./Storage/KeyValueStorage.yaml');
        if (isset($parse[$key])) {
            return true;
        }
        return false;
    }

    public function remove(string $key): void
    {
        $parse = Yaml::parseFile('./Storage/KeyValueStorage.yaml');
        if (isset($parse[$key])){
            unset ($parse[$key]);
            $yaml = Yaml::dump($parse);
            file_put_contents('./Storage/KeyValueStorage.yaml',$yaml);
        }
    }

    public function clear(): void
    {
        file_put_contents('./Storage/KeyValueStorage.yaml',Yaml::dump($this->yamlStorage=[]));
    }
}