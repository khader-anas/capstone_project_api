<?php

/**
 * Model class: Controls in DB data (CRUD).
 */

namespace Core\Base;

use Core\Helpers\Tests;

class Model
{
    use Tests;
    protected $data = [];
    protected $connection;
    protected $table;
    public $last_insert_id;

    final function __construct()
    {

        //Create Connection 
        $this->connection = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        self::test(!$this->connection->connect_error, "Connection Failed:" . $this->connection->connect_error);


        $table = get_class($this); // (Core\Models\Option) 
        $table_array = explode('\\', $table); //(Option)
        $table = $table_array[array_key_last($table_array)];
        $this->table = strtolower($table) . "s";
    }

    final function __destruct()
    {
        $this->connection->close();
    }


    //Read all
    function get_all()
    {
        $query = "SELECT * FROM $this->table";
        $collection = new Collection($this->connection, $query);
        return $collection->data;
    }

    //Read single
    function get_by_id($id)
    {
        $query = "SELECT * FROM $this->table WHERE id =$id";
        $collection = new Collection($this->connection, $query);
        return !empty($collection->data) ? $collection->data[0] : null;
    }

    //delete
    function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id=$id";
        return $this->connection->query($query);
    }



    //create
    function insert($value_arr)
    {
        $columns = '';
        $values = '';

        foreach ($value_arr as $column => $column_value) {
            $columns .= $column . ", ";
            $values .= "'$column_value', ";
        }
        $columns = rtrim($columns, ", ");
        $values = rtrim($values, ", ");
        $query = "INSERT INTO $this->table ($columns) VALUES ($values); ";

        $execution = $this->connection->query($query);

        $this->last_insert_id = (int)$this->connection->insert_id;  //(insert => id) 

        return $execution;
    }

    //Update
    function update($id, $col_val_arr)   //applied as ((1),['name'=>'Omar','phone'=>'+121-55452-52'])
    {
        $col_val = '';
        foreach ($col_val_arr as $column => $column_value) {
            $col_val .= "$column =' $column_value', ";  
        }
        $col_val = rtrim($col_val, ", ");
        $query = "UPDATE $this->table  SET $col_val WHERE id=$id";  
        return $this->connection->query($query);
    }

    function custom_query($query)
    {
        return $this->connection->query($query);
    }

    function where($column, $value)    //('name','jhon') 
    {
        $query = "SELECT * FROM $this->table WHERE $column='$value';";
        $collection = new Collection($this->connection, $query);
        $this->data = $collection->data;
        return $this;
    }

    //the all element of data[]..
    function all()
    {
        return $this->data;
    }
    //the first element of data[] and we need check if not empty.
    function first()
    {
        return !empty($this->data) ? $this->data[0] : null;
    }

    function count()
    {
        return count($this->data);
    }
}
