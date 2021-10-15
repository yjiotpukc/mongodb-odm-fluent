<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Fluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Types\Field;
use yjiotpukc\MongoODMFluent\Types\Id;

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
        $id = new Id();
        $this->fields[] = $id;

        return $id;
    }

    public function field(string $type, string $fieldName): Field
    {
        $field = new Field($type, $fieldName);
        $this->fields[] = $field;

        return $field;
    }
}
