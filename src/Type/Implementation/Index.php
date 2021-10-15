<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Implementation;

use yjiotpukc\MongoODMFluent\MappingException;

class Index
{
    protected $keys;
    protected $options;

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
    }

    public function asc(string $key): Index
    {
        $this->keys[$key] = 'asc';

        return $this;
    }

    public function desc(string $key = ''): Index
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

    public function unique(): Index
    {
        $this->options['unique'] = true;

        return $this;
    }

    public function name(string $name): Index
    {
        $this->options['name'] = $name;

        return $this;
    }

    public function background(): Index
    {
        $this->options['background'] = true;

        return $this;
    }

    public function expireAfter(int $seconds): Index
    {
        $this->options['expireAfterSeconds'] = $seconds;

        return $this;
    }

    public function sparse(): Index
    {
        $this->options['sparse'] = true;

        return $this;
    }

    public function partialFilter(string $expression): Index
    {
        $this->options['partialFilterExpression'] = $expression;

        return $this;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'keys':
                return $this->keys;
            case 'options':
                return $this->options;
        }

        throw new MappingException("Unknown field {$name} in Index");
    }
}
