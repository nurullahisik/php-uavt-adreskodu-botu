<?php
/**
 * Created by PhpStorm.
 * User: nurul
 * Date: 8.06.2019
 * Time: 23:35
 */

namespace Dask\AdresKodu;

use Dask\AdresKodu\Encoding;

class HTMLParser
{
    private $rows;
    private $result;
    private $error = "";

    public function __construct($html)
    {
        $this->result = [];

        $dom = new \DOMDocument;

        @$dom->loadHTML($html);
        $dom->preserveWhiteSpace = false;
        $tables = $dom->getElementsByTagName('tbody');

        $this->rows = $tables->item(0)->getElementsByTagName('tr');

        return $this;
    }

    public function street()
    {
        foreach ($this->rows as $row) {

            $cols = $row->getElementsByTagName('td');

            $type = $this->getValue($cols, 0);
            $name = $this->getValue($cols, 1);
            $id   = $this->getAttribute($cols, 2, 0);
            $id = str_replace(["ss('", "');"], "", $id);

            $this->setResult([
                'id'   => $id,
                'name' => Encoding::convert($name),
                'type' => Encoding::convert($type)
            ]);
        }

        return $this->result();
    }

    public function building()
    {
        foreach ($this->rows as $row) {

            $cols = $row->getElementsByTagName('td');

            $building_number    = $this->getValue($cols, 0);
            $building_code      = $this->getValue($cols, 1);
            $building_site_name = $this->getValue($cols, 2);
            $building_name      = $this->getValue($cols, 3);
            $id                 = $this->getAttribute($cols, 4, 0);
            $id                 = str_replace(["sb('", "');"], "", $id);

            $this->setResult([
                'id'                 => $id,
                'building_number'    => $building_number,
                'building_code'      =>  $building_code,
                'building_site_name' =>  Encoding::convert($building_site_name),
                'building_name'      =>  Encoding::convert($building_name)
            ]);

        }

        return $this->result();
    }

    public function door()
    {
        foreach ($this->rows as $row) {

            $cols = $row->getElementsByTagName('td');

            $type        = $this->getValue($cols, 0);;
            $door_number = $this->getValue($cols, 1);;
            $id          = $this->getAttribute($cols, 2, 0);
            $id          = str_replace(["showKod('", "');", "showKodWithParam('"], "", $id);

            $this->setResult([
                'uavt'        => Encoding::convert($id),
                'door_number' => Encoding::convert($door_number),
                'type'        => Encoding::convert($type)
            ]);
        }

        return $this->result();
    }

    public function uavt()
    {
        foreach ($this->rows as $row) {

            $cols = $row->getElementsByTagName('td');

            $type        = $this->getValue($cols, 0);
            $door_number = $this->getValue($cols, 1);
            $id          = $this->getAttribute($cols, 2, 0);
            $id          = str_replace(["showKod('", "');", "showKodWithParam('"], "", $id);

            $this->setResult([
                'id'          => Encoding::convert($id),
                'door_number' => Encoding::convert($door_number),
                'type'        => Encoding::convert($type)
            ]);
        }

        return $this->result();
    }

    private function getValue($cols, $index)
    {
        return $cols->item($index)->nodeValue;
    }

    private function getAttribute($cols, $col_index, $attr_index = 0)
    {
        if ( $cols->item($col_index) ) {
            return $cols->item($col_index)->getElementsByTagName("a")->item($attr_index)->getAttribute("onclick");
        }
        return "";
    }

    private function setResult($result)
    {
        return $this->result[] = $result;
    }

    private function result()
    {
        return [
            'status'  => empty($this->result) ? false : true,
            'result'  => $this->result,
            'message' => $this->error
        ];
    }

}