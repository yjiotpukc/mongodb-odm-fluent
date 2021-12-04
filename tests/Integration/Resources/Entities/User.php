<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities;

class User
{
    private string $id;
    private string $name;

    /** @var Phone[] */
    private array $phones;
}
