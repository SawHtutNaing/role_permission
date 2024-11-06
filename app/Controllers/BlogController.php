<?php
require_once __DIR__ . '/../Models/Blog.php';

class BlogController
{
    // Example user (you can fetch this from your auth system)
    private $currentUser;

    public function __construct()
    {
        // Simulating the authenticated user
        $this->currentUser = $this->getAuthenticatedUser();
    }

    // Show all blog posts
    public function index()
    {
        // Check if the user has permission to view blogs
        if (!$this->userHasPermission('view_blogs')) {
            echo "You don't have permission to view blogs.";
            exit;
        }

        $blogs = Blog::all();
        require __DIR__ . '/../../view/blogs/index.php';
    }

    // Show a form to create a new blog post
    public function create()
    {
        if (!$this->userHasPermission('create_blog')) {
            echo "You don't have permission to create a blog.";
            exit;
        }

        require __DIR__ . '/../../view/blogs/create.php';
    }

    // Store a new blog post in the database
    public function store()
    {
        if (!$this->userHasPermission('create_blog')) {
            echo "You don't have permission to create a blog.";
            exit;
        }

        $blog = new Blog();
        $blog->title = $_POST['title'];
        $blog->content = $_POST['content'];
        $blog->author = $_POST['author'];
        $blog->save();

        header('Location: /blogs');
    }

    // Show the form to edit an existing blog post
    public function edit($id)
    {
        if (!$this->userHasPermission('edit_blog')) {
            echo "You don't have permission to edit this blog.";
            exit;
        }

        $blog = Blog::find($id);
        require __DIR__ . '/../../view/blogs/edit.php';
    }

    // Update an existing blog post
    public function update($id)
    {
        if (!$this->userHasPermission('edit_blog')) {
            echo "You don't have permission to update this blog.";
            exit;
        }

        $blog = Blog::find($id);
        if ($blog) {
            $blog->title = $_POST['title'];
            $blog->content = $_POST['content'];
            $blog->save();
        } else {
            echo "Blog not found";
        }

        header('Location: /blogs');
    }

    // Delete a blog post
    public function delete($id)
    {
        if (!$this->userHasPermission('delete_blog')) {
            echo "You don't have permission to delete this blog.";
            exit;
        }

        $blog = Blog::find($id);
        if ($blog) {
            $blog->delete();
        }

        header('Location: /blogs');
    }

    // Helper function to check if the authenticated user has the required permission
    private function userHasPermission($permission)
    {
        $roleId = $this->currentUser['role_id'];
       
        
        
        $db = new Database();
        $query = "SELECT COUNT(*) as count 
                  FROM role_permissions rp 
                  JOIN permissions p ON rp.permission_id = p.id 
                  WHERE rp.role_id = :role_id AND p.name = :permission";
        $result = $db->fetchOne($query, [
            'role_id' => 8,
            'permission' => $permission
        ]);

        return $result['count'] > 0;
    }

    // Simulating a method to get the currently authenticated user
    private function getAuthenticatedUser()
{
    // session_start(); 
    if (isset($_SESSION['user'])) {
        return $_SESSION['user']; 
    }
    return null;
}
}