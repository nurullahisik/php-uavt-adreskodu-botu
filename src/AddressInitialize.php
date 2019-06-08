<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 30.05.2019
 * Time: 14:01
 */

namespace Dask\AdresKodu;

class AddressInitialize extends AddressResource
{
    public static function init()
    {
        $options = Config::options();

        parent::init()->get(parent::getUrl("y"), parent::getHttpHeaders($options));

        return new AddressInitialize();
    }

    public static function create(AddressProperties $properties)
    {
        $options = Config::options();

        $result = parent::init()->post(parent::getUrl(), parent::getHttpHeaders($options), parent::getHttpBody($properties));

        if ( $properties->getType() == "sf" || $properties->getType() == "dk" || $properties->getType() == "ick" ){
            $result = (new HTMLParser($result['result']))->{($properties->getTypeFunction())}();

            $result['result'] = JsonBuilder::jsonEncode(['yt' => $result['result']]);
        } else if ( $properties->getType() == "adr" ) {
            $result['result'] = JsonBuilder::jsonEncode(['yt' => $result['result']]);
        }

        return AddressMapper::create($result['result'])->jsonDecode()->mapAddressResource(new AddressInitialize());

    }
}