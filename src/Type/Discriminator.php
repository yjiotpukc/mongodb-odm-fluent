<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

class Discriminator
{
    /**
     * @var string
     */
    public $field;

    /**
     * @var string[]
     */
    public $map;

    public $defaultValue;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function map(string $value, string $class): Discriminator
    {
        $this->map[$value] = $class;

        return $this;
    }

    public function default($value): Discriminator
    {
        $this->defaultValue = $value;

        return $this;
    }
}
