<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanBeReadOnly;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveDiscriminator;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveEmbeds;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveFields;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveIds;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveIndex;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveInheritance;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveReferences;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveRepository;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveWriteConcern;

class DocumentBuilder extends BaseBuilder implements Buildable
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveIds;
    use CanHaveFields;
    use CanHaveReferences;
    use CanHaveEmbeds;
    use CanHaveIndex;
    use CanHaveInheritance;
    use CanHaveDiscriminator;
    use CanHaveRepository;
    use CanBeReadOnly;
    use CanHaveWriteConcern;
}
