<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\ImageMetadata;

class ImageMapping implements File
{
    public function map(FileMapping $builder): void
    {
        $builder->db('dbName');
        $builder->bucket('images');
        $builder->id();
        $builder->metadata()->target(ImageMetadata::class);
    }
}
