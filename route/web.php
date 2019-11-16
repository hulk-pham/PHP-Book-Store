<?php


use App\Controller\Web\HomeController;

$router->get("/home", function ($request) {
    HomeController::index($request);
});


$router->post('/ad', function ($request) {
});
