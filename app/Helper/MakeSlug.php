<?php

namespace App\Helper;

use Illuminate\Support\Str;

class MakeSlug
{
    public static function makeSlug($title)
    {
        return Str::slug(
            date("Ymd") . "-" . Str::limit($title, 55),
            "-"
        );
    }
}
