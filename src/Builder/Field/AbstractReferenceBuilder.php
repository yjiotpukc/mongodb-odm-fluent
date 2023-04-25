<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

abstract class AbstractReferenceBuilder extends AbstractField
{
    protected string $target;
    protected string $storeAs = ClassMetadata::REFERENCE_STORE_AS_DB_REF;
    protected bool $orphanRemoval = false;
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected array $criteria = [];
    protected ?string $inversedBy = null;
    protected ?string $mappedBy = null;
    protected ?string $repositoryMethod = null;
    protected ?int $skip = null;
    protected ?CascadePartial $cascade = null;
    protected ?DiscriminatorBuilder $discriminator = null;
    /** @var string[] */
    protected array $sort = [];

    public function __construct(string $fieldName, string $target = '')
    {
        $this->fieldName = $fieldName;
        $this->target = $target;
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
            'name' => $this->fieldName,
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
            'collectionClass' => null,
        ];

        if ($this->target) {
            $map['targetDocument'] = $this->target;
        }
        if ($this->cascade) {
            $map = array_merge($map, $this->cascade->toMapping());
        }
        if ($this->discriminator) {
            $map = array_merge($map, $this->discriminator->toMapping());
        }
        if ($this->inversedBy) {
            $map['inversedBy'] = $this->inversedBy;
        }
        if ($this->mappedBy) {
            $map['mappedBy'] = $this->mappedBy;
        }
        if ($this->repositoryMethod) {
            $map['repositoryMethod'] = $this->repositoryMethod;
        }
        if ($this->skip) {
            $map['skip'] = $this->skip;
        }

        return $map;
    }
}
