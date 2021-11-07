<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Type\Index;

class IndexBuilder implements Index, Builder
{
    /** @var string[] */
    protected array $keys;
    protected bool $unique = false;
    protected bool $background = false;
    protected bool $sparse = false;
    protected ?int $expireAfterSeconds = null;
    protected ?string $name = null;
    protected ?string $partialFilterExpression = null;

    /**
     * @param string|string[] $keys
     */
    public function __construct($keys = [])
    {
        if (is_string($keys)) {
            $this->keys = [$keys => 'asc'];
        } else {
            $notNumericFields = array_filter(
                array_keys($keys),
                function ($key) {
                    return !is_numeric($key);
                }
            );
            $isAssociative = count($notNumericFields) > 0;

            if (!$isAssociative) {
                $newKeys = [];
                foreach ($keys as $key) {
                    $newKeys[$key] = 'asc';
                }
                $keys = $newKeys;
            }

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
        $this->unique = true;

        return $this;
    }

    public function name(string $name): Index
    {
        $this->name = $name;

        return $this;
    }

    public function background(): Index
    {
        $this->background = true;

        return $this;
    }

    public function expireAfter(int $seconds): Index
    {
        $this->expireAfterSeconds = $seconds;

        return $this;
    }

    public function sparse(): Index
    {
        $this->sparse = true;

        return $this;
    }

    public function partialFilter(string $expression): Index
    {
        $this->partialFilterExpression = $expression;

        return $this;
    }

    public function build(ClassMetadata $metadata): void
    {
        $options = [
            'unique' => $this->unique,
            'name' => $this->name,
            'background' => $this->background,
            'expireAfterSeconds' => $this->expireAfterSeconds,
            'sparse' => $this->sparse,
            'partialFilterExpression' => $this->partialFilterExpression,
        ];

        $metadata->addIndex($this->keys, array_filter($options));
    }
}
