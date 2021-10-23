<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Type\Id as IdType;
use yjiotpukc\MongoODMFluent\Type\MappableField;

class Id implements IdType, MappableField
{
    protected $type;
    protected $strategy = 'auto';
    protected $generator;

    public function type(string $type): IdType
    {
        $this->type = $type;

        return $this;
    }

    public function alNum(): IdType
    {
        $this->strategy = ClassMetadata::GENERATOR_TYPE_ALNUM;

        return $this;
    }

    public function increment(): IdType
    {
        $this->strategy = 'increment';

        return $this;
    }

    public function uuid(): IdType
    {
        $this->strategy = 'uuid';

        return $this;
    }

    public function none(): IdType
    {
        $this->strategy = 'none';

        return $this;
    }

    public function custom(string $generatorClassName): IdType
    {
        $this->strategy = 'custom';
        $this->generator = $generatorClassName;

        return $this;
    }

    public function map(): array
    {
        $fields = [
            'id' => true,
            'fieldName' => 'id',
            'strategy' => $this->strategy,
        ];

        if ($this->strategy === 'custom') {
            $fields['options']['class'] = $this->generator;
        }

        return $fields;
    }
}
