<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne as ReferenceOneType;

class ReferenceOne extends AbstractReference implements ReferenceOneType, Builder
{
    public function target(string $target): ReferenceOneType
    {
        $this->target = $target;

        return $this;
    }

    public function storeAsId(): ReferenceOneType
    {
        $this->storeAs = 'id';

        return $this;
    }

    public function storeAsRef(): ReferenceOneType
    {
        $this->storeAs = 'ref';

        return $this;
    }

    public function storeAsDbRef(): ReferenceOneType
    {
        $this->storeAs = 'dbRef';

        return $this;
    }

    public function storeAsDbRefWithDb(): ReferenceOneType
    {
        $this->storeAs = 'dbRefWithDb';

        return $this;
    }

    public function cascade(Cascade $cascade): ReferenceOneType
    {
        $this->cascade = $cascade;

        return $this;
    }

    public function orphanRemoval(): ReferenceOneType
    {
        $this->orphanRemoval = true;

        return $this;
    }

    public function inversedBy(string $fieldName): ReferenceOneType
    {
        $this->inversedBy = $fieldName;

        return $this;
    }

    public function mappedBy(string $fieldName): ReferenceOneType
    {
        $this->mappedBy = $fieldName;

        return $this;
    }

    public function repositoryMethod(string $methodName): ReferenceOneType
    {
        $this->repositoryMethod = $methodName;

        return $this;
    }

    public function addSort(string $field, string $order = 'asc'): ReferenceOneType
    {
        $this->sort[$field] = $order;

        return $this;
    }

    public function addCriteria(string $field, $value): ReferenceOneType
    {
        $this->criteria[$field] = $value;

        return $this;
    }

    public function skip(int $skip): ReferenceOneType
    {
        $this->skip = $skip;

        return $this;
    }

    public function notSaved(): ReferenceOneType
    {
        $this->notSaved = true;

        return $this;
    }

    public function nullable(): ReferenceOneType
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
