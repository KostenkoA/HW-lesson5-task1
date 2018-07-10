<?php

namespace App\Storage\Tests;

use App\Storage\KeyValueStorageInterface;
use App\Storage\KeyValueStorageJson;
use PHPUnit\Framework\TestCase;

class KeyValueStorageJsonTest extends TestCase
{
    private const STORAGE_FILE = __DIR__ . '/../storage/KeyValueStorage.json';

    /**
     * @var KeyValueStorageInterface
     */
    private $storage;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->storage = new KeyValueStorageJson(self::STORAGE_FILE);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        \file_put_contents(self::STORAGE_FILE, '', \LOCK_EX);
    }

    public function testSet()
    {
        $this->storage->set('banana', 25);
        self::assertEquals(
            25,
            $this->storage->get('banana'),
            'Method should save a value to the storage'
        );
    }

    public function testGet()
    {
        $this->storage->set('chery', 55);
        self::assertEquals(55, $this->storage->get('chery'));
        self::assertNull($this->storage->get('unknown'),
            'If key does not exist - method should return null'
        );
    }

    public function testHas()
    {
        $this->storage->set('orange', 78);
        self::assertTrue($this->storage->has('orange'));
        self::assertFalse($this->storage->has('tomato'));
    }

    /**
     * @dataProvider removeDataProvider
     */
    public function testRemove($key, $data)
    {
        $this->storage->set($key, $data);
        $this->storage->remove($key);
        self::assertFalse($this->storage->has($key));
    }

    public function testClear()
    {
        $this->storage->set('dog', 2);
        $this->storage->set('cat', 4);
        $this->storage->set('snake', 6);

        $this->storage->clear();

        //self::assertEquals(2, $this->storage->get('dog'));
        //self::assertTrue($this->storage->has('cat'));
        self::assertFalse(
            $this->storage->has('snake'),
            'Method clear should remove all values from the storage'
        );
    }

    public function removeDataProvider(): iterable
    {
        yield ['a', 1];
        yield ['b', 3];
        yield ['c', 5];
    }

}