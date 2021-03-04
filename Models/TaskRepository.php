<?php

namespace Mvc\Models;

use Mvc\Config\Database;
use PDO;

class TaskRepository
{
    private $table;
    private $id;

    /**
     * @todo set default table and id name
     */
    public function __construct() {
        $this->table = 'tasks';
        $this->id = 'id';
    }

    /**
     * @param object $model
     * @return bool
     */
    public function add($model)
    {
        $data = $model->getProperties();
        foreach ($data as $k => $v) {
            if (is_null($v)) {
                unset($data[$k]);
            }
        }

        $query = Database::queryBuilder()
        ->insert($this->table);

        foreach ($data as $k => $v) {
            $query = $query->setValue($k, ':'.$k)
            ->setParameter(':'.$k, $v);
        }

        return $query->execute();
    }

    /**
     * @param object $model
     * @return bool
     */
    public function edit($model)
    {
        $data = $model->getProperties();
        $id = $data['id'];

        if(is_null($id)) return false;

        foreach ($data as $k => $v) {
            if (is_null($v)) {
                unset($data[$k]);
            }
        }

        $query = Database::queryBuilder()
        ->update($this->table);

        foreach ($data as $k => $v) {
            $query = $query->set($k, ':'.$k)
            ->setParameter(':'.$k, $v);
        }

        $query = $query->where($this->id . " = :" . $this->id)
        ->setParameter(':'.$this->id, $id);
        
        return $query->execute();
    }

    /**
     * @param object $model
     * @return bool
     */
    public function delete($model)
    {
        $data = $model->getProperties();

        return Database::queryBuilder()
        ->delete($this->table)
        ->where($this->id . " = :" . $this->id)
        ->setParameter($this->id, $data['id'])
        ->execute();
    }

    /**
     * @param string/int $id
     * @return object
     */
    public function get($id)
    {
        return Database::queryBuilder()
        ->select('*')
        ->from($this->table)
        ->where($this->id . " = :" . $this->id)
        ->setParameter($this->id, $id)
        ->execute()
        ->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @return object
     */
    public function getAll()
    {
        return Database::queryBuilder()
        ->select('*')
        ->from($this->table)
        ->execute()
        ->fetchAll(PDO::FETCH_OBJ);
    }
}