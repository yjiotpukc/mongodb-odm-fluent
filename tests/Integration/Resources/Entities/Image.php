<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities;

use DateTime;

class Image
{
    private string $id;
    private string $filename;
    private DateTime $uploadDate;
    private int $length;
    private int $chunkSize;
    private ImageMetadata $metadata;
}
