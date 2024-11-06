
<?php

require_once __DIR__ . '/../Models/Feature.php';

class FeatureController
{
    public function index()
    {
        $features = Feature::all();
        require __DIR__ . '/../../view/features.php';
    }
    public function edit($id)
    {
        // Find the feature by its ID
        $feature = Feature::find($id);
        $roles = Role::all();
        if ($feature) {
            // Load the edit view
            require __DIR__ . '/../../view/feature_edit.php';
        } else {
            echo 'Feature not found';
        }
    }
    public function update($id)
    {
        $name = $_POST['name'];
        $roles = $_POST['roles'] ?? []; // Get selected roles from the form

        $feature = Feature::find($id);

        if ($feature) {
            // Update the feature name
            $feature->name = $name;
            $feature->save();

            // Clear existing role assignments
            $db = new Database();
            $db->execute("DELETE FROM feature_role WHERE feature_id = :feature_id", ['feature_id' => $feature->id]);

            // Assign the feature to selected roles
            foreach ($roles as $roleId) {
                $feature->assignToRole($roleId);
            }

            header('Location: /features');
        } else {
            echo 'Feature not found';
        }
    }


    public function store($request)
    {
        $role = new Feature();
        $role->name = $request['name'];
        $db = new Database();
        $db->execute("INSERT INTO features (name) VALUES (:name)", ['name' => $role->name]);
        $this->index();
    }
    public function destroy($id)
    {
        $feature = Feature::find($id);
        $db = new Database();
        $db->execute("DELETE FROM features WHERE id = :id", ['id' => $feature->id]);
        $this->index(); // Redirect back to roles list after deletion
    }
}
