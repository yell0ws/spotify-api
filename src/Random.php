<?php
declare(strict_types=1);

namespace App;

class Random
{
    public static function username(): string
    {
        return 'spf' . mt_rand(1400000, 8883883);
    }

    public static function password(): string
    {
        return (string)mt_rand(1400000, 8883883);
    }
}
