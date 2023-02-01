<?php

namespace MF\ViewHelper;

class NumbersHelper {

    public static function onlyNumbers($str)
    {
        $str = preg_replace('/\D/', '', $str);
        return $str;
    }

    public static function formatBRtoUS($str)
	{
        if (!is_numeric($str))
            return false;

        $str = number_format((self::onlyNumbers($str) / 100), 2);
        $str = str_replace(',', '', $str);
        return $str;
    }
    
    public static function formatUStoBR($str)
	{
        if (!is_numeric($str))
            return false;

        $str = number_format((self::onlyNumbers($str) / 100), 2);
        $str = str_replace(',', '.', $str);
        $str = substr_replace($str, ',', -3, 1);
        return $str;
    } 
}