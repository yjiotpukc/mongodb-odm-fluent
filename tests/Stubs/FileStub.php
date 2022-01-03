<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Stubs;

use DateTime;

class FileStub
{
    private string $id;
    private string $filenameCustom;
    private DateTime $uploadDateCustom;
    private int $lengthCustom;
    private int $chunkSizeCustom;
    private AnotherEntityStub $metadata;
    private AnotherEntityStub $metadataCustom;
}
