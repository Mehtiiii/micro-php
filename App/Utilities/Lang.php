<?php

namespace App\Utilities;

class Lang
{
    public static function latin_to_persian_number($input)
    {
        $fa_num = ['۰','١','۲','۳','۴','۵','۶','۷','۸','۹'];
        $en_num = ['0','1','2','3','4','5','6','7','8','9',];
        return str_replace($en_num, $fa_num, (string)$input);
    }

    public static function persian_to_latin_number($input)
    {
        $fa_num = ['۰','١','۲','۳','۴','۵','۶','۷','۸','۹'];
        $en_num = ['0','1','2','3','4','5','6','7','8','9',];
        return str_replace($fa_num, $en_num, (string)$input);
    }
}