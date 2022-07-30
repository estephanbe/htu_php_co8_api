<?php 
/**
 * Tests trait: to provide testing functionalities inside classes.
 */
namespace Core\Helpers;

use Exception;

trait Tests {

    protected static function test_file_exists($file){
        try {
            if(!file_exists($file)){
                throw new \Exception("The following file was not found: $file");
            }
        } catch (\Exception $error) {
            echo "<table>" . $error->xdebug_message . "</table>";
            die;
        }

        return true;
    }

    protected static function test($testing_expression, $error_msg){
        try {
            if(!$testing_expression){
                throw new \Exception($error_msg);
            }
        } catch (\Exception $error) {
            echo "<table>" . $error->xdebug_message . "</table>";
            die;
        }

        return true;
    }
}