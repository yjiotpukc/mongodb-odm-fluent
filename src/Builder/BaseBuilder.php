<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Buildable\EmbedMany as EmbedManyImplementation;
use yjiotpukc\MongoODMFluent\Buildable\EmbedOne as EmbedOneImplementation;
use yjiotpukc\MongoODMFluent\Buildable\Field as FieldImplementation;
use yjiotpukc\MongoODMFluent\Buildable\Id as IdImplementation;
use yjiotpukc\MongoODMFluent\Buildable\ReferenceMany as ReferenceManyImplementation;
use yjiotpukc\MongoODMFluent\Buildable\ReferenceOne as ReferenceOneImplementation;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Id;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

abstract class BaseBuilder implements Buildable
{
    /**
     * @var Buildable[]
     */
    protected $buildables = [];

    public function build(ClassMetadata $metadata): void
    {
        foreach ($this->buildables as $buildable) {
            $buildable->build($metadata);
        }
    }

    public function id(): Id
    {
        return $this->addBuildable(new IdImplementation());
    }

    public function field(string $type, string $fieldName): Field
    {
        return $this->addBuildable(new FieldImplementation($type, $fieldName));
    }

    public function embedOne(string $fieldName, string $target = ''): EmbedOne
    {
        return $this->addBuildable(new EmbedOneImplementation($fieldName, $target));
    }

    public function embedMany(string $fieldName, string $target = ''): EmbedMany
    {
        return $this->addBuildable(new EmbedManyImplementation($fieldName, $target));
    }

    protected function addBuildable($buildable)
    {
        $this->buildables[] = $buildable;

        return $buildable;
    }
}
