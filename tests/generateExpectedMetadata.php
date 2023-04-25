#!/usr/bin/env php
<?php

declare(strict_types=1);

use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

$annotationsDir = __DIR__ . '/../examples/annotations';
$varDir = __DIR__ . '/../var';
/** @var ClassLoader $loader */
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->addPsr4('Examples\\', $annotationsDir);
$annotationDriver = new AnnotationDriver(new AnnotationReader(), "$annotationsDir/Entity");
$config = new Configuration();
$config->setMetadataDriverImpl($annotationDriver);
$config->setHydratorDir("$varDir/Hydrator/");
$config->setHydratorNamespace('Hydrator');
$documentManager = DocumentManager::create(null, $config);

// todo: delete expectedMetadata dir
$dirsToCreate = [$varDir, "$varDir/expectedMetadata"];
foreach ($dirsToCreate as $dir) {
    if (!file_exists($dir) && !mkdir($dir) && !is_dir($dir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
    }
}

$documents = $annotationDriver->getAllClassNames();
//$documents = [\Examples\Entity\Inheritance\Crocodile::class];
foreach ($documents as $className) {
    $shortClassName = (new ReflectionClass($className))->getShortName();
    $filename = str_replace('\\', '/', $shortClassName);
    $metadata = $documentManager->getClassMetadata($className);
    file_put_contents("$varDir/expectedMetadata/$filename", serialize($metadata));
}
