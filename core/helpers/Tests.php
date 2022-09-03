<?php

/*
Error handling by traits class
*/

namespace Core\Helpers;

trait Tests
{

    protected static function test_file_exists($file)
    {


        try {
            if (!file_exists($file)) {
                throw new \Exception("The following file was not found: $file");
            }
        } catch (\Exception $error) {
        //    "<table>". var_dump($error) ."<table>"; 
        //     // echo $error->getMessage();
            die;
        }

        return true;
    }


    protected static function test($testing_expression, $error_msg) {

        try {
            if (!$testing_expression) {  
                throw new \Exception($error_msg);
            }
        } catch (\Exception $error) {
        //    "<table>". var_dump($error) ."<table>"; 
            echo $error->getMessage();
            die;
        }
    
        return true;
    }
}
