<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 25.08.2019
 * Time: 12:31
 */

namespace Dask\AdresKodu;


class Encoding
{
    public static function convert($response)
    {
        $pattern = array("Ý", "Ð", "Þ", "Ä°", "Ã", "Ã");

        $replace = array("İ", "Ğ", "Ş", "İ", "Ç", "Ü");

        return str_replace($pattern, $replace, $response);
    }
}