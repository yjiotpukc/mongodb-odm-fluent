<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;

class ReferenceManyBuilder extends AbstractReferenceBuilder implements ReferenceMany, Builder
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

    public function __construct(string $fieldName, string $target = '')
    {
        parent::__construct($fieldName, $target);
        $this->prime = [];
        $this->strategy = (new CollectionStrategy())->pushAll();
    }

    public function target(string $target): ReferenceMany
    {
        $this->target = $target;

        return $this;
    }

    public function storeAsId(): ReferenceMany
    {
        $this->storeAs = 'id';

        return $this;
    }

    public function storeAsRef(): ReferenceMany
    {
        $this->storeAs = 'ref';

        return $this;
    }

    public function storeAsDbRef(): ReferenceMany
    {
        $this->storeAs = 'dbRef';

        return $this;
    }

    public function storeAsDbRefWithDb(): ReferenceMany
    {
        $this->storeAs = 'dbRefWithDb';

        return $this;
    }

    public function cascade(): Cascade
    {
        $this->cascade = new CascadePartial();

        return $this->cascade;
    }

    public function orphanRemoval(): ReferenceMany
    {
        $this->orphanRemoval = true;

        return $this;
    }

    public function inversedBy(string $fieldName): ReferenceMany
    {
        $this->inversedBy = $fieldName;

        return $this;
    }

    public function mappedBy(string $fieldName): ReferenceMany
    {
        $this->mappedBy = $fieldName;

        return $this;
    }

    public function repositoryMethod(string $methodName): ReferenceMany
    {
        $this->repositoryMethod = $methodName;

        return $this;
    }

    public function addSort(string $field, string $order = 'asc'): ReferenceMany
    {
        $this->sort[$field] = $order;

        return $this;
    }

    public function addCriteria(string $field, $value): ReferenceMany
    {
        $this->criteria[$field] = $value;

        return $this;
    }

    public function limit(int $limit): ReferenceMany
    {
        $this->limit = $limit;

        return $this;
    }

    public function skip(int $skip): ReferenceMany
    {
        $this->skip = $skip;

        return $this;
    }

    public function strategy(CollectionStrategy $strategy): ReferenceMany
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function collectionClass(string $className): ReferenceMany
    {
        $this->collectionClass = $className;

        return $this;
    }

    public function addPrime(string $primer): ReferenceMany
    {
        $this->prime[] = $primer;

        return $this;
    }

    public function notSaved(): ReferenceMany
    {
        $this->notSaved = true;

        return $this;
    }

    public function nullable(): ReferenceMany
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
