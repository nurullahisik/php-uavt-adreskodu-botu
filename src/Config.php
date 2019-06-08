<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 8.06.2019
 * Time: 20:15
 */

namespace Dask\AdresKodu;
class Config
{
    public static function options()
    {
        $options = new Options();
        $options->setHost('adreskodu.dask.gov.tr');
        $options->setReferer("http://adreskodu.dask.gov.tr/");
        $options->setContentType("application/x-www-form-urlencoded");

        return $options;
    }
}