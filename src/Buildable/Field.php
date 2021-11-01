<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Buildable;

use yjiotpukc\MongoODMFluent\Type\Field as FieldType;

class Field extends BuildableField implements FieldType, Buildable
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $nullable;

    /**
     * @var bool
     */
    protected $notSaved = false;

    public function __construct(string $type, string $fieldName)
    {
        $this->type = $type;
        $this->fieldName = $fieldName;
        $this->name = $fieldName;
    }

    public function nameInDb(string $name): FieldType
    {
        $this->name = $name;

        return $this;
    }

    public function nullable(): FieldType
    {
        $this->nullable = true;

        return $this;
    }

    public function notSaved(): FieldType
    {
        $this->notSaved = true;

        return $this;
    }

    public function map(): array
    {
        return [
            'fieldName' => $this->fieldName,
            'type' => $this->type,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
            'name' => $this->name,
        ];
    }
}
