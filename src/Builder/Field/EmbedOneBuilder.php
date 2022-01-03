<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;

class EmbedOneBuilder extends AbstractField implements EmbedOne
{
    protected string $fieldName;
    protected string $targetDocument;
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected ?DiscriminatorBuilder $discriminator = null;

    public function __construct(string $fieldName, string $target = '')
    {
        $this->fieldName = $fieldName;
        $this->targetDocument = $target;
    }

    public function target(string $target): EmbedOne
    {
        $this->targetDocument = $target;

        return $this;
    }

    public function nullable(): EmbedOne
    {
        $this->nullable = true;

        return $this;
    }

    public function notSaved(): EmbedOne
    {
        $this->notSaved = true;

        return $this;
    }

    public function discriminator(string $field): Discriminator
    {
        $this->discriminator = new DiscriminatorBuilder($field);

        return $this->discriminator;
    }

    public function map(): array
    {
        $map = [
            'embedded' => true,
            'type' => 'one',
            'fieldName' => $this->fieldName,
            'nullable' => $this->nullable,
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
