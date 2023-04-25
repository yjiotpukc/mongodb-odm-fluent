<?php

declare(strict_types=1);

namespace Examples\IdGenerator;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Id\IdGenerator;

class CustomIdGenerator implements IdGenerator
{
    private string $prefix = '';
    private string $postfix = '';

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function setPostfix(string $postfix): void
    {
        $this->postfix = $postfix;
    }

    public function generate(DocumentManager $dm, object $document): string
    {
        return uniqid($this->prefix, true) . $this->postfix;
    }
}
