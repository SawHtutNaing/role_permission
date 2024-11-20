<?php 


require_once  __DIR__ . '/../Models/User.php';
require_once  __DIR__ . '/../Models/Role.php';
require_once __DIR__ . '/../../core/Database.php';


class UserController{

    public $user ; 
    public $currentUser ; 
    
    public function __construct()
    {
        $this->user = new  User();
        $this->currentUser = $this->getAuthenticatedUser();
        
    }


    public function index(){
        $users  = $this->user->all();
        $create_permission = $this->userHasPermission('user_create');
        $update_permission = $this->userHasPermission('user_update');
        $delete_permission = $this->userHasPermission('user_delete');

        require_once  __DIR__ . '/../../view/user/index.php';

    }


    public function edit($id){
        $user = $this->user->edit($id);
        $db = new Database();

        $roles = $db->fetchAll("SELECT * FROM roles");
        
        
        require_once  __DIR__ . '/../../view/user/edit.php';

    }

    
    public function update($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = new Database();
        
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role_id = $_POST['role_id'];
        
            
            $query = "UPDATE users SET name = :name, email = :email, role_id = :role_id WHERE id = :id";
            $db->execute($query, [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'role_id' => $role_id
            ]);
    }
    return $this->edit($id);
}


function create() {
    

    $role = new Role();
        $roles = $role::all();

    
        
        require_once  __DIR__ . '/../../view/user/create.php';
}

private function getAuthenticatedUser()
{
    // session_start(); 
    if (isset($_SESSION['user'])) {
        return $_SESSION['user']; 
    }
    return null;
}


private function userHasPermission($permission)
{
    $roleId = $this->currentUser['role_id'];
   
    
    
    $db = new Database();
    $query = "SELECT COUNT(*) as count 
              FROM role_permission rp 
              JOIN permissions p ON rp.permission_id = p.id 
              WHERE rp.role_id = :role_id AND p.name = :permission";
    $result = $db->fetchOne($query, [
        'role_id' => $roleId,
        'permission' => $permission
    ]);

    return $result['count'] > 0;
}


function store() {
    // Get the POST data
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $role_id = $_POST['role_id'] ?? null;

    // Basic validation to ensure fields are not empty
    if (empty($name) || empty($email) || empty($password) || empty($role_id)) {
        return 'All fields are required.';
    }

    // Ensure email is unique
    $db = new Database();
    $sql = "SELECT * FROM users WHERE email = :email";
    $existingUser = $db->fetchOne($sql, ['email' => $email]);

    if ($existingUser) {
        return 'Email already exists.';
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Generate a random remember token
    $rememberToken = bin2hex(random_bytes(30));

    // Insert the new user into the database
    $sql = "INSERT INTO users (name, email, password, role_id, remember_token) 
            VALUES (:name, :email, :password, :role_id, :remember_token)";

    $params = [
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
        'role_id' => $role_id,
        'remember_token' => $rememberToken
    ];

    if ($db->execute($sql, $params)) {
        header('Location: /users');
        
    }
}







}