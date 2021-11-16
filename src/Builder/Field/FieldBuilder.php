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

    public function map(): array
    {
        return [
            'type' => $this->type,
            'fieldName' => $this->fieldName,
            'name' => $this->name,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
            'strategy' => $this->strategy,
        ];
    }
}
