<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

class ReferenceBuilder extends AbstractField implements ReferenceOne, ReferenceMany
{
    protected string $type;
    protected ?string $target;
    protected string $storeAs = ClassMetadata::REFERENCE_STORE_AS_DB_REF;
    protected bool $orphanRemoval = false;
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected array $criteria = [];
    protected ?string $inversedBy = null;
    protected ?string $mappedBy = null;
    protected ?string $repositoryMethod = null;
    protected ?int $skip = null;
    protected ?int $limit = null;
    protected ?CascadePartial $cascade = null;
    protected ?DiscriminatorBuilder $discriminator = null;
    /** @var string[] */
    protected array $sort = [];
    protected CollectionStrategyPartial $strategy;
    protected ?string $collectionClass = null;
    /** @var string[] */
    protected array $prime = [];

    protected function __construct(string $fieldName, ?string $target)
    {
        $this->fieldName = $fieldName;
        $this->target = $target;
        $this->strategy = new CollectionStrategyPartial();
    }

    public static function one(string $fieldName, ?string $target = null): ReferenceBuilder
    {
        $referenceBuilder = new static($fieldName, $target);
        $referenceBuilder->type = 'one';

        return $referenceBuilder;
    }

    public static function many(string $fieldName, ?string $target = null): ReferenceBuilder
    {
        $referenceBuilder = new static($fieldName, $target);
        $referenceBuilder->type = 'many';

        return $referenceBuilder;
    }

    public function target(string $target): ReferenceBuilder
    {
        $this->target = $target;

        return $this;
    }

    public function storeAsId(): ReferenceBuilder
    {
        $this->storeAs = 'id';

        return $this;
    }

    public function storeAsRef(): ReferenceBuilder
    {
        $this->storeAs = 'ref';

        return $this;
    }

    public function storeAsDbRef(): ReferenceBuilder
    {
        $this->storeAs = 'dbRef';

        return $this;
    }

    public function storeAsDbRefWithDb(): ReferenceBuilder
    {
        $this->storeAs = 'dbRefWithDb';

        return $this;
    }

    public function cascade(): Cascade
    {
        $this->cascade = new CascadePartial();

        return $this->cascade;
    }

    public function orphanRemoval(): ReferenceBuilder
    {
        $this->orphanRemoval = true;

        return $this;
    }

    public function inversedBy(string $fieldName): ReferenceBuilder
    {
        $this->inversedBy = $fieldName;

        return $this;
    }

    public function mappedBy(string $fieldName): ReferenceBuilder
    {
        $this->mappedBy = $fieldName;

        return $this;
    }

    public function repositoryMethod(string $methodName): ReferenceBuilder
    {
        $this->repositoryMethod = $methodName;

        return $this;
    }

    public function addSort(string $field, string $order = 'asc'): ReferenceBuilder
    {
        $this->sort[$field] = $order;

        return $this;
    }

    public function addCriteria(string $field, $value): ReferenceBuilder
    {
        $this->criteria[$field] = $value;

        return $this;
    }

    public function limit(int $limit): ReferenceBuilder
    {
        $this->limit = $limit;

        return $this;
    }

    public function skip(int $skip): ReferenceBuilder
    {
        $this->skip = $skip;

        return $this;
    }

    public function strategy(): CollectionStrategy
    {
        return $this->strategy;
    }

    public function collectionClass(string $className): ReferenceBuilder
    {
        $this->collectionClass = $className;

        return $this;
    }

    public function addPrime(string $primer): ReferenceBuilder
    {
        $this->prime[] = $primer;

        return $this;
    }

    public function notSaved(): ReferenceBuilder
    {
        $this->notSaved = true;

        return $this;
    }

    public function nullable(): ReferenceBuilder
    {
        $this->nullable = true;

        return $this;
    }

    public function discriminator(string $field): Discriminator
    {
        $this->discriminator = new DiscriminatorBuilder($field);

        return $this->discriminator;
    }

    public function map(): array
    {
        $map = [
            'reference' => true,
            'type' => $this->type,
            'name' => $this->fieldName,
            'targetDocument' => $this->target,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
            'storeAs' => $this->storeAs,
            'orphanRemoval' => $this->orphanRemoval,
            'sort' => $this->sort,
            'criteria' => $this->criteria,
            'value' => null,
            'options' => [],
            'discriminatorField' => null,
            'discriminatorMap' => null,
            'defaultDiscriminatorValue' => null,
            'inversedBy' => $this->inversedBy,
            'mappedBy' => $this->mappedBy,
            'repositoryMethod' => $this->repositoryMethod,
            'skip' => $this->skip,
            'limit' => $this->limit,
        ];

        $map['cascade'] = $this->cascade ? $this->cascade->toMapping()['cascade'] : null;

        if ($this->type === 'many') {
            $map = array_merge($map, $this->strategy->toMapping());
            $map['collectionClass'] = $this->collectionClass;
            $map['prime'] = $this->prime;
        }
        if ($this->target) {
            $map['targetDocument'] = $this->target;
        } else {
            $map['targetDocument'] = null;
            $map['discriminatorField'] = '_doctrine_class_name';
        }
        if ($this->discriminator) {
            $map = array_merge($map, $this->discriminator->toMapping());
        }

        return $map;
    }
}
