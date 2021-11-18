<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Document;

use yjiotpukc\MongoODMFluent\Builder\BaseBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ChangeTrackingPolicyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\CollectionBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\DbBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\DiscriminatorBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\IndexBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\InheritanceBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ReadOnlyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ReadPreferenceBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\RepositoryClassBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\ShardBuilder;
use yjiotpukc\MongoODMFluent\Builder\Database\WriteConcernBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document;
use yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Builder\Field\EmbedManyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\EmbedOneBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\FieldBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\IdBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceManyBuilder;
use yjiotpukc\MongoODMFluent\Builder\Field\ReferenceOneBuilder;
use yjiotpukc\MongoODMFluent\Type\ChangeTrackingPolicy;
use yjiotpukc\MongoODMFluent\Type\Collection;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Id\Id;
use yjiotpukc\MongoODMFluent\Type\Index;
use yjiotpukc\MongoODMFluent\Type\IntegerField;
use yjiotpukc\MongoODMFluent\Type\ReadPreferenceMode;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;
use yjiotpukc\MongoODMFluent\Type\Shard;

class DocumentBuilder extends BaseBuilder implements Document, EmbeddedDocument
{
    public function embeddedDocument(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new EmbeddedDocumentBuilder());
    }

    public function mappedSuperclass(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new MappedSuperclassBuilder());
    }

    public function db(string $name): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new DbBuilder($name));
    }

    public function repository(string $className): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new RepositoryClassBuilder($className));
    }

    public function readOnly(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new ReadOnlyBuilder());
    }

    public function singleCollection(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(InheritanceBuilder::singleCollection());
    }

    public function collectionPerClass(): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(InheritanceBuilder::collectionPerClass());
    }

    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): DocumentBuilder
    {
        return $this->addBuilderAndReturnSelf(new WriteConcernBuilder($writeConcern));
    }

    public function readPreference(): ReadPreferenceMode
    {
        return $this->addBuilder(new ReadPreferenceBuilder());
    }

    public function collection(string $name): Collection
    {
        return $this->addBuilder(new CollectionBuilder($name));
    }

    /**
     * @param string|string[] $keys
     */
    public function index($keys = []): Index
    {
        return $this->addBuilder(new IndexBuilder($keys));
    }

    public function discriminator(string $field): Discriminator
    {
        return $this->addBuilder(new DiscriminatorBuilder($field));
    }

    public function shard(): Shard
    {
        return $this->addBuilder(new ShardBuilder());
    }

    public function changeTrackingPolicy(): ChangeTrackingPolicy
    {
        return $this->addBuilder(new ChangeTrackingPolicyBuilder());
    }

    public function id(): Id
    {
        return $this->addBuilder(new IdBuilder());
    }

    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne
    {
        return $this->addBuilder(new ReferenceOneBuilder($fieldName, $target));
    }

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany
    {
        return $this->addBuilder(new ReferenceManyBuilder($fieldName, $target));
    }

    public function embedOne(string $fieldName, string $target = ''): EmbedOne
    {
        return $this->addBuilder(new EmbedOneBuilder($fieldName, $target));
    }

    public function embedMany(string $fieldName, string $target = ''): EmbedMany
    {
        return $this->addBuilder(new EmbedManyBuilder($fieldName, $target));
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
        return $this->addBuilder(new FieldBuilder('boolean', $fieldName));
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
