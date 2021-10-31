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

class DocumentBuilder extends BaseBuilder implements Buildable
{
    use CanHaveDb;
    use CanHaveCollection;
    use CanHaveIndex;
    use CanHaveInheritance;
    use CanHaveDiscriminator;

    /**
     * @var string
     */
    protected $repositoryClass;

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
        $this->buildDb($metadata);
        $this->buildCollection($metadata);
        $this->buildInheritance($metadata);
        $this->buildDiscriminator($metadata);

        if ($this->repositoryClass) {
            $metadata->setCustomRepositoryClass($this->repositoryClass);
        }
        if ($this->readOnly) {
            $metadata->isReadOnly = $this->readOnly;
        }
        if ($this->writeConcern) {
            $metadata->setWriteConcern($this->writeConcern);
        }

        parent::build($metadata);
    }

    public function repository(string $className): DocumentBuilder
    {
        $this->repositoryClass = $className;

        return $this;
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
