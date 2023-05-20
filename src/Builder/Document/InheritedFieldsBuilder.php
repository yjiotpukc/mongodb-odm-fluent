<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ChangeTrackingPolicyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\CollectionBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\IndexBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ReadPreferenceBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ShardBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\EmbedBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\IdBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceBuilder;
use yjiotpukc\MongoODMFluent\Builder\Method\LifecycleBuilder;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Type\ChangeTrackingPolicy;
use yjiotpukc\MongoODMFluent\Type\Collection;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Id\Id;
use yjiotpukc\MongoODMFluent\Type\Index;
use yjiotpukc\MongoODMFluent\Type\IntegerField;
use yjiotpukc\MongoODMFluent\Type\Lifecycle;
use yjiotpukc\MongoODMFluent\Type\ReadPreferenceMode;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;
use yjiotpukc\MongoODMFluent\Type\Shard;

class InheritedFieldsBuilder extends BaseBuilder implements DocumentMapping
{
    public function db(string $name): DocumentMapping
    {
        return $this;
    }

    public function repository(string $className): DocumentMapping
    {
        return $this;
    }

    public function readOnly(): DocumentMapping
    {
        return $this;
    }

    public function singleCollection(): DocumentMapping
    {
        return $this;
    }

    public function collectionPerClass(): DocumentMapping
    {
        return $this;
    }

    public function writeConcern($writeConcern): DocumentMapping
    {
        return $this;
    }

    public function readPreference(): ReadPreferenceMode
    {
        return new ReadPreferenceBuilder();
    }

    public function collection(string $name): Collection
    {
        return new CollectionBuilder($name);
    }

    public function index($keys = []): Index
    {
        return new IndexBuilder($keys);
    }

    public function discriminator(string $field): Discriminator
    {
        return new DiscriminatorBuilder($field);
    }

    public function shard(): Shard
    {
        return new ShardBuilder();
    }

    public function changeTrackingPolicy(): ChangeTrackingPolicy
    {
        return new ChangeTrackingPolicyBuilder();
    }

    public function lifecycle(): Lifecycle
    {
        return new LifecycleBuilder();
    }

    public function alsoLoad(string $method, array $fields): DocumentMapping
    {
        return $this;
    }

    public function id(): Id
    {
        return $this->addBuilder(new IdBuilder());
    }

    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne
    {
        return $this->addBuilder(ReferenceBuilder::one($fieldName, $target));
    }

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany
    {
        return $this->addBuilder(ReferenceBuilder::many($fieldName, $target));
    }

    public function embedOne(string $fieldName, ?string $target = null): EmbedOne
    {
        return $this->addBuilder(EmbedBuilder::one($fieldName, $target));
    }

    public function embedMany(string $fieldName, ?string $target = null): EmbedMany
    {
        return $this->addBuilder(EmbedBuilder::many($fieldName, $target));
    }

    public function field(string $type, string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder($type, $fieldName));
    }

    public function string(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('string', $fieldName));
    }

    public function int(string $fieldName): IntegerField
    {
        return $this->addBuilder(new FieldBuilder('int', $fieldName));
    }

    public function float(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('float', $fieldName));
    }

    public function bool(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bool', $fieldName));
    }

    public function timestamp(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('timestamp', $fieldName));
    }

    public function date(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('date', $fieldName));
    }

    public function dateImmutable(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('date_immutable', $fieldName));
    }

    public function decimal(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('decimal128', $fieldName));
    }

    public function array(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('collection', $fieldName));
    }

    public function hash(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('hash', $fieldName));
    }

    public function key(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('key', $fieldName));
    }

    public function objectId(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('object_id', $fieldName));
    }

    public function raw(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('raw', $fieldName));
    }

    public function bin(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin', $fieldName));
    }

    public function binBytearray(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_bytearray', $fieldName));
    }

    public function binCustom(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_custom', $fieldName));
    }

    public function binFunc(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_func', $fieldName));
    }

    public function binMd5(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_md5', $fieldName));
    }

    public function binUuid(string $fieldName): Field
    {
        return $this->addBuilder(new FieldBuilder('bin_uuid', $fieldName));
    }
}
