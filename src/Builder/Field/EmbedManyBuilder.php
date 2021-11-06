<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;

class EmbedManyBuilder extends AbstractField implements EmbedMany, Builder
{
    /**
     * @var string
     */
    public $targetDocument;

    /**
     * @var bool
     */
    public $notSaved = false;

    /**
     * @var DiscriminatorBuilder
     */
    public $discriminator;

    /**
     * @var string
     */
    public $collectionClass;

    /**
     * @var CollectionStrategyPartial
     */
    public $strategy;

    /**
     * @var string
     */
    protected $fieldName;

    public function __construct(string $fieldName, string $target = '')
    {
        $this->fieldName = $fieldName;
        $this->targetDocument = $target;
        $this->strategy = new CollectionStrategyPartial();
    }

    public function target(string $target): EmbedMany
    {
        $this->targetDocument = $target;

        return $this;
    }

    public function notSaved(): EmbedMany
    {
        $this->notSaved = true;

        return $this;
    }

    public function discriminator(string $field): Discriminator
    {
        $this->discriminator = new DiscriminatorBuilder($field);

        return $this->discriminator;
    }

    public function collectionClass(string $className): EmbedMany
    {
        $this->collectionClass = $className;

        return $this;
    }

    public function strategy(): CollectionStrategy
    {
        return $this->strategy;
    }

    public function map(): array
    {
        $map = [
            'embedded' => true,
            'type' => 'many',
            'fieldName' => $this->fieldName,
            'notSaved' => $this->notSaved,
        ];

        if ($this->targetDocument) {
            $map['targetDocument'] = $this->targetDocument;
        }
        if (isset($this->collectionClass)) {
            $map['collectionClass'] = $this->collectionClass;
        }
        $map = array_merge($map, $this->strategy->toMapping());
        if ($this->discriminator) {
            $map = array_merge($map, $this->discriminator->toMapping());
        }

        return $map;
    }
}
