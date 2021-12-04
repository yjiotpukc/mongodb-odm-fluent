<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\FileMetadata;

class FileMetadataBuilder extends AbstractField implements FileMetadata
{
    protected string $fieldName = 'metadata';
    protected ?string $target = null;
    protected ?DiscriminatorBuilder $discriminator = null;

    public function fieldName(string $name): FileMetadataBuilder
    {
        $this->fieldName = $name;

        return $this;
    }

    public function target(string $target): FileMetadataBuilder
    {
        $this->target = $target;

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
            'targetDocument' => $this->target,
            'fieldName' => $this->fieldName,
            'name' => 'metadata',
            'nullable' => false,
            'notSaved' => false,
        ];

        if ($this->target) {
            $map['targetDocument'] = $this->target;
        }
        if ($this->discriminator) {
            $map = array_merge($map, $this->discriminator->toMapping());
        }

        return $map;
    }
}
