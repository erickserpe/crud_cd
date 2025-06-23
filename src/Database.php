<?php

namespace App;

use mysqli;

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = defined('DB_HOST') ? DB_HOST : '';
        $name = defined('DB_NAME') ? DB_NAME : '';
        $user = defined('DB_USER') ? DB_USER : '';
        $pass = defined('DB_PASS') ? DB_PASS : '';

        mysqli_report(MYSQLI_REPORT_OFF);

        $this->conn = new mysqli($host, $user, $pass, $name);

        if ($this->conn->connect_error) {
            die("Erro de conexão com MySQLi: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8mb4");
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}