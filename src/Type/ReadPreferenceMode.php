<?php

declare(strict_types=1);

namespace yjiotpukc\MongoODMFluent\Type;

interface ReadPreferenceMode
{
    public function primary(): ReadPreference;

    public function primaryPreferred(): ReadPreference;

    public function secondary(): ReadPreference;

    public function secondaryPreferred(): ReadPreference;

    public function nearest(): ReadPreference;
}
