<?php
declare(strict_types=1);

namespace App\Storage;

use Symfony\Component\Yaml\Yaml;

class KeyValueStorageYaml implements KeyValueStorageInterface
{
    private $yamlStorage = [];
    private $yamlPath;

    public function __construct(string $yamlPath)
    {
        $this->yamlPath = $yamlPath;
    }

    public function set(string $key, $value): void
    {
        $this->yamlStorage[$key]=$value;
        file_put_contents($this->yamlPath,Yaml::dump($this->yamlStorage));
    }

    public function get(string $key)
    {
        $parse = Yaml::parseFile($this->yamlPath);
        if (isset($parse[$key])){
            return $parse[$key];
        }
    }

    public function has(string $key): bool
    {
        $parse = Yaml::parseFile($this->yamlPath);
        if (isset($parse[$key])) {
            return true;
        }
        return false;
    }

    public function remove(string $key): void
    {
        $parse = Yaml::parseFile($this->yamlPath);
        if (isset($parse[$key])){
            unset ($parse[$key]);
            $yaml = Yaml::dump($parse);
            file_put_contents($this->yamlPath,$yaml);
        }
    }

    public function clear(): void
    {
        file_put_contents($this->yamlPath,Yaml::dump($this->yamlStorage=[]));
    }
}