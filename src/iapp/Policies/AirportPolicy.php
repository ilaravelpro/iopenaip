<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 2/2/21, 8:14 AM
 * Copyright (c) 2021. Powered by iamir.net
 */

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
