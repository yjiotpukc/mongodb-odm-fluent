<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use yjiotpukc\MongoODMFluent\Type\ChangeTrackingPolicy;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Id\Id;
use yjiotpukc\MongoODMFluent\Type\Index;
use yjiotpukc\MongoODMFluent\Type\IntegerField;
use yjiotpukc\MongoODMFluent\Type\Lifecycle;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

interface EmbeddedDocumentMapping
{
    public function readOnly(): EmbeddedDocumentMapping;

    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index;

    public function discriminator(string $field): Discriminator;

    public function changeTrackingPolicy(): ChangeTrackingPolicy;

    public function lifecycle(): Lifecycle;

    public function alsoLoad(string $method, array $fields): EmbeddedDocumentMapping;

    public function id(): Id;

    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne;

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany;

    public function embedOne(string $fieldName, string $target = ''): EmbedOne;

    public function embedMany(string $fieldName, string $target = ''): EmbedMany;

    public function field(string $type, string $fieldName): Field;

    public function string(string $fieldName): Field;

    public function int(string $fieldName): IntegerField;

    public function float(string $fieldName): Field;

    public function bool(string $fieldName): Field;

    public function timestamp(string $fieldName): Field;

    public function date(string $fieldName): Field;

    public function dateImmutable(string $fieldName): Field;

    public function decimal(string $fieldName): Field;

    public function array(string $fieldName): Field;

    public function hash(string $fieldName): Field;

    public function key(string $fieldName): Field;

    public function objectId(string $fieldName): Field;

    public function raw(string $fieldName): Field;

    public function bin(string $fieldName): Field;

    public function binBytearray(string $fieldName): Field;

    public function binCustom(string $fieldName): Field;

    public function binFunc(string $fieldName): Field;

    public function binMd5(string $fieldName): Field;

    public function binUuid(string $fieldName): Field;
}
