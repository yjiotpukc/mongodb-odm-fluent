<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\Type\Id;

class IdBuilder extends AbstractField implements Id, Builder
{
    protected string $type = 'id';
    protected string $strategy = 'auto';
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected ?string $generator = null;

    public function type(string $type): Id
    {
        $this->type = $type;

        return $this;
    }

    public function alNum(): Id
    {
        $this->strategy = 'alNum';
        $this->type = 'custom_id';

        return $this;
    }

    public function increment(): Id
    {
        $this->strategy = 'increment';
        $this->type = 'int';

        return $this;
    }

    public function uuid(): Id
    {
        $this->strategy = 'uuid';
        $this->type = 'custom_id';

        return $this;
    }

    public function none(): Id
    {
        $this->strategy = 'none';
        $this->type = 'custom_id';

        return $this;
    }

    public function custom(string $generatorClassName): Id
    {
        $this->strategy = 'custom';
        $this->type = 'custom_id';
        $this->generator = $generatorClassName;

        return $this;
    }

    public function nullable(): Id
    {
        $this->nullable = true;

        return $this;
    }

    public function notSaved(): Id
    {
        $this->notSaved = true;

        return $this;
    }

    public function map(): array
    {
        $fields = [
            'id' => true,
            'fieldName' => 'id',
            'strategy' => $this->strategy,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
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
