<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 07.02.19
 * Time: 09:48
 */

require 'helpers/ConfigHelper.php';

class DB {

    protected $connection = null;

    public function __construct() {

        try {

            $this->connection = new PDO($this->createDSNString(), $this->getDBUser(), $this->getDBPassword());
        } catch (PDOException $e) {

            throw new Exception('Can\'t connect to mysql server. Error. ' . $e->getMessage());
        }
    }

    public static function getPDO() {

        $db = new DB();
        return $db->getConnection();
    }

    protected function createDSNString() {

        $dbConfig = ConfigHelper::get('db');

        return $dbConfig['driver'] . ':host=' . $dbConfig['host'] . ((isset($dbConfig['port']) && !empty($dbConfig['port'])) ? (';port=' . $dbConfig['port']) : '') . ';dbname=' . $dbConfig['schema'];
    }

    protected function getDBUser() {

        $dbConfig = ConfigHelper::get('db');

        return $dbConfig['username'];
    }

    protected function getDBPassword() {

        $dbConfig = ConfigHelper::get('db');

        return $dbConfig['password'];
    }

    public function getConnection() {

        return $this->connection;
    }
} 