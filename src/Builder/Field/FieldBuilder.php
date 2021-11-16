<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\IntegerField;

class FieldBuilder extends AbstractField implements Field, IntegerField
{
    protected string $type;
    protected string $fieldName;
    protected string $name;
    protected string $strategy = 'set';
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected bool $version = false;
    protected bool $lock = false;

    public function __construct(string $type, string $fieldName)
    {
        $this->type = $type;
        $this->fieldName = $fieldName;
        $this->name = $fieldName;
    }

    public function nameInDb(string $name): FieldBuilder
    {
        $this->name = $name;

        return $this;
    }

    public function nullable(): FieldBuilder
    {
        $this->nullable = true;

        return $this;
    }

    public function notSaved(): FieldBuilder
    {
        $this->notSaved = true;

        return $this;
    }

    public function increment(): FieldBuilder
    {
        $this->strategy = 'increment';

        return $this;
    }

    public function version(): FieldBuilder
    {
        $this->version = true;

        return $this;
    }

    public function lock(): FieldBuilder
    {
        $this->lock = true;

        return $this;
    }

    public function map(): array
    {
        $fields = [
            'type' => $this->type,
            'fieldName' => $this->fieldName,
            'name' => $this->name,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
            'strategy' => $this->strategy,
        ];

        if ($this->version) {
            $fields['version'] = $this->version;
        }
        if ($this->lock) {
            $fields['lock'] = $this->lock;
        }

        return $fields;
    }
}
