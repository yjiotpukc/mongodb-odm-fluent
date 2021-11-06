<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\CollectionStrategy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany as EmbedManyType;

class EmbedMany extends BuilderField implements EmbedManyType, Builder
{
    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var string
     */
    public $targetDocument;

    /**
     * @var bool
     */
    public $notSaved = false;

    /**
     * @var \yjiotpukc\MongoODMFluent\Builder\Database\Discriminator
     */
    public $discriminator;

    /**
     * @var string
     */
    public $collectionClass;

    /**
     * @var CollectionStrategy
     */
    public $strategy;

    public function __construct(string $fieldName, string $target = '')
    {
        $this->fieldName = $fieldName;
        $this->targetDocument = $target;
    }

    public function target(string $target): EmbedManyType
    {
        $this->targetDocument = $target;

        return $this;
    }

    public function notSaved(): EmbedManyType
    {
        $this->notSaved = true;

        return $this;
    }

    public function discriminator(string $field): Discriminator
    {
        $this->discriminator = new \yjiotpukc\MongoODMFluent\Builder\Database\Discriminator($field);

        return $this->discriminator;
    }

    public function collectionClass(string $className): EmbedManyType
    {
        $this->collectionClass = $className;

        return $this;
    }

    public function strategy(CollectionStrategy $strategy): EmbedManyType
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function map(): array
    {
        $map = [
            'embedded' => true,
            'type' => 'many',
            'fieldName'=> $this->fieldName,
            'notSaved' => $this->notSaved,
        ];

        if ($this->targetDocument) {
            $map['targetDocument'] = $this->targetDocument;
        }
        if (isset($this->collectionClass)) {
            $map['collectionClass'] = $this->collectionClass;
        }
        if (isset($this->strategy)) {
            $map['strategy'] = $this->strategy->strategy;
        }
        if ($this->discriminator) {
            $map = array_merge($map, $this->discriminator->toMapping());
        }

        return $map;
    }
}
