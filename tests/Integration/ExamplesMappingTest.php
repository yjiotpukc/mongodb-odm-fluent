<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\Persistence\Mapping\Driver\StaticPHPDriver;
use PHPUnit\Framework\TestCase;
use yjiotpukc\MongoODMFluent\AnnotationCompatibleMetadataConverter;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance\Animal;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance\Crocodile;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance\Hatiko;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance\Mammal;
use yjiotpukc\MongoODMFluent\Examples\Mapping\Entity\Inheritance\Reptile;

class ExamplesMappingTest extends TestCase
{
    public function testMapping(): void
    {
        $entitiesDir = __DIR__ . '/../../examples/Mapping/Entity';

        $annotationDriver = new AnnotationDriver(new AnnotationReader(), $entitiesDir);
        $phpDriver = new StaticPHPDriver($entitiesDir);
        $metadataConverter = new AnnotationCompatibleMetadataConverter($phpDriver);

        $entities = $annotationDriver->getAllClassNames();

        foreach ($entities as $entity) {
            $expectedMetadata = new ClassMetadata($entity);
            $actualMetadata = new ClassMetadata($entity);

            $annotationDriver->loadMetadataForClass($entity, $expectedMetadata);
            $phpDriver->loadMetadataForClass($entity, $actualMetadata);
            $metadataConverter->makeCompatible($actualMetadata);

            self::assertEquals($expectedMetadata, $actualMetadata);
        }
    }
}
