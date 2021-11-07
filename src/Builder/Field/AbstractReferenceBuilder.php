<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

abstract class AbstractReferenceBuilder extends AbstractField implements Builder
{
    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var string
     */
    protected $target;

    /**
     * @var string
     */
    protected $storeAs = ClassMetadata::REFERENCE_STORE_AS_DB_REF;

    /**
     * @var CascadePartial
     */
    protected $cascade;

    /**
     * @var DiscriminatorBuilder
     */
    protected $discriminator;

    /**
     * @var bool
     */
    protected $orphanRemoval = false;

    /**
     * @var string|null
     */
    protected $inversedBy;

    /**
     * @var string|null
     */
    protected $mappedBy;

    /**
     * @var string|null
     */
    protected $repositoryMethod;

    /**
     * @var string[]
     */
    protected $sort = [];

    /**
     * @var array
     */
    protected $criteria = [];

    /**
     * @var int|null
     */
    protected $skip;

    /**
     * @var bool
     */
    protected $nullable = false;

    /**
     * @var bool
     */
    protected $notSaved = false;

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
