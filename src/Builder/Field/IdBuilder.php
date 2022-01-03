<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Type\Id\Id;
use yjiotpukc\MongoODMFluent\Type\Id\IdAlNum;
use yjiotpukc\MongoODMFluent\Type\Id\IdCustom;
use yjiotpukc\MongoODMFluent\Type\Id\IdIncrement;
use yjiotpukc\MongoODMFluent\Type\Id\IdNone;
use yjiotpukc\MongoODMFluent\Type\Id\IdUuid;

class IdBuilder extends AbstractField implements Id, IdAlNum, IdUuid, IdIncrement, IdCustom, IdNone
{
    protected string $type = 'id';
    protected string $fieldName = 'id';
    protected string $strategy = 'auto';
    protected bool $nullable = false;
    protected bool $notSaved = false;
    protected ?string $generator = null;
    protected int $incrementStartingId = 1;
    protected ?string $incrementKey = null;
    protected ?string $incrementCollection = null;
    protected ?string $uuidSalt = null;
    protected int $alNumPadding = 0;
    protected bool $alNumAwkwardSafeMode = false;
    protected ?string $alNumChars = null;
    protected array $customGeneratorOptions = [];

    public function type(string $type): IdBuilder
    {
        $this->type = $type;

        return $this;
    }

    public function fieldName(string $fieldName): IdBuilder
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    public function alNum(): IdBuilder
    {
        $this->strategy = 'alNum';
        $this->type = 'custom_id';

        return $this;
    }

    public function increment(): IdBuilder
    {
        $this->strategy = 'increment';
        $this->type = 'int';

        return $this;
    }

    public function uuid(): IdBuilder
    {
        $this->strategy = 'uuid';
        $this->type = 'custom_id';

        return $this;
    }

    public function none(): IdNone
    {
        $this->strategy = 'none';
        $this->type = 'custom_id';

        return $this;
    }

    public function custom(string $generatorClassName): IdBuilder
    {
        $this->strategy = 'custom';
        $this->type = 'custom_id';
        $this->generator = $generatorClassName;

        return $this;
    }

    public function nullable(): IdBuilder
    {
        $this->nullable = true;

        return $this;
    }

    public function notSaved(): IdBuilder
    {
        $this->notSaved = true;

        return $this;
    }

    public function key(string $key): IdBuilder
    {
        $this->incrementKey = $key;

        return $this;
    }

    public function collection(string $collection): IdBuilder
    {
        $this->incrementCollection = $collection;

        return $this;
    }

    public function startingId(int $startingId): IdBuilder
    {
        $this->incrementStartingId = $startingId;

        return $this;
    }

    public function salt(string $salt): IdBuilder
    {
        $this->uuidSalt = $salt;

        return $this;
    }

    public function pad(int $padding): IdBuilder
    {
        $this->alNumPadding = $padding;

        return $this;
    }

    public function chars(string $chars): IdBuilder
    {
        $this->alNumChars = $chars;

        return $this;
    }

    public function awkwardSafeMode(): IdBuilder
    {
        $this->alNumAwkwardSafeMode = true;

        return $this;
    }

    public function generatorOption(string $key, string $value): IdCustom
    {
        $this->customGeneratorOptions[$key] = $value;

        return $this;
    }

    public function map(): array
    {
        $fields = [
            'id' => true,
            'fieldName' => $this->fieldName,
            'strategy' => $this->strategy,
            'nullable' => $this->nullable,
            'notSaved' => $this->notSaved,
        ];

        if ($this->type) {
            $fields['type'] = $this->type;
        }

        if ($this->strategy === 'increment') {
            $fields['options'] = $this->getIncrementGeneratorOptions();
        } elseif ($this->strategy === 'uuid') {
            $fields['options'] = $this->getUuidGeneratorOptions();
        } elseif ($this->strategy === 'alNum') {
            $fields['options'] = $this->getAlNumGeneratorOptions();
        } elseif ($this->strategy === 'custom') {
            $fields['options'] = $this->getCustomGeneratorOptions();
        }

        return $fields;
    }

    protected function getIncrementGeneratorOptions(): array
    {
        $options = ['startingId' => $this->incrementStartingId];
        if ($this->incrementCollection) {
            $options['collection'] = $this->incrementCollection;
        }
        if ($this->incrementKey) {
            $options['key'] = $this->incrementKey;
        }

        return $options;
    }

    protected function getUuidGeneratorOptions(): array
    {
        $options = [];
        if ($this->uuidSalt) {
            $options['salt'] = $this->uuidSalt;
        }

        return $options;
    }

    protected function getAlNumGeneratorOptions(): array
    {
        $options = ['awkwardSafe' => $this->alNumAwkwardSafeMode];

        if ($this->alNumPadding) {
            $options['pad'] = $this->alNumPadding;
        }
        if ($this->alNumChars) {
            $options['chars'] = $this->alNumChars;
        }

        return $options;
    }

    protected function getCustomGeneratorOptions(): array
    {
        $options = $this->customGeneratorOptions;
        $options['class'] = $this->generator;

        return $options;
    }
}
