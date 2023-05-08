<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Builder\Field;

use yjiotpukc\MongoODMFluent\Type\Cascade;

class CascadePartial implements Cascade, FieldPartial
{
    /** @var string[] */
    protected array $cascades = [];

    public function all(): Cascade
    {
        $this->cascades = [
            'remove',
            'persist',
            'refresh',
            'merge',
            'detach',
        ];

        return $this;
    }

    public function detach(): Cascade
    {
        $this->cascades[] = 'detach';

        return $this;
    }

    public function merge(): Cascade
    {
        $this->cascades[] = 'merge';

        return $this;
    }

    public function refresh(): Cascade
    {
        $this->cascades[] = 'refresh';

        return $this;
    }

    public function remove(): Cascade
    {
        $this->cascades[] = 'remove';

        return $this;
    }

    public function persist(): Cascade
    {
        $this->cascades[] = 'persist';

        return $this;
    }

    public function toMapping(): array
    {
        return ['cascade' => $this->cascades];
    }
}
