<?php

namespace App;

use GuzzleHttp\Client;

class Bot
{
    private \PDO $pdo;
    private Client $http;
    const string REQUEST_API = "https://api.telegram.org/bot";

    public function __construct(string $token)
    {
        $this->pdo = DB::connect();
        $this->http = new Client(['base_uri' => self::REQUEST_API . $token . "/"]);
    }

    public function startCommand(int $chatId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (chat_id) VALUES (:chatId)");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->execute();
    }

    public function getAll(): false|array
    {
        $stmt = $this->pdo->query("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function checkForUniqueChatId(int $chatId): bool
    {
        $stmt = $this->pdo->prepare("SELECT chat_id FROM users WHERE chat_id = :chatId");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result !== false;
    }

    public function sendPost($chatId, $post): void
    {
        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $post,
            ]
        ]);
    }
}