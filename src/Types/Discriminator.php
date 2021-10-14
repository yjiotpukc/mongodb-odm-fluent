<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Types;

use yjiotpukc\MongoODMFluent\MappingException;

class Discriminator
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string[]
     */
    protected $map;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function map(string $value, string $class): Discriminator
    {
        $this->map[$value] = $class;

        return $this;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'field':
                return $this->field;
            case 'map':
                return $this->map;
        }

        throw new MappingException("Unknown field {$name} in Discriminator");
    }
}
