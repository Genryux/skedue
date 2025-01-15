<?php

namespace Core;
use Exception;
use PDO;

class Database {

    public $connection;
    public $stmt;

    public function __construct($config, $username = 'root', $password = 'root')
    {
        try {

            $dsn = 'mysql:'.http_build_query($config, '', ';');

            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

        } catch (Exception $e) {
            throw $e;
        }

    }

    public function query($query, $params = []) {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);

        return $this;
    }

    public function get() {
        return $this->stmt->fetchAll();
    }

    public function find() {
        return $this->stmt->fetch();
    }

    public function findOrFail() {
        $result = $this->find();

        if (! $result) {
            abort();

            return $result;
        }
    }

}