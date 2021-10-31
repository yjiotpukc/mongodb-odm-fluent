<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Id;
use yjiotpukc\MongoODMFluent\Type\Implementation\EmbedMany as EmbedManyImplementation;
use yjiotpukc\MongoODMFluent\Type\Implementation\EmbedOne as EmbedOneImplementation;
use yjiotpukc\MongoODMFluent\Type\Implementation\Field as FieldImplementation;
use yjiotpukc\MongoODMFluent\Type\Implementation\Id as IdImplementation;
use yjiotpukc\MongoODMFluent\Type\Implementation\ReferenceMany as ReferenceManyImplementation;
use yjiotpukc\MongoODMFluent\Type\Implementation\ReferenceOne as ReferenceOneImplementation;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

abstract class BaseBuilder implements FluentBuilder
{
    /**
     * @var FluentBuilder[]
     */
    protected $fields = [];

    public function build(ClassMetadata $metadata): void
    {
        foreach ($this->fields as $field) {
            $field->build($metadata);
        }
    }

    public function id(): Id
    {
        $id = new IdImplementation();
        $this->fields[] = $id;

        return $id;
    }

    public function field(string $type, string $fieldName): Field
    {
        $field = new FieldImplementation($type, $fieldName);
        $this->fields[] = $field;

        return $field;
    }

    public function embedOne(string $fieldName, string $target = ''): EmbedOne
    {
        $embedOne = new EmbedOneImplementation($fieldName, $target);
        $this->fields[] = $embedOne;

        return $embedOne;
    }

    public function embedMany(string $fieldName, string $target = ''): EmbedMany
    {
        $embedMany = new EmbedManyImplementation($fieldName, $target);
        $this->fields[] = $embedMany;

        return $embedMany;
    }

    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne
    {
        $referenceOne = new ReferenceOneImplementation($fieldName, $target);
        $this->fields[] = $referenceOne;

        return $referenceOne;
    }

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany
    {
        $referenceOne = new ReferenceManyImplementation($fieldName, $target);
        $this->fields[] = $referenceOne;

        return $referenceOne;
    }
}
