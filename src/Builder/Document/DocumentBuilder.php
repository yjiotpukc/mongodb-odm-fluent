<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document;
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
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveShard;
use yjiotpukc\MongoODMFluent\Builder\Document\Traits\CanHaveWriteConcern;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;

class DocumentBuilder extends BaseBuilder implements Document, EmbeddedDocument
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveShard;
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

    public function embeddedDocument(): self
    {
        return $this->addBuilderAndReturnSelf(new EmbeddedDocumentBuilder());
    }

    public function mappedSuperclass(): self
    {
        return $this->addBuilderAndReturnSelf(new MappedSuperclassBuilder());
    }
}
