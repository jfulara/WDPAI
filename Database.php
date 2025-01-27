<?php

require 'config.php';
class Database
{
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct() {
        $this->host = DB_HOST;
        $this->username = DB_USER;
        $this->password = DB_PASSWORD;
        $this->database = DB_DATABASE;
    }

    public function connect() {
        try {
            $conn = new PDO("pgsql:host=$this->host;port=5432;dbname=$this->database", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch(PDOException $e) {
            die("Connection failed: ".$e->getMessage());
        }
    }
}