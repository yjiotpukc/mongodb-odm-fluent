<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent;

class EventListener
{
    protected string $document;

    public function __construct(string $document)
    {
        $this->document = $document;
    }

    public function __call($name, $arguments)
    {
        $this->document->$name(...$arguments);
    }
}
