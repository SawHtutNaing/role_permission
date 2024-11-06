<?php

require_once __DIR__ . '/../../core/Database.php';

class Permission
{
    public $id;
    public $name;
    public $feature_id;

    public static function find($id)
    {
        $db = new Database();
        $result = $db->fetch("SELECT * FROM permissions WHERE id = :id", ['id' => $id]);

        if ($result) {
            $permission = new self();
            $permission->id = $result->id;
            $permission->name = $result->name;
            return $permission;
        }

        return null;
    }

    public function save()
    {
        $db = new Database();
        $db->execute("UPDATE permissions SET name = :name WHERE id = :id", [
            'name' => $this->name,
            'id' => $this->id
        ]);
    }

    public static function all()
    {
        $db = new Database();
        return $db->fetchAll("SELECT permissions.*, features.name as feature_name 
        FROM permissions 
        JOIN features ON permissions.feature_id = features.id");
    }



}