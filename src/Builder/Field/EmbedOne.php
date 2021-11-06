<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedOne as EmbedOneType;

class EmbedOne extends BuilderField implements EmbedOneType, Builder
{
    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var string
     */
    public $targetDocument = '';

    /**
     * @var bool
     */
    public $notSaved = false;

    /**
     * @var \yjiotpukc\MongoODMFluent\Builder\Database\Discriminator
     */
    public $discriminator = null;

    public function __construct(string $fieldName, string $target = '')
    {
        $this->fieldName = $fieldName;
        $this->targetDocument = $target;
    }

    public function target(string $target): EmbedOneType
    {
        $this->targetDocument = $target;

        return $this;
    }

    public function notSaved(): EmbedOneType
    {
        $this->notSaved = true;

        return $this;
    }

    public function discriminator(string $field): Discriminator
    {
        $this->discriminator = new \yjiotpukc\MongoODMFluent\Builder\Database\Discriminator($field);

        return $this->discriminator;
    }

    public function map(): array
    {
        $map = [
            'embedded' => true,
            'type' => 'one',
            'fieldName' => $this->fieldName,
            'notSaved' => $this->notSaved,
        ];

        if ($this->targetDocument) {
            $map['targetDocument'] = $this->targetDocument;
        }
        if ($this->discriminator) {
            $map = array_merge($map, $this->discriminator->toMapping());
        }

        return $map;
    }
}
