<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Field;

class FieldBuilder extends AbstractField implements Field, Builder
{
    protected string $type;
    protected string $fieldName;
    protected string $name;
    protected bool $nullable = false;
    protected bool $notSaved = false;

    public function __construct(string $type, string $fieldName)
    {
        $this->type = $type;
        $this->fieldName = $fieldName;
        $this->name = $fieldName;
    }

    public function nameInDb(string $name): Field
    {
        $this->name = $name;

        return $this;
    }

    public function nullable(): Field
    {
        $this->nullable = true;

        return $this;
    }

    public function notSaved(): Field
    {
        $this->notSaved = true;

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
        ];
    }
}
