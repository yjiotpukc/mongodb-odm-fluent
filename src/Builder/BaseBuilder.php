<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Implementation\Field as FieldImplementation;
use yjiotpukc\MongoODMFluent\Type\Id;
use yjiotpukc\MongoODMFluent\Type\Implementation\Id as IdImplementation;

abstract class BaseBuilder implements FluentBuilder
{
    protected $fields = [];

    public function build(ClassMetadata $metadata): void
    {
        foreach ($this->fields as $field) {
            if ($field instanceof Id) {
                $metadata->mapField($field->map());
            } elseif ($field instanceof Field) {
                $metadata->mapField($field->map());
            }
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
}
