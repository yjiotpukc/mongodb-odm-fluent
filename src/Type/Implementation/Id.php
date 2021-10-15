<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class Id
{
    protected $type;
    protected $strategy = 'auto';
    protected $generator;

    public function type(string $type): Id
    {
        $this->type = $type;

        return $this;
    }

    public function alNum(): Id
    {
        $this->strategy = ClassMetadata::GENERATOR_TYPE_ALNUM;

        return $this;
    }

    public function increment(): Id
    {
        $this->strategy = 'increment';

        return $this;
    }

    public function uuid(): Id
    {
        $this->strategy = 'uuid';

        return $this;
    }

    public function none(): Id
    {
        $this->strategy = 'none';

        return $this;
    }

    public function custom(string $generatorClassName): Id
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
