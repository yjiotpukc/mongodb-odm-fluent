<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\View;
use yjiotpukc\MongoODMFluent\Mapping\ViewMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\User;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\UserName;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Repositories\UserNameRepository;

class UserNameMapping extends ViewMapping
{
    public function mapFor(): string
    {
        return UserName::class;
    }

    public function map(View $builder): void
    {
        $builder
            ->rootClass(User::class)
            ->repository(UserNameRepository::class)
            ->string('name');
    }
}