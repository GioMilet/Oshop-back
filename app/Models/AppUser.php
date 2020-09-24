<?php 

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel 
{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;

    public static function findByEmail($email)
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * 
                FROM app_user 
                WHERE email = :email";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([":email" => $email]);

        return $stmt->fetchObject(self::class);
    }


    public static function find($appUserId)
    {

    }

    public static function findAll()
    {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM app_user 
                ORDER BY lastname ASC, `role` ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        //'App\Models\AppUser'
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO app_user (email, password, firstname, lastname, role, status) 
                VALUES (:email, :password, :firstname, :lastname, :role, :status)";

        $stmt = $pdo->prepare($sql);
        $insertedRows = $stmt->execute([
            ":email" => $this->email, 
            ":password" => $this->password, 
            ":firstname" => $this->firstname, 
            ":lastname" => $this->lastname, 
            ":role" => $this->role, 
            ":status" => $this->status
        ]);

        if ($insertedRows){
            $this->id = $pdo->lastInsertId();
            return true;
        }

        return false;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }
 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
 
    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}