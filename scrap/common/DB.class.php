<?php

class DB extends PDO    {
    private $host = 'localhost';
    private $user = 'jjhome';
    private $password = 'Admin@japan2';
    private $options = array();

    public function __construct($database)
    {
        parent::__construct("mysql:host=$this->host;dbname=$database;charset=utf8", $this->user, $this->password, $this->options);
    }
}