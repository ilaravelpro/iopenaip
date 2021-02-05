<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 4:41 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

function iopenaip_path($path = null)
{
    $path = trim($path, '/');
    return __DIR__ . ($path ? "/$path" : '');
}

function iopenaip($key = null, $default = null)
{
    return iconfig('iopenaip' . ($key ? ".$key" : ''), $default);
}
