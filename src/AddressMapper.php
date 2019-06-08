<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 8.06.2019
 * Time: 21:09
 */

namespace Dask\AdresKodu;
class AddressMapper extends AddressResourceMapper
{
    private $json_object;

    public function __construct($json_object)
    {
        $this->json_object = $json_object;
    }

    public static function create($json_object = null)
    {
        return new AddressMapper($json_object);
    }

    public function jsonDecode()
    {
        $this->json_object = JsonBuilder::jsonDecode($this->json_object);

        return $this;
    }

    public function mapAddressResource(AddressResource $addressResource)
    {
        parent::mapAddress($addressResource, $this->json_object);

        return $addressResource;
    }
}