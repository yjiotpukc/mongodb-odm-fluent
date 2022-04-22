<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use Doctrine\ODM\MongoDB\Event\PreLoadEventArgs;
use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\Mapping\Traits\DocumentMappingTrait;

class LifecycleAutoMethodsMapping implements Mapping
{
    use DocumentMappingTrait;

    protected string $id;
    protected string $name;

    public function map(Document $builder): void
    {
        $builder->db('dbName');
        $builder->collection('simple');
        $builder->id();
    }

    public function preLoad(PreLoadEventArgs $eventArgs): void
    {
        $data = $eventArgs->getData();
        $this->name = $data['first_name'];
    }
}
