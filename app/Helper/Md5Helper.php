<?php

namespace App\Helper;

class Md5Helper
{
    /**
     * Return hashed string with specific MD5 key.
     *
     * @param string $string
     * @param null|string $key
     * @return string
     */
    public static function md5Hash(string $string, ?string $key = null): string
    {
        return md5($key ?? env('MD5_HASH_KEY') . $string);
    }
}