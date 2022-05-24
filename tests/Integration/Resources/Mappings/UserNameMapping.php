<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\View;
use yjiotpukc\MongoODMFluent\Mapping\ViewMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\User;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Repositories\UserNameRepository;

class UserNameMapping implements View
{
    public static function map(ViewMapping $mapping): void
    {
        $mapping
            ->rootClass(User::class)
            ->repository(UserNameRepository::class)
            ->string('name');
    }
}
