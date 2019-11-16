<?php

namespace App\Interfaces;

interface IRouter {
    public function get($path, $handler);

    public function post($path, $handler);

    public function delete($path, $handler);

    public function put($path, $handler);

    public function patch($path, $handler);

    public function head($path, $handler);

    public function options($path, $handler);

    public function all($path, $handler);
}
