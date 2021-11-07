<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs;

use yjiotpukc\MongoODMFluent\Tests\Stubs\Mappings\AnotherEntityStub;

class EntityStub
{
    private string $id;
    private string $firstName;
    private int $age;
    private AnotherEntityStub $address;
}
