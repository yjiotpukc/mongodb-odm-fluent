<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder;

use yjiotpukc\MongoODMFluent\Type\Collection;
use yjiotpukc\MongoODMFluent\Type\Discriminator;
use yjiotpukc\MongoODMFluent\Type\EmbedMany;
use yjiotpukc\MongoODMFluent\Type\EmbedOne;
use yjiotpukc\MongoODMFluent\Type\Field;
use yjiotpukc\MongoODMFluent\Type\Id\Id;
use yjiotpukc\MongoODMFluent\Type\Index;
use yjiotpukc\MongoODMFluent\Type\ReferenceMany;
use yjiotpukc\MongoODMFluent\Type\ReferenceOne;

interface Document
{
    public function db(string $name): Document;

    public function collection(string $name): Collection;

    public function singleCollection(): Document;

    public function collectionPerClass(): Document;

    public function repository(string $className): Document;

    public function readOnly(): Document;

    /**
     * @param int|string|null $writeConcern
     */
    public function writeConcern($writeConcern): Document;

    public function id(): Id;

    public function field(string $type, string $fieldName): Field;

    public function referenceOne(string $fieldName, string $target = ''): ReferenceOne;

    public function referenceMany(string $fieldName, string $target = ''): ReferenceMany;

    public function embedOne(string $fieldName, string $target = ''): EmbedOne;

    public function embedMany(string $fieldName, string $target = ''): EmbedMany;

    public function discriminator(string $field): Discriminator;

    /**
     * @param string|string[] $keys
     * @return Index
     */
    public function index($keys = []): Index;
}
