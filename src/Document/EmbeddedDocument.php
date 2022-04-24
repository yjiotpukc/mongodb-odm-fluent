<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Document;

interface EmbeddedDocument
{
    public function map(\yjiotpukc\MongoODMFluent\Builder\EmbeddedDocument $builder): void;
}
