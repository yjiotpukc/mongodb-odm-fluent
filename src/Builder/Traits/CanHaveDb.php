<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Traits;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

trait CanHaveDb
{
    /**
     * @var string
     */
    protected $db;

    public function db(string $name): self
    {
        $this->db = $name;

        return $this;
    }

    protected function buildDb(ClassMetadata $metadata)
    {
        if ($this->db) {
            $metadata->setDatabase($this->db);
        }
    }
}
