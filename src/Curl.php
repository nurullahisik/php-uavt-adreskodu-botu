<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 30.05.2019
 * Time: 14:06
 */

namespace Dask\AdresKodu;
class Curl
{
    public function get($url, $header)
    {
        $data = array(
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $header
        );

        return $this->exec($url, $data);
    }

    public function post($url, $header, $content)
    {
        $data = array(
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_VERBOSE => false,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => $header
        );

        return $this->exec($url, $data);
    }

    private function exec($url, $options)
    {
        $this->certificate($options);

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return [
            'status'  => empty($response) ? false : true,
            'result'  => $response,
            'message' => $error
        ];
    }

    private function certificate(& $options)
    {
        if ( $_SERVER['REQUEST_SCHEME'] == 'http' ) {
            $options[CURLOPT_CAINFO] = dirname(dirname(__FILE__)) . "/cacert.pem";
        }

        return $options;
    }

}