<?php

use App\Router;

$router = new Router();
if ($router->isTelegram()) {
    require 'router/telegram.php';
}

require 'router/web.php';