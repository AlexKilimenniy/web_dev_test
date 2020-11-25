<?php

/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 24.11.2020
 * Time: 16:47
 */
class Tags
{

    private $db = Null;

    private $table_name = "tags";

    public $title = Null;
    public $id = Null;

    // конструктор
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    // деструктор
    public function __destruct()
    {}


    /////////////////////////////////////////////
    //
    /////////////////////////////////////////////

    public function getList()
    {
        $sql = 'SELECT
                    *
                FROM
                    `'.$this->table_name.'`
                ORDER BY
                    `id` DESC;';
        return $this->db->select($sql);
    }

}