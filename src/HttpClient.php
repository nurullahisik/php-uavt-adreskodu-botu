<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 30.05.2019
 * Time: 14:10
 */

namespace Dask\AdresKodu;

class HttpClient extends Curl
{

    public static function init()
    {
        return new HttpClient();
    }

    protected static function getHttpHeaders(Options $options)
    {
        $header = array(
            "Content-Type: " . $options->getContentType(),
            "Host: " . $options->getHost(),
            "Referer: " . $options->getReferer(),
        );

        return $header;
    }

    protected static function getHttpBody(AddressProperties $properties)
    {
        $token = $properties->getToken();
        $type  = $properties->getType();

        if ( empty($type) ) {
            trigger_error("Type is requeired", E_NOTICE);
            exit;
        }

        if ( empty($token) ) {
            trigger_error("An error occurred. Please try again.", E_NOTICE);
            exit;
        }

        $body = $token . "=%3D&t=" . $type . "&u=" . $properties->getId();

        return $body;
    }

    protected static function getUrl($type = "load")
    {
        $url = "https://adreskodu.dask.gov.tr/site-element/control/$type.ashx";

        return $url;
    }

}