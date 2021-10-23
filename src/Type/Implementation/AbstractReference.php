<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Cascade;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\MappableField;

class AbstractReference implements MappableField
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
    protected $storeAs;

    /**
     * @var Cascade
     */
    protected $cascade;

    /**
     * @var Discriminator
     */
    protected $discriminator;

    /**
     * @var bool
     */
    protected $orphanRemoval;

    /**
     * @var string
     */
    protected $inversedBy;

    /**
     * @var string
     */
    protected $mappedBy;

    /**
     * @var string
     */
    protected $repositoryMethod;

    /**
     * @var string[]
     */
    protected $sort;

    /**
     * @var array
     */
    protected $criteria;

    /**
     * @var int
     */
    protected $skip;

    /**
     * @var bool
     */
    protected $notSaved;

    /**
     * @var bool
     */
    protected $nullable;

    public function __construct(string $fieldName, string $target)
    {
        $this->fieldName = $fieldName;
        $this->target = $target;
        $this->notSaved = false;
        $this->nullable = false;
        $this->orphanRemoval = false;
        $this->storeAs = ClassMetadata::REFERENCE_STORE_AS_DB_REF;
        $this->sort = [];
        $this->criteria = [];
    }

    public function map(): array
    {
        $map = [
            'reference'     => true,
            'name'          => $this->fieldName,
            'notSaved'      => $this->notSaved,
            'nullable'      => $this->nullable,
            'storeAs'       => $this->storeAs,
            'orphanRemoval' => $this->orphanRemoval,
            'sort'          => $this->sort,
            'criteria'      => $this->criteria,
        ];

        if ($this->target) {
            $map['targetDocument'] = $this->target;
        }
        if ($this->cascade) {
            $map['cascade'] = $this->cascade->cascades;
        }
        if ($this->discriminator) {
            $map['discriminatorField'] = $this->discriminator->field;
            $map['discriminatorMap'] = $this->discriminator->map;
            $map['defaultDiscriminatorValue'] = $this->discriminator->defaultValue;
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
