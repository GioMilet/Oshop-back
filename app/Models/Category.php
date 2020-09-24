<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {

    private $name;
    private $subtitle;
    private $picture;
    private $home_order;
   
    public static function findAll()
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);

        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $categories;
    }

    public static function find($categoryId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `category` WHERE `id` = :id';
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([":id" => $categoryId]);

        $category = $pdoStatement->fetchObject(self::class);

        return $category;
    }

    public static function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = "SELECT *
        FROM category
        WHERE home_order > 0
        ORDER BY home_order ASC
        LIMIT 5";
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $categories;
    }


    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `category` (name, subtitle, picture)
            VALUES (:name, :subtitle, :picture)
        ";

        $stmt = $pdo->prepare($sql);

        $insertedRows = $stmt->execute([
            ":name" => $this->name,
            ":subtitle" => $this->subtitle,
            ":picture" => $this->picture,
        ]);


        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();

            return true;
        }
        
        return false;
    }


    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "UPDATE category 
                SET 
                name = :name, 
                subtitle = :subtitle,
                picture = :picture, 
                updated_at = NOW()
                WHERE id = :id
                ";

        $stmt = $pdo->prepare($sql);

        $queryWorked = $stmt->execute([
            ":name" => $this->getName(),
            ":subtitle" => $this->getSubtitle(),
            ":picture" => $this->getPicture(),
            ":id" => $this->getId()
        ]);

        return $queryWorked;
    }


   
    public function getName()
    {
        return $this->name;
    }

   
    public function setName(string $name)
    {
        $this->name = $name;
    }

   
    public function getSubtitle()
    {
        return $this->subtitle;
    }

   
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getHomeOrder()
    {
        return $this->home_order;
    }

    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
        return $this;
    }

}