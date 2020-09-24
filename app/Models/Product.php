<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Product extends CoreModel {
   
    private $name;
    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $brand_id;
    private $category_id;
    private $type_id;
    

    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `product`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    public static function find($productId)
    {
        $pdo = Database::getPDO();

        $sql = "
            SELECT *
            FROM product
            WHERE id = " . $productId;
        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }


    public static function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT id, name
            FROM product
            ORDER BY id DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $products = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $products;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `product` (name, description, picture, status, price, brand_id, type_id, category_id)
            VALUES (:name, :description, :picture, :status, :price, :brand_id, :type_id, :category_id)
        ";
        $stmt = $pdo->prepare($sql);

        $insertedRows = $stmt->execute([
            ":name" => $this->name,
            ":description" => $this->description,
            ":picture" => $this->picture,
            ":status" => $this->status,
            ":price" => $this->price,
            ":brand_id" => $this->brand_id,
            ":category_id" => $this->category_id,
            ":type_id" => $this->type_id,
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

        $sql = "
            UPDATE product 
            SET name = :name,
                description = :description,
                picture = :picture,
                status = :status,
                price = :price,
                brand_id = :brand_id,
                category_id = :category_id,
                type_id = :type_id
            WHERE id = :id
        ";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            ":name" => $this->name,
            ":description" => $this->description,
            ":picture" => $this->picture,
            ":status" => $this->status,
            ":price" => $this->price,
            ":brand_id" => $this->brand_id,
            ":category_id" => $this->category_id,
            ":type_id" => $this->type_id,
            ":id" => $this->id
        ]);
    }    

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getShortDescription()
    {
        return mb_substr($this->description, 0, 45).'...';
    }
 
    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    public function getPrice()
    {
        return $this->price;
    }
   
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
  
    public function getRate()
    {
        return $this->rate;
    }
   
    public function setRate(int $rate)
    {
        $this->rate = $rate;
    }
   
    public function getStatus()
    {
        return $this->status;
    }
   
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getBrandId()
    {
        return $this->brand_id;
    }
    
    public function setBrandId(int $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    public function getTypeId()
    {
        return $this->type_id;
    }

    public function setTypeId(int $type_id)
    {
        $this->type_id = $type_id;
    }
}
