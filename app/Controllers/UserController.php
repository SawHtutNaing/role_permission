<?php 


require_once  __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../../core/Database.php';


class UserController{

    public $user ; 
    public function __construct()
    {
        $this->user = new  User();
    }


    public function index(){
        $users  = $this->user->all();
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
}