
<?php

require_once __DIR__ . '/../../core/Database.php';

class RolePermission
{
    public $id;
    public $role_id;
    public $permissions_id;

    public static function where($column, $value)
    {
        $db = new Database();
        return $db->fetchAll("SELECT * FROM role_permission WHERE $column = :value", ['value' => $value]);
    }
}
