<?php

declare(strict_types=1);

namespace App;

class Router
{
    private $update;

    public function __construct()
    {
        $this->update = json_decode(file_get_contents('php://input'));
    }

    public function isTelegram()
    {
        if (isset($this->update) && isset($this->update->update_id)) {
            return true;
        }
        return false;
    }

    public function getUpdates()
    {
        return $this->update;
    }

    public static function get($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && parse_url($_SERVER['REQUEST_URI'])['path'] === $path) {
            $callback();
            exit();
        }
    }

    public static function post($path, $callback): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === $path) {
            $callback();
            exit();
        }
    }
}