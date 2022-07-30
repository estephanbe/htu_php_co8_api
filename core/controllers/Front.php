<?php 
/**
 * Front controller class: display the main page of the todo app.
 */
namespace Core\Controllers;

use Core\Base\Controller;

class Front extends Controller {

    function render(){
        require_once dirname(__DIR__, 2) . "/resources/views/todo.php";
    }
}