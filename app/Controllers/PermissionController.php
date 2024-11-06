<?php

require_once __DIR__ . '/../Models/Permission.php';


class PermissionController
{
    public function index()
    {
        $permissions = Permission::all();
        $features = Feature::all();

        require __DIR__ . '/../../view/permissions.php';
    }

    public function store($request)
    {
        $permission = new Permission();
        $permission->name = $request['name'];
        $permission->feature_id = $request['feature_id'];


        $db = new Database();
$db->execute("INSERT INTO permissions (name, feature_id) VALUES (:name, :feature_id)", [
    'name' => $permission->name,
    'feature_id' => $permission->feature_id, // Add feature_id here
]);
        header('location: /permissions');
    }
    public function edit($id)
    {
        $permission = Permission::find($id);
        require __DIR__ . '/../../view/permission_edit.php';
    }

    public function update($id)
    {
        $name = $_POST['name'];

        // Validate the input
        if (empty($name)) {
            echo 'Permission name cannot be empty.';
            return;
        }

        // Update the permission in the database
        $permission = Permission::find($id);
        if ($permission) {
            $permission->name = $name;
            $permission->save();
            header('Location: /permissions');
        } else {
            echo 'Permission not found.';
        }
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $db = new Database();
        $db->execute("DELETE FROM permissions WHERE id = :id", ['id' => $permission->id]);
        header('location: /permissions');
    }
}