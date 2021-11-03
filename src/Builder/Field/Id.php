<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Id as IdType;

class Id extends BuilderField implements IdType, Builder
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
        $this->strategy = 'alNum';

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

        if ($this->type) {
            $fields['type'] = $this->type;
        }

        if ($this->strategy === 'custom') {
            $fields['options']['class'] = $this->generator;
        }

        return $fields;
    }
}
