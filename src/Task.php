<?php

namespace App;

use PDO;

class Task
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function addTask(string $text)
    {
        $stmt = $this->pdo->prepare("INSERT INTO posts (text) VALUES (:text)");
        $stmt->bindParam(':text', $text);
        $stmt->execute();
        header('location: /');
    }

    public function getAllTasks()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}