<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping;

use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Document\File;
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

    public function createLoader($mapping, ClassMetadata $metadata, EventManager $eventManager): Loader
    {
        $loader = $this->determineLoader($mapping, $metadata, $eventManager);
        if (!($loader instanceof FileLoader)) {
            $loader->enableLifecycleAutoMethods($this->useLifecycleAutoMethods);
        }

        return $loader;
    }

    protected function determineLoader($mapping, ClassMetadata $metadata, EventManager $eventManager): Loader
    {
        if ($mapping instanceof File) {
            return new FileLoader($mapping, $metadata, $eventManager);
        }

        if ($mapping instanceof QueryResultDocument) {
            return new QueryResultDocumentLoader($mapping, $metadata, $eventManager);
        }

        if ($mapping instanceof View) {
            return new ViewLoader($mapping, $metadata, $eventManager);
        }

        if ($mapping instanceof Document) {
            if ($mapping::isSuperclass()) {
                return new MappedSuperclassLoader($mapping, $metadata, $eventManager);
            }

            return new DocumentLoader($mapping, $metadata, $eventManager);
        }

        if ($mapping instanceof EmbeddedDocument) {
            return new EmbeddedDocumentLoader($mapping, $metadata, $eventManager);
        }

        $mappingClassName = get_class($mapping);
        throw new MappingException("[$mappingClassName] is not a mapping");
    }
}
