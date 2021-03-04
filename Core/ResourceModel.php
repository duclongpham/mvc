<?php

namespace Mvc\Core;

use Mvc\Core\ResourceModelInterface;
use Mvc\Config\Database;

class ResourceModel implements ResourceModelInterface
{

    private $table;
    private $id;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    /**
     * @param object $model
     * @return bool
     */
    public function save($model)
    {
        $getData = $model->getProperties();
        $id = $getData['id'];
        foreach ($getData as $k => $v) {
            if(is_null($v)){
                unset($getData[$k]);
            }
        }
        $column = array_keys($getData);
        $value = array_values($getData);
        $placeholder = array_map(function ($value) {
            
            return ":".$value;
        }, $column);

        if (is_null($id)) {

            $sql = "INSERT INTO " . $this->table . " (" . implode(', ', $column) . ") VALUES (" . implode(", ", $placeholder) . ")" ;
        } else {
            $merge = array_map(function ($column, $placeholder) {
                return $column . " = " . $placeholder;
            }, $column, $placeholder);

            $sql = "UPDATE " . $this->table . " SET " . implode(", ", $merge) . " WHERE " . $this->id . " = :id";
        } 

        $db = Database::getbdd()->prepare($sql);

        return $db->execute(array_combine($placeholder, $value));
    }

    /**
     * @param string/int $id
     * @return bool
     */
    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->id . " = ?";
        $db = Database::getbdd()->prepare($sql);

        return $db->execute([$id]);
    }

    /**
     * @param string/int $id
     * @return object
     */
    public function find($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->id . " = ?";
        $db = Database::getbdd()->prepare($sql);
        $db->execute([$id]);

        return $db->fetch();
    }

    /**
     * @return object
     */
    public function all()
    {
        $sql = "SELECT * FROM " . $this->table;
        $db = Database::getbdd()->prepare($sql);
        $db->execute();

        return $db->fetchAll();
    }
}