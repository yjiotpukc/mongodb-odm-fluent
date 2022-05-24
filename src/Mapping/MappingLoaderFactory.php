<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Document\MappedSuperclass;
use yjiotpukc\MongoODMFluent\Document\QueryResultDocument;
use yjiotpukc\MongoODMFluent\Document\View;
use yjiotpukc\MongoODMFluent\Mapping\Loader\DocumentLoader;
use yjiotpukc\MongoODMFluent\Mapping\Loader\EmbeddedDocumentLoader;
use yjiotpukc\MongoODMFluent\Mapping\Loader\FileLoader;
use yjiotpukc\MongoODMFluent\Mapping\Loader\Loader;
use yjiotpukc\MongoODMFluent\Mapping\Loader\MappedSuperclassLoader;
use yjiotpukc\MongoODMFluent\Mapping\Loader\QueryResultDocumentLoader;
use yjiotpukc\MongoODMFluent\Mapping\Loader\ViewLoader;
use yjiotpukc\MongoODMFluent\MappingException;

class MappingLoaderFactory
{
    protected bool $useLifecycleAutoMethods = true;

    public function disableLifecycleAutoMethods(): void
    {
        $this->useLifecycleAutoMethods = false;
    }

    public function createLoader($mapping, ClassMetadata $metadata): Loader
    {
        if ($mapping instanceof File) {
            return new FileLoader($mapping, $metadata);
        }

        $loader = null;
        if ($mapping instanceof Document) {
            $loader = new DocumentLoader($mapping, $metadata);
        }

        if ($mapping instanceof EmbeddedDocument) {
            $loader = new EmbeddedDocumentLoader($mapping, $metadata);
        }

        if ($mapping instanceof MappedSuperclass) {
            $loader = new MappedSuperclassLoader($mapping, $metadata);
        }

        if ($mapping instanceof QueryResultDocument) {
            $loader = new QueryResultDocumentLoader($mapping, $metadata);
        }

        if ($mapping instanceof View) {
            $loader = new ViewLoader($mapping, $metadata);
        }

        if ($loader !== null) {
            $loader->enableLifecycleAutoMethods($this->useLifecycleAutoMethods);

            return $loader;
        }

        $mappingClassName = get_class($mapping);
        throw new MappingException("[$mappingClassName] is not a mapping");
    }
}
