<?php

namespace App\Storage\Tests;

use App\Storage\KeyValueStorageInterface;
use App\Storage\KeyValueStorageJson;
use PHPUnit\Framework\TestCase;


class KeyValueStorageJsonTest extends TestCase
{
    /**
     * @var KeyValueStorageInterface
     */
    private $storage;

    protected function setUp()
    {
        $this->storage = new KeyValueStorageJson('../storage/KeyValueStorage.json');
    }

    public function testSet()
    {
        $this->storage->set('banana', 25);
        $this->assertEquals(25, $this->storage->get('banana'));
    }

    public function testGet()
    {
        $this->storage->set('chery', 55);
        $this->assertEquals(55, $this->storage->get('chery'));
    }

    public function testHas()
    {
        $this->storage->set('orange', 78);
        $this->assertTrue($this->storage->has('orange'));
        $this->assertFalse($this->storage->has('tomato'));
    }

    /**
     * @dataProvider removeDataProvider
     */
    public function testRemove($key, $data)
    {
        $this->storage->set($key, $data);
        $this->storage->remove($key);
        $this->assertFalse($this->storage->has($key));
    }

    public function testClear()
    {
        $this->storage->set('dog', 2);
        $this->storage->set('cat', 4);
        $this->storage->set('snake', 6);

        $this->storage->clear();

        $this->assertEquals(2, $this->storage->get('dog'));
        $this->assertTrue($this->storage->has('cat'));
        $this->assertFalse($this->storage->has('snake'));
    }

    public function removeDataProvider()
    {
        yield ['a', 1];
        yield ['b', 3];
        yield ['c', 5];
    }

}