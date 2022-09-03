<?php
require_once './config.php';
// require_once './functions.php';

use Core\Router;

spl_autoload_register(function ($class_name) {
    // Core\Router
    $file_path = __DIR__;   //C:\xampp\htdocs\htucms   ->    constant, the current file path.
    $class_name = explode('\\', $class_name);
    // array(2) { [0]=> string(4) "Core" [1]=> string(6) "Router" }
    foreach ($class_name as  $key => $value) {
        if ($key != array_key_last($class_name)) {
            $class_name[$key] = strtolower($value);
        }
        $file_path .= '/' . $class_name[$key];
    }
    $file_path .= '.php ';
    require_once $file_path;
});


//First Route
Router::get('/', 'front');
//Index Route
Router::get('/api','items.index');
//Read all items
Router::get('/api/items','items.all');
//Add new item 
Router::post('/api/items','items.create');
//Update item 
Router::put('/api/items','items.update');
//Delete item 
Router::delete('/api/items','items.delete');


Router::redirect();
