<?php
declare(strict_types=1);

use App\Bot;
use App\Router;

require 'vendor/autoload.php';

$router = new Router();

$update = $router->getUpdates();
$bot = new Bot($_ENV['TOKEN']);
$user = $bot->getAll();

if (isset($update->message)) {
    $message = $update->message;
    $chatId = $message->chat->id;
    $text = $message->text;

    $chadIdUser = $bot->checkForUniqueChatId($chatId);
    if (!$chatId) {
        $bot->startCommand($chatId);
    }

    if ($text == '/start') {
        $bot->startCommand($chatId);
        return;
    }
}