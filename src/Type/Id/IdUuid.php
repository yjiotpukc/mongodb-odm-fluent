<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type\Id;

interface IdUuid
{
    public function type(string $type): IdUuid;

    public function nullable(): IdUuid;

    public function notSaved(): IdUuid;

    public function salt(string $salt): IdUuid;
}
