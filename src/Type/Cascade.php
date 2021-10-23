<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

class Cascade
{
    /**
     * @var string[]
     */
    public $cascades;

    public function all(): Cascade
    {
        $this->cascades = [
            'detach',
            'merge',
            'refresh',
            'remove',
            'persist',
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
}
