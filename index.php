<?php 
require_once "./config.php";

use Core\Router;

spl_autoload_register(function($class_name){
    $file_path = __DIR__;
    $class_name = explode('\\', $class_name);

    foreach($class_name as $key => $value){
        if($key != array_key_last( $class_name )){
            $class_name[$key] = strtolower($value);
        }
        $file_path .= '/' . $class_name[$key];
    }
    $file_path .= '.php';
    require_once $file_path;
});

Router::get('/', 'front');

// API Routes
Router::get('/api', 'items.index');
// Get all items
Router::get('/api/items', 'items.all');
// Get single item
// Router::get('/api/items/$id', 'items.single');
// Add new item
Router::post('/api/items', 'items.create');
// Update item compleation
Router::put('/api/items', 'items.update');
// Delete item.
Router::delete('/api/items', 'items.delete');

Router::redirect();
