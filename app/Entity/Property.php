<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Property
{
    public $id_property;
    public $ds_title;
    public $ds_description;
    public $ds_address;
    public $nr_price;
    public $dt_insert_date;
    public $nr_lat;
    public $nr_long;

    /**
     * Metodo que insere um property
     */
    public function insert()
    {
        $database = new Database('propertys');

        $this->id = $database->insert(
            [
                'id_property' => $this->id_property,
                'ds_title' => $this->ds_title,
                'ds_description' => $this->ds_description,
                'ds_address' => $this->ds_address,
                'nr_price' => $this->nr_price,
                'nr_lat' => $this->nr_lat,
                'nr_long' => $this->nr_long
            ]
        );

        return true;
    }

    /**
     * Metodo que atualiza dados da property
     * @return boolean
     */
    public function update()
    {
        return (new Database('propertys'))->update(
            ' id_property = ' . $this->id_property,
            [
                'ds_title' => $this->ds_title,
                'ds_description' => $this->ds_description,
                'ds_address' => $this->ds_address,
                'nr_price' => $this->nr_price,
                'nr_lat' => $this->nr_lat,
                'nr_long' => $this->nr_long
            ]
        );
    }

    /**
     * Metodo que exclui uma property
     * @return boolean
     */
    public function delete()
    {
        return (new Database('propertys'))->delete(' id_property = ' . $this->id_property);
    }

    /**
     * Metodo que busca os property
     * @param {string} $where
     * @param {string} $order
     * @param {string} $limit
     * @return array
     */
    public static function getPropertys($where = null, $order = null, $limit = null, $columns = '*')
    {

        return (new Database('propertys'))->select($where, $order, $limit, $columns)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Metodo que busca uma property pelo id
     * @param {int} $id
     * @return Property
     */
    public static function getProperty($id)
    {
        return (new Database('propertys'))->select(' AND id_property = ' . $id)->fetchObject(self::class);
    }
}
