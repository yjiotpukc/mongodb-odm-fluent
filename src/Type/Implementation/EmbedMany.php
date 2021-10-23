<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use yjiotpukc\MongoODMFluent\Type\Discriminator as DiscriminatorType;
use yjiotpukc\MongoODMFluent\Type\EmbedMany as EmbedManyType;
use yjiotpukc\MongoODMFluent\Type\ValueObject\CollectionStrategy;

class EmbedMany implements EmbedManyType
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
    public $notSaved;

    /**
     * @var Discriminator
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

    public function __construct(string $fieldName, string $target)
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

    public function discriminator(string $field): DiscriminatorType
    {
        $this->discriminator = new Discriminator($field);

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
            $map['discriminatorField'] = $this->discriminator->field;
            $map['discriminatorMap'] = $this->discriminator->map;
            if (isset($this->discriminator->defaultValue)) {
                $map['defaultDiscriminatorValue'] = $this->discriminator->defaultValue;
            }
        }

        return $map;
    }
}
