<?php

require_once __DIR__ . '/../../core/Database.php';

class User
{
    public $id;
    public $name;
    public $username;
    public $role_id;
    public $phone;
    public $email;
    public $address;
    public $password;
    public $gender;
    public $is_active;

    

    public function role()
    {
        return Role::find($this->role_id);
    }

    public static function find($id)
    {
        $db = new Database();
        return $db->fetch("SELECT * FROM users WHERE id = :id", ['id' => $id]);
    }

    public static function all()
    {
        $db = new Database();
        return $db->fetchAll(" SELECT users.*, roles.name AS role_name
        FROM users
        LEFT JOIN roles ON users.role_id = roles.id");
    }

    public function save()
    {
        $db = new Database();
        $sql = "UPDATE users SET role_id = :role_id WHERE id = :id";
        $db->execute($sql, ['role_id' => $this->role_id, 'id' => $this->id]);
    }


    public function edit($id){
        $db = new Database();

        return  $db->fetchOne("SELECT * FROM users WHERE id = :id", ['id' => $id]);

    }
}