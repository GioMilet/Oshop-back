<?php

namespace App\Models;


abstract class CoreModel {

    
    abstract public static function findAll();

    abstract public static function find($id);


    protected $id;
    protected $created_at;
    protected $updated_at;

    public function getId() : int
    {
        return $this->id;
    }

    public function getCreatedAt() : string
    {
        return $this->created_at;
    }

    public function getUpdatedAt() : string
    {
        return $this->updated_at;
    }
    
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }
}
