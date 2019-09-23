<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 30.05.2019
 * Time: 14:06
 */

namespace Dask\AdresKodu;

use Dask\AdresKodu\Encoding;;

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

        $encoding = mb_detect_encoding($response);

        if ( $encoding == "UTF-8" ) {
            $response = utf8_encode($response);

            $response = Encoding::convert($response);
        }

        return [
            'status'   => empty($response) ? false : true,
            'result'   => $response,
            'message'  => $error,
            'encoding' => $encoding
        ];
    }

    private function certificate(& $options)
    {
        $options[CURLOPT_SSL_VERIFYPEER] = false;
        $options[CURLOPT_SSL_VERIFYHOST] = false;

        return $options;
    }

}
