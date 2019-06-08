<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 8.06.2019
 * Time: 23:10
 */

namespace Dask\AdresKodu;
class AddressResourceMapper
{
    public function mapAddress(AddressResource $notificationResource, $json_object)
    {
        if ( isset($json_object->yt) ) {
            $notificationResource->setResult($json_object->yt);
        }
    }
}