<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use Doctrine\ODM\MongoDB\Event\PreLoadEventArgs;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;

class LifecycleAutoMethodsMapping implements Document
{
    protected string $id;
    protected string $name;

    public function map(DocumentMapping $builder): void
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
