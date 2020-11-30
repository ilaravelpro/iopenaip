<?php

namespace iLaravel\iOpenAip\iApp\Policies;

use iLaravel\Core\Vendor\iRole\iRolePolicy;

class AirportPolicy extends iRolePolicy
{
    public $prefix = 'airports';
    public $model = 'Airport';

    public function import($user, $item = null, ...$args)
    {
        return static::has($this->prefix . '.import');
    }
}
