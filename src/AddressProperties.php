<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 8.06.2019
 * Time: 20:06
 */

namespace Dask\AdresKodu;

class AddressProperties extends HttpClient
{

    private $id;
    private $type;
    private $y = null;
    private $types = [
        'cities'           => 'il',
        'district'         => 'ce',
        'township_village' => 'vl',
        'neighborhood'     => 'mh',
        'street'           => 'sf',
        'building'         => 'dk',
        'door'             => 'ick',
        'uavt'             => 'adr'
    ];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $u
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTypeFunction()
    {
        return array_search($this->type, $this->types);
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        if ( !isset($this->types[$type]) ) {
            trigger_error("Type of undefined");
            exit;
        }

        $this->type = $this->types[$type];
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        $this->setToken();

        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setToken($y = null)
    {
        if ( is_null($this->y) ) {
            $options = Config::options();

            $y = $this->get(parent::getUrl("y"), parent::getHttpHeaders($options));

            $y = str_replace("+", " ", $y['result']);
            $y = str_replace("=", "", $y);
        }

        $this->y = $y;
    }

}