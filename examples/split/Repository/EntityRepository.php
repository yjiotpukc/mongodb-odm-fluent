<?php

declare(strict_types=1);

namespace Examples\Repository;

use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class EntityRepository extends DocumentRepository
{
    public function findEntities(): array
    {
        return $this->findAll();
    }
}
