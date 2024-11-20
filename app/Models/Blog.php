<?php

require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../Models/User.php';

class Blog
{
    public $id;
    public $title;
    public $content;
    public $user_id;
    public $created_at;
    public $updated_at;
    public $userName;
    
    public $userModel ;
    public $currentUser ;

    

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

    
    public static function find($id)
    {
        $db = new Database();
        $result = $db->fetch("SELECT * FROM blogs WHERE id = :id", ['id' => $id]);
        
        if ($result) {
            return self::toBlogObject($result);
        }

        return null;
    }


    
    private static function toBlogObject($result)
    {
        $blog = new Blog();
        $blog->id = $result->id;
        $blog->title = $result->title;
        $blog->content = $result->content;
        $blog->user_id = $result->user_id;
        

        $getUser = User::find($result->user_id);

        if ($getUser) { 
            $blog->userName = $getUser->name;
        } else {
            $blog->userName = 'Unknown User'; 
            $blog->id = 1;

        }
        $blog->created_at = $result->created_at;
        $blog->updated_at = $result->updated_at;

        return $blog;
    }

    
    public function save()
    {
        $db = new Database();
        $now = date('Y-m-d H:i:s'); 


        if ($this->id) {
            // Update existing blog post
            $db->execute("UPDATE blogs SET title = :title, content = :content, user_id = :user_id, updated_at = :updated_at WHERE id = :id", [
                'title'   => $this->title,
                'content' => $this->content,
                'user_id'  => $this->user_id,
                'id'      => $this->id , 
            'updated_at' => $now

            ]);
        } else {
            // Create a new blog post
            $db->execute("INSERT INTO blogs (title, content, user_id, created_at, updated_at) VALUES (:title, :content, :user_id, :created_at, :updated_at)", [
                'title'   => $this->title,
                'content' => $this->content,
                'user_id'  => $this->user_id,
                'created_at' => $now, 
            'updated_at' => $now
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
