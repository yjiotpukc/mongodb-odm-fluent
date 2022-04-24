<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\File;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\ImageMetadata;

class ImageMapping implements \yjiotpukc\MongoODMFluent\Document\File
{
    public function map(File $builder): void
    {
        $builder->db('dbName');
        $builder->bucket('images');
        $builder->id();
        $builder->metadata()->target(ImageMetadata::class);
    }
}
