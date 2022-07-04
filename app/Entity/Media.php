<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Media
{
    public $id_media;
    public $nm_file;
    public $ds_file_path;
    public $dt_upload;
    public $id_property; //fk 


    /**
     * Metodo que insere um media
     */
    public function insert()
    {
        $database = new Database('medias');

        $this->id = $database->insert(
            [
                // 'id_media' => $this->id_media,
                'nm_file' => $this->nm_file,
                'ds_file_path' => $this->ds_file_path,
                // 'dt_upload' => $this->dt_upload,
                'id_property' => $this->id_property
            ]
        );

        return true;
    }

    /**
     * Metodo que atualiza dados do media
     * @return boolean
     */
    public function update()
    {
        return (new Database('medias'))->update(
            ' id_media = ' . $this->id_media,
            [
                'nm_file' => $this->nm_file,
                // 'ds_file_path' => $this->ds_file_path,
                // 'dt_upload' => $this->dt_upload,
                'id_property' => $this->id_property
            ]
        );
    }

    /**
     * Metodo que exclui um media
     * @return boolean
     */
    public function delete()
    {
        return (new Database('medias'))->delete(' id_media = ' . $this->id_media);
    }

    /**
     * Metodo que busca os medias
     * @param {string} $where
     * @param {string} $order
     * @param {string} $limit
     * @return array
     */
    public static function getMedias($where = null, $order = null, $limit = null, $columns = '*')
    {
        return (new Database('medias'))->select($where, $order, $limit, $columns)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Metodo que busca os medias
     * @param {string} $where
     * @param {string} $order
     * @param {string} $limit
     * @return array
     */
    public static function getMediasMulti($where = null, $order = null, $limit = null, $columns = '*')
    {

        return (new Database('medias'))->select($where, $order, $limit, $columns)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Metodo que busca um media pelo id
     * @param {int} $id
     * @return Media
     */
    public static function getMedia($id)
    {
        return (new Database('medias'))->select(' AND id_media = ' . $id)->fetchObject(self::class);
    }
}
