<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Type\Index as IndexType;

class Index implements IndexType
{
    public $keys;
    public $options;

    /**
     * @param string|string[] $keys
     */
    public function __construct($keys = [])
    {
        if (is_string($keys)) {
            $this->keys = [$keys => 'asc'];
        } else {
            $this->keys = $keys;
        }
        $this->options = [];
    }

    public function asc(string $key): IndexType
    {
        $this->keys[$key] = 'asc';

        return $this;
    }

    public function desc(string $key = ''): IndexType
    {
        if (empty($key) && count($this->keys) !== 1) {
            throw new MappingException('Index::desc without arguments can be used only if exactly one key was provided');
        }

        if (empty($key)) {
            $key = array_key_first($this->keys);
        }

        $this->keys[$key] = 'desc';

        return $this;
    }

    public function unique(): IndexType
    {
        $this->options['unique'] = true;

        return $this;
    }

    public function name(string $name): IndexType
    {
        $this->options['name'] = $name;

        return $this;
    }

    public function background(): IndexType
    {
        $this->options['background'] = true;

        return $this;
    }

    public function expireAfter(int $seconds): IndexType
    {
        $this->options['expireAfterSeconds'] = $seconds;

        return $this;
    }

    public function sparse(): IndexType
    {
        $this->options['sparse'] = true;

        return $this;
    }

    public function partialFilter(string $expression): IndexType
    {
        $this->options['partialFilterExpression'] = $expression;

        return $this;
    }
}
