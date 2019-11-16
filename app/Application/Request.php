<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 11/16/19
 * Time: 2:50 PM
 */

namespace App\Application;


class Request {

    public $server_name = '';
    public $serve_port = '';
    public $host = '';
    public $path = '';
    public $uri = '';
    public $full_url = '';
    public $request_time = '';
    public $raw_info = '';

    public function __construct() {
        $this->server_name = $_SERVER['SERVER_NAME'];
        $this->serve_port = $_SERVER['SERVER_PORT'];
        $this->host = $_SERVER['HTTP_HOST'];
        $this->path = $_SERVER['PATH_INFO'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->full_url = $this->host . $this->uri;
        $this->request_time = $_SERVER['REQUEST_TIME'];

        // parse params from request dynamic
        foreach ($_REQUEST as $key => $param) {
            $this->{$key} = $param;
        }
    }
}
