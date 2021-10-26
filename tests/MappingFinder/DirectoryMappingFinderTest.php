<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\MappingFinder;

use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\MappingFinder\DirectoryMappingFinder;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\EntityWithoutMappingStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;
use yjiotpukc\MongoODMFluent\Tests\Stubs\MappingStub;

class DirectoryMappingFinderTest extends TestCase
{
    public const NAMESPACE = 'yjiotpukc\MongoODMFluent\Tests\Stubs';

    public function testMappingExists()
    {
        $finder = new DirectoryMappingFinder([$this->getDirectoryPath()], [static::NAMESPACE]);
        self::assertTrue($finder->exists(EntityStub::class));
    }

    public function testMappingDoesNotExist()
    {
        $finder = new DirectoryMappingFinder([$this->getDirectoryPath()], [static::NAMESPACE]);
        self::assertFalse($finder->exists(EntityWithoutMappingStub::class));
    }

    public function testReturnsMapping()
    {
        $finder = new DirectoryMappingFinder([$this->getDirectoryPath()], [static::NAMESPACE]);
        self::assertEquals(MappingStub::class, $finder->find(EntityStub::class));
    }

    public function testFailsIfNoMappingFound()
    {
        $entityClassName = EntityWithoutMappingStub::class;
        $this->expectException(MappingException::class);
        $this->expectExceptionMessage("Mapping for entity [$entityClassName] not found");
        $finder = new DirectoryMappingFinder([$this->getDirectoryPath()], [static::NAMESPACE]);
        $finder->find($entityClassName);
    }

    public function testReturnsAllMappings()
    {
        $finder = new DirectoryMappingFinder([$this->getDirectoryPath()], [static::NAMESPACE]);
        self::assertEquals([EntityStub::class, AnotherEntityStub::class], $finder->getAll());
    }

    protected function getDirectoryPath(): string
    {
        return realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Stubs');
    }
}
