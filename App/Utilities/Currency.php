<?php

namespace App\Utilities;

class Currency
{
    public static function price_in_hezar_toman($amount)
    {
        return $amount / 1000;
    }

    public static function price_in_rial($amount)
    {
        return $amount * 10;
    }
}