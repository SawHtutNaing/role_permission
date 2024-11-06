
<?php

require_once __DIR__ . '/../../core/Database.php';

class Feature
{
    public $id;
    public $name;

    public static function find($id)
    {
        $db = new Database();
        $result = $db->fetch("SELECT * FROM features WHERE id = :id", ['id' => $id]);

        if ($result) {
            $feature = new self();
            $feature->id = $result->id;
            $feature->name = $result->name;
            return $feature;
        }

        return null;
    }

    public static function all()
    {
        $db = new Database();
        return $db->fetchAll("SELECT * FROM features");
    }

    public function save()
    {
        $db = new Database();
        if ($this->id) {
            // Update existing feature
            $db->execute("UPDATE features SET name = :name WHERE id = :id", [
                'name' => $this->name,
                'id' => $this->id
            ]);
        } else {
            // Create new feature (if needed)
            $db->execute("INSERT INTO features (name) VALUES (:name)", [
                'name' => $this->name
            ]);
            $this->id = $db->lastInsertId(); // Set the new feature ID
        }
    }

    public function assignToRole($roleId)
    {
        $db = new Database();
        $db->execute("INSERT INTO feature_role (role_id, feature_id) VALUES (:role_id, :feature_id)", [
            'role_id' => $roleId,
            'feature_id' => $this->id
        ]);
    }

    public function roles()
    {
        $db = new Database();
        $roles = $db->fetchAll("SELECT role_id FROM feature_role WHERE feature_id = :feature_id", [
            'feature_id' => $this->id
        ]);

        return array_column($roles, 'role_id');
    }

    public function features()
    {
        $db = new Database();
        $features = $db->fetchAll("SELECT feature_id FROM feature_role WHERE role_id = :role_id", ['role_id' => $this->id]);
        return array_column($features, 'feature_id');
    }
}
