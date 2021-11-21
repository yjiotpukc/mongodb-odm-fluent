<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Mappings;

use yjiotpukc\MongoODMFluent\Builder\File;
use yjiotpukc\MongoODMFluent\Mapping\FileMapping;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\Image;
use yjiotpukc\MongoODMFluent\Tests\Integration\Resources\Entities\ImageMetadata;

class ImageMapping extends FileMapping
{
    public function mapFor(): string
    {
        return Image::class;
    }

    public function map(File $builder): void
    {
        $builder->db('dbName');
        $builder->bucket('images');
        $builder->id();
        $builder->metadata()->target(ImageMetadata::class);
    }
}
