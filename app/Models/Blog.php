<?php

require_once __DIR__ . '/../../core/Database.php';

class Blog
{
    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    // Fetch all blog posts
    public static function all()
    {
        $db = new Database();
        $results = $db->fetchAll("SELECT * FROM blogs ORDER BY created_at DESC");

        // Convert each result to a Blog object
        $blogs = [];
        foreach ($results as $result) {
            $blogs[] = self::toBlogObject($result);
        }

        return $blogs;
    }

    // Find a blog post by ID
    public static function find($id)
    {
        $db = new Database();
        $result = $db->fetch("SELECT * FROM blogs WHERE id = :id", ['id' => $id]);

        // If a result is found, return it as a Blog object
        if ($result) {
            return self::toBlogObject($result);
        }

        return null;
    }

    // Convert a database row to a Blog object
    private static function toBlogObject($result)
    {
        $blog = new Blog();
        $blog->id = $result->id;
        $blog->title = $result->title;
        $blog->content = $result->content;
        $blog->author = $result->author;
        $blog->created_at = $result->created_at;
        $blog->updated_at = $result->updated_at;

        return $blog;
    }

    // Create or update a blog post
    public function save()
    {
        $db = new Database();

        if ($this->id) {
            // Update existing blog post
            $db->execute("UPDATE blogs SET title = :title, content = :content, author = :author WHERE id = :id", [
                'title'   => $this->title,
                'content' => $this->content,
                'author'  => $this->author,
                'id'      => $this->id
            ]);
        } else {
            // Create a new blog post
            $db->execute("INSERT INTO blogs (title, content, author) VALUES (:title, :content, :author)", [
                'title'   => $this->title,
                'content' => $this->content,
                'author'  => $this->author
            ]);
            $this->id = $db->lastInsertId();
        }
    }

    // Delete a blog post
    public function delete()
    {
        $db = new Database();
        $db->execute("DELETE FROM blogs WHERE id = :id", ['id' => $this->id]);
    }
}
