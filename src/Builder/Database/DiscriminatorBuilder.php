<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Builder\Field\FieldPartial;
use yjiotpukc\MongoODMFluent\Type\Discriminator;

class DiscriminatorBuilder implements Discriminator, Builder, FieldPartial
{
    protected string $field;
    /** @var string[] */
    protected array $map = [];
    protected ?string $defaultValue = null;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function map(string $value, string $class): Discriminator
    {
        $this->map[$value] = $class;

        return $this;
    }

    public function default($value): Discriminator
    {
        $this->defaultValue = $value;

        return $this;
    }

    public function build(ClassMetadata $metadata): void
    {
        $metadata->setDiscriminatorField($this->field);
        $metadata->setDiscriminatorMap($this->map);
        $metadata->setDefaultDiscriminatorValue($this->defaultValue);
    }

    public function toMapping(): array
    {
        return [
            'discriminatorField' => $this->field,
            'discriminatorMap' => $this->map,
            'defaultDiscriminatorValue' => $this->defaultValue,
        ];
    }
}
