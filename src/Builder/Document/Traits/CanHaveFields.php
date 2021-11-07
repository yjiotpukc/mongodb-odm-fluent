<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document\Traits;

use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;
use yjiotpukc\MongoODMFluent\Type\Field;

trait CanHaveFields
{
    public function field(string $type, string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder($type, $fieldName));
    }

    public function string(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('string', $fieldName));
    }

    public function int(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('int', $fieldName));
    }

    public function float(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('float', $fieldName));
    }

    public function bool(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('boolean', $fieldName));
    }

    public function timestamp(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('timestamp', $fieldName));
    }

    public function date(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('date', $fieldName));
    }

    public function dateImmutable(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('date_immutable', $fieldName));
    }

    public function decimal(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('decimal128', $fieldName));
    }

    public function array(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('collection', $fieldName));
    }

    public function hash(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('hash', $fieldName));
    }

    public function key(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('key', $fieldName));
    }

    public function objectId(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('object_id', $fieldName));
    }

    public function raw(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('raw', $fieldName));
    }

    public function bin(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin', $fieldName));
    }

    public function binBytearray(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_bytearray', $fieldName));
    }

    public function binCustom(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_custom', $fieldName));
    }

    public function binFunc(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_func', $fieldName));
    }

    public function binMd5(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_md5', $fieldName));
    }

    public function binUuid(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_uuid', $fieldName));
    }
}
