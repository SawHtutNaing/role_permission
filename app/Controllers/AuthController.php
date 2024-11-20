<?php
require_once __DIR__ . '../../../core/Database.php'; // Assuming Database class handles DB operations

class AuthController
{

    public $db;
    public function __construct()
    {

        $this->db = new Database();
    }
    public function login()
    {
        require __DIR__ . '/../../view/auth/login.php';
    }



    public function authenticate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if email and password are provided
        if (empty($email) || empty($password)) {
            echo 'Email and password are required!';
            return;
        }

        // Query the database to find the user by email
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = $this->db->execute($sql, [':email' => $email]);

        $user = $result->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;  // Or you can store other user details if needed

            // Redirect to the dashboard after successful login
            header('Location: /roles');
        } else {
            // Return an error message if authentication fails
            echo 'Invalid email or password';
        }
    }


    public function register()
    {
        require __DIR__ . '/../../view/auth/register.php';
    }

    public function storeRegister()
    {
        // Sample logic to store a new user registration
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passConfirmation = $_POST['pass_confirmation'];

        // Basic validation
        if (empty($name) || empty($email) || empty($password)) {
            echo 'All fields are required!';
            return;
        }

        if ($password !== $passConfirmation) {
            echo 'Passwords do not match!';
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $params = [
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword
        ];

        $this->db->execute($sql, $params);
        header('Location: /');
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }
}