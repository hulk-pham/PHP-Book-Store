<?php

namespace App\Application;

use App\Interfaces\IRouter;

class Router implements IRouter {


    public function get($path, $handler) {
        if (!$this->checkMethod('get')) return;
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    public function post($path, $handler) {
        if (!$this->checkMethod('post')) return;
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    public function delete($path, $handler) {
        if (!$this->checkMethod('delete')) return;
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    public function put($path, $handler) {
        if (!$this->checkMethod('put')) return;
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    public function patch($path, $handler) {
        if (!$this->checkMethod('patch')) return;
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    public function head($path, $handler) {
        if (!$this->checkMethod('head')) return;
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    public function options($path, $handler) {
        if (!$this->checkMethod('options')) return;
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    public function all($path, $handler) {
        if (!$this->checkPath($path)) return;
        $request = new Request();
        $handler->__invoke($request);
    }

    private function checkMethod($method) {
        return $_SERVER['REQUEST_METHOD'] == strtoupper($method);
    }


    private function checkPath($define_path) {
        // accept all path
        if ($define_path === '*') return true;
        // else
        $currentPath = $_SERVER['REQUEST_URI'];
        if ($currentPath === $define_path) return true;
        return stripos($currentPath, $define_path . '/', 0) === 0
            || stripos($currentPath, $define_path . '?', 0) === 0;
    }
}
