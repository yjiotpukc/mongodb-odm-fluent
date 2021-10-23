<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

use yjiotpukc\MongoODMFluent\Type\ValueObject\Cascade;

interface ReferenceOne
{
    public function __construct(string $fieldName, string $target);

    public function target(string $target): ReferenceOne;

    public function storeAsId(): ReferenceOne;

    public function storeAsRef(): ReferenceOne;

    /**
     * @deprecated in MongoDB ODM. Use ref instead.
     * @see https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/2.2/reference/annotations-reference.html#referenceone
     */
    public function storeAsDbRef(): ReferenceOne;

    /**
     * @deprecated in MongoDB ODM. Use ref instead.
     * @see https://www.doctrine-project.org/projects/doctrine-mongodb-odm/en/2.2/reference/annotations-reference.html#referenceone
     */
    public function storeAsDbRefWithDb(): ReferenceOne;

    public function cascade(Cascade $cascade): ReferenceOne;

    public function discriminator(Discriminator $discriminator): ReferenceOne;

    public function orphanRemoval(): ReferenceOne;

    public function inversedBy(string $fieldName): ReferenceOne;

    public function mappedBy(string $fieldName): ReferenceOne;

    public function repositoryMethod(string $methodName): ReferenceOne;

    public function addSort(string $field, string $order = 'asc'): ReferenceOne;

    public function addCriteria(string $field, $value): ReferenceOne;

    public function skip(int $skip): ReferenceOne;

    public function notSaved(): ReferenceOne;

    public function nullable(): ReferenceOne;
}
