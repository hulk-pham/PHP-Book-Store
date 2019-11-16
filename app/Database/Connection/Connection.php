<?php

namespace App\Database\Connection;

use App\Database\Connection\Type\MySqlConnection;
use App\Database\Connection\Type\SQLServerConnection;
use App\Interfaces\Factory;

class Connection implements Factory {
    public function create($type) {
        switch ($type) {
            case "MySql":
                return new MySqlConnection();
            case "SQLServer";
                return new SQLServerConnection();
            default:
                throw new \Exception("Database connection type does not be supported");
        }
    }
}
