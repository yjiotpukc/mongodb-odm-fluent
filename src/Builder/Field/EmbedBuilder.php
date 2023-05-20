<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;

class EmbedBuilder extends AbstractField implements EmbedOne, EmbedMany
{
    protected string $type;
    protected ?string $targetDocument;
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected ?string $collectionClass = null;
    protected ?DiscriminatorBuilder $discriminator = null;
    protected CollectionStrategyPartial $strategy;

    protected function __construct(string $type, string $fieldName, ?string $target)
    {
        $this->type = $type;
        $this->fieldName = $fieldName;
        $this->targetDocument = $target;
        $this->strategy = new CollectionStrategyPartial();
    }

    public static function one(string $fieldName, ?string $target = null): EmbedBuilder
    {
        return new static('one', $fieldName, $target);
    }

    public static function many(string $fieldName, ?string $target = null): EmbedBuilder
    {
        return new static('many', $fieldName, $target);
    }

    public function target(string $target): EmbedBuilder
    {
        $this->targetDocument = $target;

        return $this;
    }

    public function nullable(): EmbedBuilder
    {
        $this->nullable = true;

        return $this;
    }

    public function notSaved(): EmbedBuilder
    {
        $this->notSaved = true;

        return $this;
    }

    public function discriminator(string $field): Discriminator
    {
        $this->discriminator = new DiscriminatorBuilder($field);

        return $this->discriminator;
    }

    public function collectionClass(string $className): EmbedBuilder
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
            'type' => $this->type,
            'fieldName' => $this->fieldName,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
            'value' => null,
            'options' => [],
            'discriminatorField' => null,
            'discriminatorMap' => null,
            'defaultDiscriminatorValue' => null,
        ];

        if ($this->targetDocument) {
            $map['targetDocument'] = $this->targetDocument;
        }

        if ($this->discriminator) {
            $map = array_merge($map, $this->discriminator->toMapping());
        }

        if ($this->type === 'many') {
            $map['collectionClass'] = $this->collectionClass;
            $map = array_merge($map, $this->strategy->toMapping());
        }

        return $map;
    }
}
