<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\FluentBuilderFactory;

use yjiotpukc\MongoODMFluent\Fluent\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Fluent\EmbeddedDocumentBuilder;
use yjiotpukc\MongoODMFluent\Fluent\FluentBuilder;
use yjiotpukc\MongoODMFluent\Fluent\MappedSuperclassBuilder;
use yjiotpukc\MongoODMFluent\Mapping\DocumentMapping;
use yjiotpukc\MongoODMFluent\Mapping\EmbeddedDocumentMapping;
use yjiotpukc\MongoODMFluent\Mapping\MappedSuperclassMapping;
use yjiotpukc\MongoODMFluent\Mapping\Mapping;
use yjiotpukc\MongoODMFluent\MappingException;

class Factory implements FluentBuilderFactory
{
    public function createBuilder(Mapping $mapping): FluentBuilder
    {
        if ($mapping instanceof DocumentMapping) {
            return new DocumentBuilder();
        }
        if ($mapping instanceof EmbeddedDocumentMapping) {
            return new EmbeddedDocumentBuilder();
        }
        if ($mapping instanceof MappedSuperclassMapping) {
            return new MappedSuperclassBuilder();
        }

        throw new MappingException('Unknown mapping type ' . get_class($mapping));
    }
}
