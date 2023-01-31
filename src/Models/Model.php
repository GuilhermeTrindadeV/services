<?php

namespace Src\Models;

use Exception;

use GTG\DataLayer\DataLayer;
use GTG\DataLayer\Connect;

class Model extends DataLayer 
{
    protected static $tableName = "";
    protected static $primaryKey = "";
    protected static $columns = [];
    protected static $required = [];
    protected static $driver = DATA_LAYER["driver"];
    
    protected $values = [];

    public function __construct() 
    {
        parent::__construct(static::$tableName, static::$required, static::$primaryKey, false);
    }

    public function __get($key) 
    {
        parent::__get($key);
        return $this->values[$key];
    }

    public function __set($key, $value) 
    {
        parent::__set($key, $value);
        $this->values[$key] = $value;
    }

    public function getValues(): array 
    {
        foreach(static::$columns as $col) {
            $this->values[$col] = $this->data->$col;
        }
        return $this->values;
    }

    public function setValues(array $values = []): void 
    {
        foreach($values as $column => $value) {
            $this->$column = $value;
            $this->values[$column] = $value;
        }
    }
    
    public static function getMappedObjects(array $objects = [], ?string $column = null): array 
    {
        $mappedObjects = [];
        if($objects) {
            foreach($objects as $object) {
                $mappedObjects[$object->{$column}] = $object;
            }
        }

        return $mappedObjects;
    }

    public static function getPropertyValues(array $objects = [], string $property = 'id'): array 
    {
        $values = [];

        if($objects) {
            foreach($objects as $object) {
                $values[] = $object->$property;
            }
        }

        return $values;
    }

    public static function getOne(array $filters = [], string $columns = "*") 
    {
        $class = get_called_class();
        $instance = new $class();

        $finders = static::getFilters($filters);

        $result = $instance->find($finders[0], $finders[1])->fetch(false);
        if($result) {
            return $result;
        }

        return null;
    }

    public static function get(array $filters = [], string $columns = "*"): ?array 
    {
        $class = get_called_class();
        $instance = new $class();

        $finders = static::getFilters($filters);

        $objects = [];
        $objects = $instance->find($finders[0], $finders[1], $columns)->fetch(true);
        if($objects) {
            return $objects;
        }

        return null;
    }

    public static function getById(int $id, string $columns = "*") 
    {
        $class = get_called_class();
        $instance = new $class();

        $result = $instance->findById($id, $columns);
        return $result;
    }

    public static function getByIds(array $ids, string $columns = "*") 
    {
        $class = get_called_class();
        $instance = new $class();

        $in = "";
        foreach($ids as $id) {
            $in .= "{$id},";
        }
        $in[strlen($in) - 1] = " ";

        $result = $instance->find(static::$primaryKey . " IN ({$in})", null, $columns)->fetch(true);
        return $result;
    }

    public static function getGroupedBy(array $objects = [], string $column = ""): ?array 
    {
        if(!$column) $column = static::$primaryKey;

        if($objects) {
            foreach($objects as $object) {
                $grouped[$object->$column] = $object;
            }

            return $grouped;
        }
        return null;
    }

    public static function getCount(array $filters = []): ?int 
    {
        $count = 0;
        $class = get_called_class();
        $instance = new $class();
        $finders = static::getFilters($filters);

        $count = $instance->find($finders[0], $finders[1])->count();
        
        return $count;
    }

    public function save(): bool 
    {
        foreach(static::$columns as $col) {
            if(!is_null($this->$col)) {
                $this->$col = html_entity_decode($this->$col);
            } else {
                unset($this->$col);
            }
        }

        $result = parent::save();
        if($this->fail()) {
            throw new Exception("Ocorreu um erro ao inserir/atualizar os dados no banco.");
        }

        $this->{static::$primaryKey} = $this->data->{static::$primaryKey};
        return $result;
    }

    public static function deleteAll(): void 
    {
        $sql = "DELETE FROM " . static::$tableName;
        $connect = Connect::getInstance();
        $connect->query($sql);
    }

    protected static function executeSQL(string $sql) 
    {
        $connect = Connect::getInstance();
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    }

    private static function getSearch(string $terms = '', array $columns = []): string 
    {
        if($terms && $columns) {
            $words = explode(' ', $terms);
            $conds = array();
            $searches = array();
            $numCols = count($columns);
    
            foreach($words as $word) {
                $col = 1;
                foreach($columns as $column) {
                    $open = $col == 1 ? ' ( ' : '';
                    $close = $col == $numCols ? ' ) ' : '';
                    $conds[] = "{$open} {$column} LIKE '%" . $word . "%' {$close}";
                    $col++;
                }
                $searches[] = implode(' OR ', $conds);
                $conds = [];
                $col = 1;
            }
    
            $query .= implode(' AND ', $searches);
            return $query;
        } else {
            return "";
        }
    }

    private static function getSorting(array $sorting = []): string 
    {
        $sql = "";
        if(count($sorting) > 0) {
            foreach($sorting as $column => $value) {
                if($column == "raw") {
                    $sql .= "{$value}";
                } else {
                    $sql .= "{$column} {$value},";
                }
            }

            if($sql) $sql[strlen($sql) - 1] = " ";
            return $sql;
        }

        return "";
    }

    private static function getJoins(array $joins = []): string 
    {
        $sql = "";

        if(count($joins) > 0) {
            foreach($joins as $table => $conditions) {
                $sql .= "LEFT JOIN " . $table . " ON ";
                foreach($conditions as $column => $value) {
                    if($column == "raw") {
                        $sql .= "{$value} AND ";
                    } else {
                        $sql .= "{$entity}.{$column} = " . static::getFormatedValue($value) . " AND ";
                    }
                }
                $sql = substr($sql, 0, -4);
            }
        }

        return $sql;
    }

    private static function getFilters(array $filters = []): array 
    {
        $terms = "";
        $params = "";
        $count = 0;

        if(count($filters) > 0) {
            foreach($filters as $column => $value) {
                $count++;
                if($column == "raw") {
                    $terms .= "{$value} AND ";
                } elseif($column == "search") {
                    if($value["term"] && $value["columns"]) {
                        $terms .= static::getSearch($value["term"], $value["columns"]) . " AND ";
                    }
                } elseif($column == ">=" || $column == "<=" || $column == "<" || $column == ">") {
                    if($value) {
                        foreach($value as $col => $val) {
                            $terms .= "{$col} {$column} " . static::getFormatedValue($val) . " AND ";
                        }
                    }
                } else {
                    $terms .= "{$column} = :param{$count} AND ";
                    $params .= "param{$count}={$value}&";
                }
            }

            if($terms) $terms = substr($terms, 0, -4);
            if($params) $params = substr($params, 0, -1);

            return [$terms, $params];
        }

        return [];
    }

    private static function getFormatedValue($value) 
    {
        if(is_null($value)) {
            return "null";
        } elseif(gettype($value) === 'string') {
            $value = html_entity_decode($value);
            return "'${value}'";
        } else {
            return $value;
        }
    }
}