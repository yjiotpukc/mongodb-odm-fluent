<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Buildable\Buildable;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveCollection;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDb;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveDiscriminator;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveIndex;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveInheritance;
use yjiotpukc\MongoODMFluent\Builder\Traits\CanHaveRepository;

class DocumentBuilder extends BaseBuilder implements Buildable
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveIndex;
    use CanHaveInheritance;
    use CanHaveDiscriminator;
    use CanHaveRepository;

    /**
     * @var bool
     */
    protected $readOnly;

    /**
     * @var string|int|null
     */
    protected $writeConcern;

    public function build(ClassMetadata $metadata): void
    {
        if ($this->readOnly) {
            $metadata->isReadOnly = $this->readOnly;
        }
        if ($this->writeConcern) {
            $metadata->setWriteConcern($this->writeConcern);
        }

        parent::build($metadata);
    }

    public function readOnly(): DocumentBuilder
    {
        $this->readOnly = true;

        return $this;
    }

    /**
     * @param string|int|null $writeConcern
     */
    public function writeConcern($writeConcern): DocumentBuilder
    {
        $this->writeConcern = $writeConcern;

        return $this;
    }
}
