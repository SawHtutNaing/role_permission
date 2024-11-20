<?php

require_once __DIR__ . '/../Models/Role.php';
require_once __DIR__ . '../../../core/Database.php'; // Assuming Database class handles DB operations
require_once __DIR__ . '/../Models/Feature.php';

class RoleController
{
    // Display all roles
    public function index()
    {
        $roles = Role::all();
        // $features = Feature::all();
        require __DIR__ . '/../../view/roles.php';
    }

    // Show a single role by ID
    public function show($id)
    {
        $role = Role::find($id); // Assuming Role::find($id) fetches a single record by ID
        require __DIR__ . '/../../view/role_show.php'; // Create a view file to display the single role
    }

    // Store a new role (create)
    public function store($request)
    {
        $role = new Role();
        $role->name = $request['name'];
        $db = new Database();
        $db->execute("INSERT INTO roles (name) VALUES (:name)", ['name' => $role->name]);
        $this->index(); // Redirect back to the index page after storing
    }

    // Edit an existing role by ID (fetch the role for editing)
    public function edit($id)
    {
        
        $role = Role::find($id);

        
        $permissions = Permission::all();

        $rolePermissions = $role->permissions();

        
        require __DIR__ . '/../../view/roles_edit.php';
    }

    public function update($id)
    {
        $name = $_POST['name'];
        $assignedPermissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

        $role = Role::find($id);
        if ($role) {
            $role->name = $name;
            $role->save();

            // Sync the role's permissions
            $role->syncPermissions($assignedPermissions);

            // Redirect back to roles list
            header('Location: /roles');
        } else {
            echo 'Role not found';
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $db = new Database();
        $db->execute("DELETE FROM roles WHERE id = :id", ['id' => $role->id]);
        $this->index(); // Redirect back to roles list after deletion
    }
}