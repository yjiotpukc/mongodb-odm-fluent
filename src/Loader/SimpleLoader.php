<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Loader;

use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\FileBuilder;
use yjiotpukc\MongoODMFluent\Document\EmbeddedDocument;
use yjiotpukc\MongoODMFluent\Document\File;
use yjiotpukc\MongoODMFluent\Document\QueryResultDocument;
use yjiotpukc\MongoODMFluent\EventListener;

class SimpleLoader implements ClassMetadataLoader
{
    protected bool $useLifecycleAutoMethods = true;
    protected EventManager $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function load(string $mapping, ClassMetadata $metadata): void
    {
        $implements = class_implements($mapping);
        if (in_array(File::class, $implements)) {
            $builder = new FileBuilder();
        } else {
            $builder = new DocumentBuilder();

            if (in_array(EmbeddedDocument::class, $implements)) {
                $builder->embeddedDocument();
            }
            if (in_array(QueryResultDocument::class, $implements)) {
                $builder->queryResultDocument();
            }
        }

        $mapping::map($builder);

        if ($this->useLifecycleAutoMethods && !in_array(File::class, $implements)) {
            $this->addLifecycleAutoMethods($mapping, $metadata, $builder);
        }

        $builder->build($metadata);
    }

    public function disableLifecycleAutoMethods(): void
    {
        $this->useLifecycleAutoMethods = false;
    }

    public function addLifecycleAutoMethods(string $mapping, ClassMetadata $metadata, DocumentBuilder $builder): void
    {
        $entity = $metadata->name;

        $eventListener = new EventListener($mapping);

        foreach (static::getLifecycleMethods() as $lifecycleMethod) {
            if (method_exists($entity, $lifecycleMethod)) {
                $builder->lifecycle()->{$lifecycleMethod}($lifecycleMethod);
            } elseif (method_exists($mapping, $lifecycleMethod)) {
                $this->eventManager->addEventListener($lifecycleMethod, $eventListener);
            }
        }
    }

    protected static function getLifecycleMethods(): array
    {
        return [
            'preRemove',
            'postRemove',
            'prePersist',
            'postPersist',
            'preUpdate',
            'postUpdate',
            'preLoad',
            'postLoad',
            'loadClassMetadata',
            'onClassMetadataNotFound',
            'preFlush',
            'postFlush',
            'onFlush',
            'onClear',
            'documentNotFound',
            'postCollectionLoad',
        ];
    }
}
