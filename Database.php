<?php

require('./vendor/autoload.php');

class Database {

    public $database;
    public $client;
    public $collection;
    
    public function __construct() {
        
        try {
            $this->client = new MongoDB\Client('mongodb://localhost:27017/');
            $this->database = $this->client->selectDatabase('Skedue_DB');
            echo 'successfully connected';
        } catch (Exception $e) {
            echo 'Failed to establish connection'.$e->getMessage();
        }

    }
}