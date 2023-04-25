<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Mapping\Loader;

use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata as MongoClassMetadata;
use Doctrine\Persistence\Mapping\ClassMetadata;
use ReflectionClass;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\Builder\Document\InheritedFieldsBuilder;
use yjiotpukc\MongoODMFluent\Document\Document;
use yjiotpukc\MongoODMFluent\Mapping\Traits\LifecycleAutoMethodsTrait;

class DocumentLoader implements Loader
{
    use LifecycleAutoMethodsTrait;

    protected Document $document;
    protected MongoClassMetadata $metadata;
    protected EventManager $eventManager;
    protected array $parentDocuments;

    public function __construct(Document $document, ClassMetadata $metadata, EventManager $eventManager)
    {
        $this->document = $document;
        $this->metadata = $metadata;
        $this->eventManager = $eventManager;
    }

    public function setParents(array $parentDocuments): void
    {
        $this->parentDocuments = $parentDocuments;
    }

    public function load(): void
    {
        if (!$this->hasOwnMapMethod()) {
            return;
        }

        $builder = new InheritedFieldsBuilder();
        foreach ($this->findMappedSuperclassParents() as $mappedSuperclassParent) {
            $mappedSuperclassParent::map($builder);
        }
        $builder->build($this->metadata);

        $builder = new DocumentBuilder();
        $this->document::map($builder);
        $this->addLifecycleAutoMethods($builder);
        $builder->build($this->metadata);
    }

    protected function hasOwnMapMethod(): bool
    {
        $reflObject = new ReflectionClass($this->document);

        return $reflObject->getName() === $reflObject->getMethod('map')->getDeclaringClass()->getName();
    }

    protected function findMappedSuperclassParents(): array
    {
        $parents = [];
        foreach ($this->parentDocuments as $parentClassName) {
            if ($parentClassName::isSuperclass()) {
                $parents[] = $parentClassName;
            } else {
                break;
            }
        }

        return array_reverse($parents);
    }
}
