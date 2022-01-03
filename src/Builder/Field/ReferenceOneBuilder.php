<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

class ReferenceOneBuilder extends AbstractReferenceBuilder implements ReferenceOne
{
    public function target(string $target): ReferenceOne
    {
        $this->target = $target;

        return $this;
    }

    public function storeAsId(): ReferenceOne
    {
        $this->storeAs = 'id';

        return $this;
    }

    public function storeAsRef(): ReferenceOne
    {
        $this->storeAs = 'ref';

        return $this;
    }

    public function storeAsDbRef(): ReferenceOne
    {
        $this->storeAs = 'dbRef';

        return $this;
    }

    public function storeAsDbRefWithDb(): ReferenceOne
    {
        $this->storeAs = 'dbRefWithDb';

        return $this;
    }

    public function cascade(): Cascade
    {
        $this->cascade = new CascadePartial();

        return $this->cascade;
    }

    public function orphanRemoval(): ReferenceOne
    {
        $this->orphanRemoval = true;

        return $this;
    }

    public function inversedBy(string $fieldName): ReferenceOne
    {
        $this->inversedBy = $fieldName;

        return $this;
    }

    public function mappedBy(string $fieldName): ReferenceOne
    {
        $this->mappedBy = $fieldName;

        return $this;
    }

    public function repositoryMethod(string $methodName): ReferenceOne
    {
        $this->repositoryMethod = $methodName;

        return $this;
    }

    public function addSort(string $field, string $order = 'asc'): ReferenceOne
    {
        $this->sort[$field] = $order;

        return $this;
    }

    public function addCriteria(string $field, $value): ReferenceOne
    {
        $this->criteria[$field] = $value;

        return $this;
    }

    public function skip(int $skip): ReferenceOne
    {
        $this->skip = $skip;

        return $this;
    }

    public function notSaved(): ReferenceOne
    {
        $this->notSaved = true;

        return $this;
    }

    public function nullable(): ReferenceOne
    {
        $this->nullable = true;

        return $this;
    }

    public function map(): array
    {
        $map = parent::map();
        $map['type'] = 'one';

        return $map;
    }
}
