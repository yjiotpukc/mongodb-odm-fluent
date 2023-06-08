<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Loader;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\RuntimeReflectionService;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use yjiotpukc\MongoODMFluent\Builder\Document\DocumentBuilder;
use yjiotpukc\MongoODMFluent\MappingSet\MappingSet;

class AnnotationCompatibleClassMetadataLoader extends ClassMetadataLoader
{
    protected RuntimeReflectionService $reflectionService;
    private MappingSet $mappingSet;

    public function __construct(MappingSet $mappingSet)
    {
        $this->reflectionService = new RuntimeReflectionService();
        $this->mappingSet = $mappingSet;
    }

    public function load(string $mapping, ClassMetadata $metadata): void
    {
        parent::load($mapping, $metadata);

        if ($metadata->isMappedSuperclass) {
            $this->cleanUpNonPrivateFields($metadata);
        }

        if ($this->isPlainDocument($metadata)) {
            $accessibleProperties = $metadata->getReflectionClass()->getProperties();
            $accessiblePropertiesNames = array_map(fn (ReflectionProperty $prop) => $prop->getName(), $accessibleProperties);
            $entity = $metadata->getName();
            while (true) {
                $entity = get_parent_class($entity);
                if ($entity === false) {
                    return;
                }

                if ($this->isTransient($entity)) {
                    continue;
                }

                $builder = new DocumentBuilder();
                $mapping = $this->findMapping($entity);
                $mapping::map($builder);
                $parentMetadata = new ClassMetadata($entity);
                $builder->build($parentMetadata);
                if (!$parentMetadata->isMappedSuperclass) {
                    return;
                }

                foreach ($parentMetadata->fieldMappings as $name => $field) {
                    if (!isset($metadata->fieldMappings[$name]) && in_array($name, $accessiblePropertiesNames)) {
                        $metadata->mapField($field);
                    }
                }
            }
        }
    }

    protected function isPlainDocument(ClassMetadata $metadata): bool
    {
        return !(
            $metadata->isMappedSuperclass
            || $metadata->isEmbeddedDocument
            || $metadata->isFile
            || $metadata->isView()
            || $metadata->isQueryResultDocument
        );
    }

    protected function cleanUpNonPrivateFields(ClassMetadata $metadata): void
    {
        foreach ($metadata->getFieldNames() as $fieldName) {
            if ($metadata->isInheritedField($fieldName) || $metadata->getReflectionProperty($fieldName)->isPrivate()) {
                continue;
            }

            if ($metadata->hasAssociation($fieldName)) {
                unset($metadata->associationMappings[$fieldName]);
            }
            unset($metadata->fieldMappings[$fieldName]);
            unset($metadata->reflFields[$fieldName]);
        }
    }

    protected function isTransient(string $entity): bool
    {
        $mapping = $this->findMapping($entity);

        return $mapping === null || !$this->hasOwnMapMethod($mapping);
    }

    protected function findMapping(string $entityClassName): ?string
    {
        if (!$this->mappingSet->exists($entityClassName)) {
            return null;
        }

        return $this->mappingSet->find($entityClassName);
    }

    protected function hasOwnMapMethod(string $className): bool
    {
        try {
            $reflObject = new ReflectionClass($className);
            $mapMethod = $reflObject->getMethod('map');
            $declaredIn = $mapMethod->getDeclaringClass()->getName();

            return $className === $declaredIn;
        } catch (ReflectionException $exception) {
            return false;
        }
    }
}
