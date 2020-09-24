<?php

namespace App\Models;

use App\Utils\Database;
use PDO;


class Brand extends CoreModel {
  
    
    private $name;
    private $footer_order;

  
    public static function find($brandId)
    {
        // connect to the database
        $pdo = Database::getPDO();

        // create request
        $sql = '
            SELECT *
            FROM brand
            WHERE id = ' . $brandId;

        // execute the request
        $pdoStatement = $pdo->query($sql);

        $brand = $pdoStatement->fetchObject('App\Models\Brand');

        return $brand;
    }

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `brand`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');
        
        return $results;
    }

    public function findAllFooter()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM brand
            WHERE footer_order > 0
            ORDER BY footer_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $brands = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');
        
        return $brands;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `brand` (name, footer_order)
            VALUES ('{$this->name}', {$this->footer_order})
        ";

        $insertedRows = $pdo->exec($sql);

        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();

            return true;
        }
        
        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "
            UPDATE `brand`
            SET
                name = '{$this->name}',
                footer_order = {$this->footer_order},
                updated_at = NOW()
            WHERE id = {$this->id}
        ";

        $updatedRows = $pdo->exec($sql);

        return ($updatedRows > 0);
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
    }
}
