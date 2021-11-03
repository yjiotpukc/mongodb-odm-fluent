<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities;

abstract class Pet
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;
}
