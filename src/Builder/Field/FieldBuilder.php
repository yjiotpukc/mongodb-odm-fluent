<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Field;

class FieldBuilder extends AbstractField implements Field, Builder
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
    protected $nullable = false;

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
            'fieldName' => $this->fieldName,
            'type' => $this->type,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
            'name' => $this->name,
        ];
    }
}
