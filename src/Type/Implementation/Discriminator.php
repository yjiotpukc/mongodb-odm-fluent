<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use yjiotpukc\MongoODMFluent\Type\Discriminator as DiscriminatorType;

class Discriminator implements DiscriminatorType
{
    /**
     * @var string
     */
    public $field;

    /**
     * @var string[]
     */
    public $map;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function map(string $value, string $class): DiscriminatorType
    {
        $this->map[$value] = $class;

        return $this;
    }
}
