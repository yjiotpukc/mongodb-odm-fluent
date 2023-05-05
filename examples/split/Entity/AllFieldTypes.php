<?php

declare(strict_types=1);

namespace Examples\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

class AllFieldTypes
{
    private string $id;
    private string $fieldField;
    private string $stringField;
    private int $intField;
    private float $floatField;
    private bool $boolField;
    private string $timestampField;
    private DateTime $dateField;
    private DateTimeImmutable $dateImmutableField;
    private string $decimalField;
    private array $arrayField;
    private array $hashField;
    private string $keyField;
    private string $objectIdField;
    private $rawField;
    private string $binField;
    private string $binBytearrayField;
    private string $binCustomField;
    private string $binFuncField;
    private string $binMd5Field;
    private string $binUuidField;
    private Entity $embedOne;
    private Collection $embedMany;
    private Entity $referenceOne;
    private Collection $referenceMany;
}
