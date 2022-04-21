<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities;

class Parrot extends Bird
{
    public function talk():string
    {
        return 'Hello';
    }
}
