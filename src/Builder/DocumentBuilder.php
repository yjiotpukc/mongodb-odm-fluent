<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanBeReadOnly;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDiscriminator;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveEmbeds;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveFields;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveIndex;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveInheritance;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveReferences;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveRepository;

class DocumentBuilder extends BaseBuilder implements Buildable
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveFields;
    use CanHaveReferences;
    use CanHaveEmbeds;
    use CanHaveIndex;
    use CanHaveInheritance;
    use CanHaveDiscriminator;
    use CanHaveRepository;
    use CanBeReadOnly;
}
