<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent;

use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;

class AnnotationCompatibleMetadataConverter
{
    protected MappingDriver $driver;

    public function __construct(MappingDriver $driver)
    {
        $this->driver = $driver;
    }

    public function makeCompatible(ClassMetadata $metadata): void
    {
        if ($metadata->isMappedSuperclass) {
            $this->removeNonPrivateFields($metadata);
        }

        if ($this->isPlainDocument($metadata)) {
            $this->addFieldsInheritedFromSuperclasses($metadata);
        }
    }

    protected function removeNonPrivateFields(ClassMetadata $metadata): void
    {
        foreach ($metadata->getFieldNames() as $fieldName) {
            if ($metadata->isInheritedField($fieldName) || $metadata->getReflectionProperty($fieldName)->isPrivate()) {
                continue;
            }

            $this->removeFieldMapping($fieldName, $metadata);
        }
    }

    protected function addFieldsInheritedFromSuperclasses(ClassMetadata $metadata): void
    {
        $parent = $metadata->getReflectionClass();

        while (true) {
            $parent = $parent->getParentClass();

            if ($parent === false) {
                return;
            }

            if ($this->driver->isTransient($parent->getName())) {
                continue;
            }

            $parentMetadata = new ClassMetadata($parent->getName());
            $this->driver->loadMetadataForClass($parent->getName(), $parentMetadata);

            foreach ($parentMetadata->fieldMappings as $name => $field) {
                if (isset($metadata->fieldMappings[$name])) {
                    continue;
                }

                $reflProperty = $parentMetadata->getReflectionProperty($name);

                if ($reflProperty->isPublic() || $reflProperty->isProtected()) {
                    $metadata->mapField($field);
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
            || $metadata->isQueryResultDocument
            || $metadata->isView()
        );
    }

    protected function removeFieldMapping(string $fieldName, ClassMetadata $metadata): void
    {
        unset($metadata->fieldMappings[$fieldName]);
        unset($metadata->reflFields[$fieldName]);

        if ($metadata->identifier === $fieldName) {
            $metadata->identifier = null;
            $metadata->generatorType = ClassMetadata::GENERATOR_TYPE_AUTO;
            $metadata->generatorOptions = [];
        }

        if (isset($metadata->associationMappings[$fieldName])) {
            unset($metadata->associationMappings[$fieldName]);
        }

        if ($metadata->versionField === $fieldName) {
            $metadata->isVersioned = false;
            $metadata->versionField = null;
        }

        if ($metadata->lockField === $fieldName) {
            $metadata->isLockable = false;
            $metadata->lockField = null;
        }
    }
}
