<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use yjiotpukc\MongoODMFluent\Type\Discriminator as DiscriminatorType;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany as ReferenceManyType;
use yjiotpukc\MongoODMFluent\Type\ValueObject\Cascade;
use yjiotpukc\MongoODMFluent\Type\ValueObject\CollectionStrategy;

class ReferenceMany extends AbstractReference implements ReferenceManyType
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * @var CollectionStrategy
     */
    protected $strategy;

    /**
     * @var string
     */
    protected $collectionClass;

    /**
     * @var string[]
     */
    protected $prime;

    public function target(string $target): ReferenceManyType
    {
        $this->target = $target;

        return $this;
    }

    public function storeAsId(): ReferenceManyType
    {
        $this->storeAs = 'id';

        return $this;
    }

    public function storeAsRef(): ReferenceManyType
    {
        $this->storeAs = 'ref';

        return $this;
    }

    public function storeAsDbRef(): ReferenceManyType
    {
        $this->storeAs = 'dbRef';

        return $this;
    }

    public function storeAsDbRefWithDb(): ReferenceManyType
    {
        $this->storeAs = 'dbRefWithDb';

        return $this;
    }

    public function cascade(Cascade $cascade): ReferenceManyType
    {
        $this->cascade = $cascade;

        return $this;
    }

    public function discriminator(string $field): DiscriminatorType
    {
        $this->discriminator = new Discriminator($field);

        return $this->discriminator;
    }

    public function orphanRemoval(): ReferenceManyType
    {
        $this->orphanRemoval = true;

        return $this;
    }

    public function inversedBy(string $fieldName): ReferenceManyType
    {
        $this->inversedBy = $fieldName;

        return $this;
    }

    public function mappedBy(string $fieldName): ReferenceManyType
    {
        $this->mappedBy = $fieldName;

        return $this;
    }

    public function repositoryMethod(string $methodName): ReferenceManyType
    {
        $this->repositoryMethod = $methodName;

        return $this;
    }

    public function addSort(string $field, string $order = 'asc'): ReferenceManyType
    {
        $this->sort[$field] = $order;

        return $this;
    }

    public function addCriteria(string $field, $value): ReferenceManyType
    {
        $this->criteria[$field] = $value;

        return $this;
    }

    public function limit(int $limit): ReferenceManyType
    {
        $this->limit = $limit;

        return $this;
    }

    public function skip(int $skip): ReferenceManyType
    {
        $this->skip = $skip;

        return $this;
    }

    public function strategy(CollectionStrategy $strategy): ReferenceManyType
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function collectionClass(string $className): ReferenceManyType
    {
        $this->collectionClass = $className;

        return $this;
    }

    public function addPrime(string $primer): ReferenceManyType
    {
        $this->prime[] = $primer;

        return $this;
    }

    public function notSaved(): ReferenceManyType
    {
        $this->notSaved = true;

        return $this;
    }

    public function nullable(): ReferenceManyType
    {
        $this->nullable = true;

        return $this;
    }

    public function map(): array
    {
        $map = parent::map();
        $map['type'] = 'many';
        $map['prime'] = $this->prime;
        $map['strategy'] = $this->strategy->strategy;

        if ($this->limit) {
            $map['limit'] = $this->limit;
        }
        if ($this->collectionClass) {
            $map['collectionClass'] = $this->collectionClass;
        }

        return $map;
    }
}
