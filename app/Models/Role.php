<?php

require_once __DIR__ . '/../../core/Database.php';

class Role
{
    public $id;
    public $name;

    public function permissions()
    {
        $db = new Database();
       
        $permissions = $db->fetchAll("SELECT permission_id FROM role_permission WHERE role_id = :role_id", ['role_id' => $this->id]);

       
        return array_column($permissions, 'permission_id');
    }


    public static function find($id)
    {
        $db = new Database();
        $result = $db->fetch("SELECT * FROM roles WHERE id = :id", ['id' => $id]);

        if ($result) {
            $role = new self();
            $role->id = $result->id;
            $role->name = $result->name;
            return $role;
        }
        return null;
    }

    public static function all()
    {
        $db = new Database();
        return $db->fetchAll("SELECT * FROM roles");
    }


    public function save()
    {
        $db = new Database();
        if ($this->id) {
            // Update existing role
            $db->execute("UPDATE roles SET name = :name WHERE id = :id", [
                'name' => $this->name,
                'id' => $this->id
            ]);
        } else {
            // Create new role (if needed)
            $db->execute("INSERT INTO roles (name) VALUES (:name)", [
                'name' => $this->name
            ]);
            $this->id = $db->lastInsertId(); // Set the new role ID
        }
    }

    public function syncPermissions($permissions)
    {
        $db = new Database();

        // Remove all current permissions
        $db->execute("DELETE FROM role_permission WHERE role_id = :role_id", ['role_id' => $this->id]);

        // Assign new permissions
        foreach ($permissions as $permission_id) {
            $db->execute("INSERT INTO role_permission (role_id, permission_id) VALUES (:role_id, :permission_id)", [
                'role_id' => $this->id,
                'permission_id' => $permission_id
            ]);
        }
    }
}