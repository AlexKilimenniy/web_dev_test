<?php

/**
 * Created by PhpStorm.
 * User: alexk
 * Date: 24.11.2020
 * Time: 12:38
 */
class Cookery
{

    private $db = Null;

    private $table_name = "cookery";

    public $ERRORS = [];

    public $name = Null;
    public $id = Null;
    public $tags = [];

    // конструктор
    public function __construct($id=null)
    {
        global $db;
        $this->db = $db;

        if ($id) {
            $this->id = $id;
            $this->init();
            $this->init_tags();
        }

    }

    // деструктор
    public function __destruct()
    {}

    private function init()
    {
        $sql = "SELECT
                    *
                FROM
                    `".$this->table_name."`
                WHERE `id` = " . $this->db->paramInt($this->id) . ";";

        $result = $this->db->select($sql)[0];

        foreach ($result as $field=>$val){
            $this->$field = $val;
        }

    }

    private function init_tags()
    {
        $sql = "SELECT
                    `id_tag`
                FROM
                    `tags_to_cookery`
                WHERE `id_cookery` = " . $this->db->paramInt($this->id) . ";";

        $result = $this->db->select($sql);
        foreach ($result as $key=>$val){
            array_push($this->tags, $val['id_tag']);
        }
    }

    /////////////////////////////////////////////
    //
    /////////////////////////////////////////////

    private function prepareInsertData()
    {
        $this->ERRORS = [];
        $data = array();

        if ($this->name) {
            $data['name'] = $this->name;
        } else {
            $this->ERRORS[] = 'Не задан обязательній параметр <name>';
        }

        return $data;
    }

    private function update_tags()
    {
        $sql = "DELETE FROM `tags_to_cookery` WHERE `id_cookery`= " . $this->db->paramInt($this->id) . ";";
        $this->db->query($sql);

        $insert_data = [];
        foreach ($this->tags as $tag){
            $insert_data[] = "(" . $this->db->paramInt($this->id) . ", " . $this->db->paramInt($tag) . ")";
        }

        if (!empty($insert_data)) {
            $sql = "INSERT INTO `tags_to_cookery` (`id_cookery`, `id_tag`) 
            VALUES " . join(',', $insert_data) . ";";
            $this->db->query($sql);
        }
    }

    /**
     *
     * Private method for update object
     *
     * @return boolean
     *
     */
    private function update()
    {
        $result = False;
        $where = array('id' => $this->db->paramInt($this->id));
        if ($this->db->update($this->table_name, $this->prepareInsertData(), $where)) {
            $this->update_tags();
            $result = True;
        }
        return $result;
    }

    /**
     *
     * Private method for create new object
     *
     * @return boolean
     *
     */
    private function create()
    {
        $result = False;
        $cookery_id = $this->db->insert($this->table_name, $this->prepareInsertData(), true);
        if ($cookery_id) {
            $this->id = $cookery_id;
            $this->update_tags();
            $result = True;
        }
        return $result;
    }

    /**
     *
     * Public method for create or update object
     *
     * @return int
     *
    */
    public function save()
    {
        if ($this->id){
            $this->update();
        } else {
            $this->create();
        }
        return $this->id;
    }

    /**
     *
     * Public method for create or update object
     *
     * @return boolean
     *
     */
    public function delete()
    {
        $this->tags = [];
        $this->update_tags();
        return $this->db->delete($this->table_name, array('id'=>$this->id));
    }

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