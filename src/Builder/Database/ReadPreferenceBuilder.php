<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Database;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Builder;
use yjiotpukc\MongoODMFluent\MappingException;
use yjiotpukc\MongoODMFluent\Type\ReadPreference;
use yjiotpukc\MongoODMFluent\Type\ReadPreferenceMode;

class ReadPreferenceBuilder implements Builder, ReadPreferenceMode, ReadPreference
{
    protected string $mode;
    protected array $tags = [];

    public function primary(): ReadPreference
    {
        $this->mode = 'primary';

        return $this;
    }

    public function primaryPreferred(): ReadPreference
    {
        $this->mode = 'primaryPreferred';

        return $this;
    }

    public function secondary(): ReadPreference
    {
        $this->mode = 'secondary';

        return $this;
    }

    public function secondaryPreferred(): ReadPreference
    {
        $this->mode = 'secondaryPreferred';

        return $this;
    }

    public function nearest(): ReadPreference
    {
        $this->mode = 'nearest';

        return $this;
    }

    public function tagSpecification(array $tagDocument): ReadPreferenceBuilder
    {
        $this->tags[] = $tagDocument;

        return $this;
    }

    public function tagSet(array $tags): ReadPreferenceBuilder
    {
        $this->tags = $tags;

        return $this;
    }

    public function any(): ReadPreference
    {
        $this->tags[] = [];

        return $this;
    }

    public function build(ClassMetadata $metadata): void
    {
        if (!isset($this->mode)) {
            throw new MappingException('Mode is required for read preference');
        }

        $metadata->setReadPreference($this->mode, $this->tags);
    }
}
