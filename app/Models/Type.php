<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Type extends CoreModel {
   
    private $name;
    private $footer_order;

    public static function find($typeId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `type` WHERE `id` =' . $typeId;
        $pdoStatement = $pdo->query($sql);

        $type = $pdoStatement->fetchObject(self::class);

        return $type;
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `type`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');
        
        return $results;
    }

    public function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM type
            WHERE footer_order > 0
            ORDER BY footer_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');
        
        return $types;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getFooterOrder()
    {
        return $this->footer_order;
    }

    public function setFooterOrder(int $footer_order)
    {
        $this->footer_order = $footer_order;
        return $this;
    }
}
