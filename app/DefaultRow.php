<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 06.02.19
 * Time: 15:10
 */

require_once 'DB.php';

class DefaultRow {

    protected $validations = [
        'country' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'school' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'class' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'moderator_name' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'date' => [
            'required'  => true,
            'length'    => 10,
            'type'      => 'string'
        ],
        'gender' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ]
    ];

    protected $table = 'TABLE_NAME';

    protected $data = [];

    protected $existingTables = ['movie1', 'movie2'];

    public function __construct(array $data) {

        $this->data = $data;
    }

    public function preserve() {

        $this->validateData();

        $pdo = DB::getPDO();

        $columns = $this->getColumns();
        $sql = "insert into {$this->table} ({$columns}) values ({$this->getParams()});";

        $query = $pdo->prepare($sql);

        $columns = explode(', ', $columns);
        foreach ($columns as $column) {

            $query->bindParam(":{$column}", $this->data[$column], $this->getDataType($column));
        }

        $query->execute();
    }

    protected function getColumns() {

        $columns = array_keys($this->data);

        return implode(', ', $columns);
    }
    protected function getParams() {

        $columns = array_keys($this->data);
        foreach ($columns as &$column) {

            $column = ':' . $column;
        }

        return implode(', ', $columns);
    }

    protected function getDataType(string $column) {

        $dataType = $this->validations[$column]['type'];

        switch (strtolower($dataType)) {

            case 'integer':

                return PDO::PARAM_INT;
            case 'int':

                return PDO::PARAM_INT;
            case 'boolean':

                return PDO::PARAM_BOOL;
            case 'bool':

                return PDO::PARAM_BOOL;
            case 'null':

                return PDO::PARAM_NULL;
            case 'string':

                return PDO::PARAM_STR;
            case 'str':

                return PDO::PARAM_STR;
            default:

                return PDO::PARAM_STR;
        }
    }

    protected function validateData() {

        $emptyFields = [];
        foreach ($this->validations as $field => $requirements) {

            if ($requirements['required'] === true && !isset($this->data[$field])) {

                $this->data[$field] = '';
                $emptyFields[] = $field;
            }

            if ($this->data[$field] === '') {

                if (!in_array($field, $emptyFields)) {

                    $emptyFields[] = $field;
                }
            }

            if (isset($this->data[$field]) && strlen($this->data[$field]) > $requirements['length']) {

                $this->data[$field] = substr(0, $requirements['length']);
            }
        }

        if (!empty($emptyFields)) {

            $operator = count($emptyFields) > 1 ? 'are' : 'is';
            throw new Exception('Fields: ' . implode(', ', $emptyFields) . " {$operator} missing or {$operator} empty.");
        }
    }

    public function retrieve() {

        $sources = $this->createSource();

        $response = [];
        foreach ($sources as $source) {

            $source = trim($source);

            if (!in_array($source, $this->existingTables)) {

                continue;
            }

            $response[$source] = $this->makeSelect($source);
        }

        return $response;
    }

    protected function createSource() {
        if (!isset($this->data['source'])) {

            return ['movie1'];
        } else {

            $source = $this->data['source'];
            unset($this->data['source']);
            return explode(',', $source);
        }
    }

    protected function makeSelect($source) {

        $pdo = DB::getPDO();

        $sql = "select * from {$source}";

        $conditions = [];
        if (!empty($this->data)) {

            foreach ($this->data as $column => $value) {

                $conditions[] = $column . ' = :' . $column;
            }

            $sql .= ' where ' . implode(' and ', $conditions);

            $query = $pdo->prepare($sql);

            foreach ($this->data as $column => $value) {

                $query->bindParam(":{$column}", $this->data[$column], $this->getDataType($column));
            }

            $query->execute();
        } else {

            $query = $pdo->prepare($sql);
            $query->execute();
        }

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}