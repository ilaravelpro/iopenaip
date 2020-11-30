<?php

function iopenaip_path($path = null)
{
    $path = trim($path, '/');
    return __DIR__ . ($path ? "/$path" : '');
}

function iopenaip($key = null, $default = null)
{
    return iconfig('iopenaip' . ($key ? ".$key" : ''), $default);
}
