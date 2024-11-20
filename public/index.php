<?php

require_once __DIR__ . '/../app/Controllers/RoleController.php';
require_once __DIR__ . '/../app/Controllers/PermissionController.php';
require_once __DIR__ . '/../app/Controllers/FeatureController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/BlogController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';

// A simple router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

session_start();


if ($uri === '/') {
    if (isset($_SESSION['user'])) {
        header('Location: /roles');
    } else {
        $controller = new AuthController();
        $controller->login();
    }
} elseif ($uri == '/login/auth') {
    $controller = new AuthController();
    $controller->authenticate();
}
//  elseif ($uri == '/register') {
//     $controller = new AuthController();

//     $controller->register();
// }
 elseif ($uri == '/register/store') {
    $controller = new AuthController();

    $controller->storeRegister();
} elseif ($uri == '/logout') {
    $controller = new AuthController();

    $controller->logout();
} elseif ($uri === '/roles') {

    $controller = new RoleController();
    $controller->index(); // Display all roles
} elseif (preg_match('/\/roles\/edit\/(\d+)/', $uri, $matches)) {
    $controller = new RoleController();
    $id = $matches[1]; // Extract ID from URI
    $controller->edit($id); // Display form for editing the role with this ID
} elseif (preg_match('/\/roles\/show\/(\d+)/', $uri, $matches)) {
    $controller = new RoleController();
    $id = $matches[1]; // Extract ID from URI
    $controller->show($id); // Display the role details for this ID
} elseif ($uri === '/roles/store') {
    $controller = new RoleController();
    $controller->store($_POST); // Store a new role
} elseif (preg_match('/\/roles\/update\/(\d+)/', $uri, $matches)) {
    $controller = new RoleController();
    $id = $matches[1]; // Extract ID from URI
    $controller->update($id, $_POST); // Update the role with this ID
} elseif (preg_match('/\/roles\/delete\/(\d+)/', $uri, $matches)) {
    $controller = new RoleController();
    $id = $matches[1]; // Extract ID from URI
    $controller->destroy($id); // Delete the role with this ID

    // Handle CRUD for Permissions
} elseif ($uri === '/permissions') {
    $controller = new PermissionController();
    $controller->index(); // Display all permissions
} elseif (preg_match('/\/permissions\/edit\/(\d+)/', $uri, $matches)) {
    $controller = new PermissionController();
    $id = $matches[1]; // Extract ID from URI
    $controller->edit($id); // Display form for editing the permission with this ID
} elseif (preg_match('/\/permissions\/show\/(\d+)/', $uri, $matches)) {
    $controller = new PermissionController();
    $id = $matches[1]; // Extract ID from URI
    $controller->show($id); // Display the permission details for this ID
} elseif ($uri === '/permissions/store') {
    $controller = new PermissionController();
    $controller->store($_POST); // Store a new permission
} elseif (preg_match('/\/permissions\/update\/(\d+)/', $uri, $matches)) {
    $controller = new PermissionController();
    $id = $matches[1]; // Extract ID from URI
    $controller->update($id, $_POST); // Update the permission with this ID
} elseif (preg_match('/\/permissions\/delete\/(\d+)/', $uri, $matches)) {
    $controller = new PermissionController();
    $id = $matches[1]; // Extract ID from URI
    $controller->destroy($id); // Delete the permission with this ID

    // Handle CRUD for Features
} elseif ($uri === '/features') {
    $controller = new FeatureController();
    $controller->index(); // Display all features
} elseif (preg_match('/\/features\/edit\/(\d+)/', $uri, $matches)) {
    $controller = new FeatureController();
    $id = $matches[1]; // Extract ID from URI
    $controller->edit($id); // Display form for editing the feature with this ID
} elseif (preg_match('/\/features\/show\/(\d+)/', $uri, $matches)) {
    $controller = new FeatureController();
    $id = $matches[1]; // Extract ID from URI
    $controller->show($id); // Display the feature details for this ID
} elseif ($uri === '/features/store') {
    $controller = new FeatureController();
    $controller->store($_POST); // Store a new feature
} elseif (preg_match('/\/features\/update\/(\d+)/', $uri, $matches)) {
    $controller = new FeatureController();
    $id = $matches[1]; // Extract ID from URI
    $controller->update($id, $_POST); // Update the feature with this ID
} elseif (preg_match('/\/features\/delete\/(\d+)/', $uri, $matches)) {
    $controller = new FeatureController();
    $id = $matches[1]; // Extract ID from URI
    $controller->destroy($id); // Delete the feature with this ID
} elseif ($uri === '/blogs') {
    $controller = new BlogController();
    $controller->index(); // Display all blogs
} elseif ($uri == '/blogs/create') {
    $controller = new BlogController();

    $controller->create();
} elseif (preg_match('/\/blogs\/edit\/(\d+)/', $uri, $matches)) {
    $controller = new BlogController();
    $id = $matches[1];
    $controller->edit($id); // Display form for editing the blog
} elseif (preg_match('/\/blogs\/show\/(\d+)/', $uri, $matches)) {
    $controller = new BlogController();
    $id = $matches[1];
    $controller->show($id); // Show blog details
} elseif ($uri === '/blogs/store') {
    $controller = new BlogController();
    $controller->store($_POST); // Handle form submission to store a new blog
} elseif (preg_match('/\/blogs\/update\/(\d+)/', $uri, $matches)) {
    $controller = new BlogController();
    $id = $matches[1];
    $controller->update($id, $_POST); // Handle form submission to update blog
} elseif (preg_match('/\/blogs\/delete\/(\d+)/', $uri, $matches)) {
    $controller = new BlogController();
    $id = $matches[1];
    $controller->delete($id); // Handle deletion of a blog

    // Default: 404 Page
}
elseif($uri == '/users'){
    $controller = new UserController();
    $controller->index();

}
elseif ($uri == '/users/create') {
    $controller = new UserController();

    $controller->create();
} 
elseif ($uri == '/users/store') {
    $controller = new UserController();

    $controller->store($_POST);
} 


 elseif (preg_match('/\/users\/edit\/(\d+)/', $uri, $matches)) {
    $controller = new UserController();
    $id = $matches[1];
    $controller->edit($id); 
}


elseif (preg_match('/\/users\/update\/(\d+)/', $uri, $matches)) {
    $controller = new UserController();
    $id = $matches[1];
    $controller->update($id); 
}
else {
    echo "Page not found";
}