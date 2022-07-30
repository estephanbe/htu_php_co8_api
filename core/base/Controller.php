<?php 
/**
 * Controller class: parent class of controller classes
 */
namespace Core\Base;

abstract class Controller {

    public $data = [];

    abstract public function render();

}