<?php

namespace src\Helpers;

class NumbersHelper {

    public static function onlyNumbers($str)
    {
        $str = preg_replace('/\D/', '', $str);
        return $str;
    }

    public static function formatMoney($str)
	{
        $str = number_format((self::onlyNumbers($str) / 100), 2);
        $str = str_replace(',', '', $str);
        return $str;
    } 
}