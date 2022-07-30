<?php

/**
 * Model class: parent class of model classes
 */

namespace Core\Base;

use Core\Helpers\Tests;

class Model
{

    use Tests;
    protected $connection;
    protected $table = null;
    public $data = [];
    public $last_insert_id;
    // Open connection
    // Manipulate DB (CRUD Ops)
    // Use DB data
    // Close connection

    // CRUD: Create, Read All, Read Single, Update, Delete.
    final function __construct()
    {
        // Create connection
        $this->connection = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        self::test(!$this->connection->connect_error, "Connection failed: " . $this->connection->connect_error);

        // Get the class name. => Option
        $table = get_class($this); // Core\Models\Option
        $table_arr = explode('\\', $table);
        $table = $table_arr[array_key_last($table_arr)]; // Option
        // Lower case the class name. => option
        // Add "s" to the class name. => options
        $this->table = strtolower($table) . "s";
    }

    final function __destruct()
    {
        $this->connection->close();
    }

    // Read all.
    function get_all()
    {
        $query = "SELECT * FROM $this->table";
        $collection = new Collection($this->connection, $query);

        return $collection->data;
    }

    // Read Single
    function get_by_id($id)
    {
        $query = "SELECT * FROM $this->table WHERE id=$id;";
        $collection = new Collection($this->connection, $query);

        return !empty($collection->data) ? $collection->data[0] : null;
    }

    // Delete
    function delete($id)
    {
        $query = "DELETE FROM $this->table WHERE id=$id;";
        return $this->connection->query($query);
    }

    // Create 
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
        
        $query = "INSERT INTO $this->table ($columns) VALUES ($values);";
        $excution = $this->connection->query($query);
        $this->last_insert_id = (int) $this->connection->insert_id;
        return $excution;
    }

    // Update
    function update($id, $col_val_arr){
        $col_val = '';
        foreach ($col_val_arr as $column => $column_value) {
            if(is_bool($column_value)){
                $bool_val = $column_value ? 'true' : 'false';
                $col_val .= "$column=$bool_val, ";
            } else {
                $col_val .= "$column='$column_value', ";
            }
            
        }
        $col_val = rtrim($col_val, ", ");
        
        $query = "UPDATE $this->table SET $col_val WHERE id=$id;";

        return $this->connection->query($query);
    }

    function custom_query($query){
        return $this->connection->query($query);
    }

    function where($column, $value){
        $query = "SELECT * FROM $this->table WHERE $column='$value';";
        $collection = new Collection($this->connection, $query);
        $this->data = $collection->data;
        return $this;
    }

    function all(){
        return $this->data;
    }

    function first(){
        return !empty($this->data) ? $this->data[0] : null;
    }

    function count(){
        return count($this->data);
    }


    
}
