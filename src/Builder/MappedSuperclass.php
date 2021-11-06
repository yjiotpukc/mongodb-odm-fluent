<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Id;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

interface MappedSuperclass
{
    public function db(string $name): MappedSuperclass;

    public function collection(string $name): MappedSuperclass;

    public function singleCollection(): MappedSuperclass;

    public function collectionPerClass(): MappedSuperclass;

    public function repository(string $className): MappedSuperclass;

    public function readOnly(): MappedSuperclass;

    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): MappedSuperclass;

    public function id(): Id;

    public function field(string $type, string $fieldName): Field;

    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne;

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany;

    public function embedOne(string $fieldName, string $target = ''): EmbedOne;

    public function embedMany(string $fieldName, string $target = ''): EmbedMany;

    public function discriminator(string $field): Discriminator;
}
