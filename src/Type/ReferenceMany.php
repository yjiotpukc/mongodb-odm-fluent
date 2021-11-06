<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface ReferenceMany
{
    public function __construct(string $fieldName, string $target);

    public function target(string $target): ReferenceMany;

    public function storeAsId(): ReferenceMany;

    public function storeAsRef(): ReferenceMany;

    /**
     * @deprecated in MongoDB ODM. Use ref instead.
     * @see https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/2.2/reference/annotations-reference.html#referencemany
     */
    public function storeAsDbRef(): ReferenceMany;

    /**
     * @deprecated in MongoDB ODM. Use ref instead.
     * @see https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/2.2/reference/annotations-reference.html#referencemany
     */
    public function storeAsDbRefWithDb(): ReferenceMany;

    public function cascade(): Cascade;

    public function discriminator(string $field): Discriminator;

    public function orphanRemoval(): ReferenceMany;

    public function inversedBy(string $fieldName): ReferenceMany;

    public function mappedBy(string $fieldName): ReferenceMany;

    public function repositoryMethod(string $methodName): ReferenceMany;

    public function addSort(string $field, string $order = 'asc'): ReferenceMany;

    public function addCriteria(string $field, $value): ReferenceMany;

    public function limit(int $limit): ReferenceMany;

    public function skip(int $skip): ReferenceMany;

    public function strategy(): CollectionStrategy;

    public function collectionClass(string $className): ReferenceMany;

    public function addPrime(string $primer): ReferenceMany;

    public function notSaved(): ReferenceMany;

    public function nullable(): ReferenceMany;
}
