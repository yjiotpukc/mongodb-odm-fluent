<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Builder\Field\FieldPartial;
use yjiotpukc\MongoODMFluent\Type\Discriminator as DiscriminatorType;

class Discriminator implements DiscriminatorType, Builder, FieldPartial
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string[]
     */
    protected $map;

    /**
     * @var string
     */
    protected $defaultValue;

    public function __construct(string $field)
    {
        $this->field = $field;
        $this->map = [];
    }

    public function map(string $value, string $class): DiscriminatorType
    {
        $this->map[$value] = $class;

        return $this;
    }

    public function default($value): DiscriminatorType
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
