<?php


include __DIR__.'/vendor/autoload.php';

use Dask\AdresKodu\AddressProperties;
use Dask\AdresKodu\AddressInitialize;


$object = new AddressInitialize();
$object::init();

// $properties = new AddressProperties();
// $properties->setId(0);
// $properties->setType("cities");


//$properties = new AddressProperties();
//$properties->setId(1);
//$properties->setType("district");


//$properties = new AddressProperties();
//$properties->setId(1757);
//$properties->setType("township_village");


//$properties = new AddressProperties();
//$properties->setId(65);
//$properties->setType("neighborhood");


$properties = new AddressProperties();
$properties->setId(8);
$properties->setType("street");


//$properties = new AddressProperties();
//$properties->setId(496093);
//$properties->setType("building");


//$properties = new AddressProperties();
//$properties->setId(8122893);
//$properties->setType("door");


//$properties = new AddressProperties();
//$properties->setId(1315919009);
//$properties->setType("uavt");

$data = $object::create($properties);
print_r($data->getResult());


