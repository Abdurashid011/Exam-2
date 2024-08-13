<?php

declare(strict_types=1);

use App\Router;
use App\Bot;
use App\Task;

$bot = new Bot($_ENV['TOKEN']);
$task = new Task();
$users = $bot->getAll();

Router::get('/', fn() => require 'view/view.php');
Router::post('/text', function () use ($task, $bot, $users) {
    if (isset($_POST['text'])) {
        $task->addTask($_POST['text']);

        foreach ($users as $user) {
            $bot->sendPost($user['chat_id'], $_POST['text']);
        }
    }
});
