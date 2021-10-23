<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedOne as EmbedOneType;

class EmbedOne implements EmbedOneType
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
    public $notSaved;

    /**
     * @var Discriminator
     */
    public $discriminator = null;

    public function __construct(string $fieldName, string $target)
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
        $this->discriminator = new Discriminator($field);

        return $this->discriminator;
    }

    public function map(): array
    {
        $map = [
            'embedded' => true,
            'type' => 'one',
            'fieldName'=> $this->fieldName,
        ];

        if ($this->targetDocument) {
            $map['targetDocument'] = $this->targetDocument;
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
