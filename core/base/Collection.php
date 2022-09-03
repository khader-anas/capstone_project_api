<?php

namespace Core\Base;

use Core\Helpers\Tests;

class Collection
{
    use Tests;

    private $columns = [];
    private $item_schema = [];
    public $data = [];

    function __construct($connection, $query)
    {

        $result = $connection->query($query);
        $this->create_schema($result);
        $this->fill_data($result);
     }


    private function create_schema($query_result)
    {
        //Get the columns names
        foreach ($query_result->fetch_fields() as $field) { 
           $this->columns[] = $field->name;
           $this->item_schema[$field->name] = null;  
        }
       self::test(!array_key_exists('id',$this->columns),"Please make sure to use a primary key column and it's name ID."); 
    }


    private function fill_data($query_result)                   
    {
        if ($query_result->num_rows > 0) {
            while ($row = $query_result->fetch_assoc()) {   
                $item = $this->item_schema;    

                foreach ($this->columns as $column) { 
                    $item[$column] = $column == 'id'? (int) $row[$column] : $row[$column] ;
                }
                $this->data[] = (object) $item;    
            }
        }
    }
}