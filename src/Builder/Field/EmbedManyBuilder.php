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
    protected string $fieldName;
    protected string $targetDocument;
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected ?string $collectionClass = null;
    protected ?DiscriminatorBuilder $discriminator = null;
    protected CollectionStrategyPartial $strategy;

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

    public function nullable(): EmbedMany
    {
        $this->nullable = true;

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
            'nullable' => $this->nullable,
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
