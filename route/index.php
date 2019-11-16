<?php

use App\Application\Router;

$router = new Router();

include_once("web.php");

include_once("api.php");

$router->all("*", function ($request) {
    \App\Controller\Web\NotFoundController::index($request);
});
