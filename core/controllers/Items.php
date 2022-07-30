<?php 
/**
 * Front controller class: display the main page of the todo app.
 */
namespace Core\Controllers;

use Core\Base\Controller;
use Core\Models\Item;

class Items extends Controller {
    // RESTful:
        // Get
        // Post
        // Update - Put or Patch
        // Delete

    public $response_schema = [
        "success" => true,
        // "message" => "",
        "body" => [],
        "message_code" => ""
    ];

    public $request_body;
    public $response_code = 200;
    public $response; 


    function __construct()
    {
        $this->request_body = json_decode(file_get_contents("php://input"), true);
    }

    function render(){
        http_response_code($this->response_code);
        echo json_encode($this->response);
    }

    function index(){
        $res = $this->response_schema;
        $res['message_code'] = "succefull_response";
        $this->response = $res;
    }

    function all(){
        $res = $this->response_schema;
        try {
            $item = new Item();
            $items = $item->get_all();
            if(empty($items)){
                throw new Exception('No items were found');
            }

            foreach ($items as $key => $value) {
                $items[$key]->completed = boolval($value->completed);
            }

            $res['message_code'] = "items_collected_successfully";
            $res['body']['items'] = $items;
            $res['body']['items_count'] = (int) count($item->get_all());
        } catch (\Exception $error) {
            $res['message_code'] = "no_items_found";
            $res['body']['error'] = $error->getMessage();
            $this->response_code = 400;
        }
        
        $this->response = $res;
    }

    // function single(){
    //     echo 'hello from single';
    // }

    function create(){
        $res = $this->response_schema;
        try{
            if(empty($this->request_body)){
                throw new \Exception("empty_json_response");
            }

            if(!isset($this->request_body['name'])){
                throw new \Exception("item_name_not_available");
            }

            $item = new Item();
            $item->add_item($this->request_body['name']);
            $res['message_code'] = 'new_item_added';
        } catch (\Exception $error) {
            $res['message_code'] = $error->getMessage();
            $res['success'] = false;
            $this->response_code = 400;
        }

        $this->response = $res;
    }

    function update(){
        $res = $this->response_schema;

        try {
            if(empty($this->request_body)){
                throw new \Exception('empty_json_response');
            }
            if(!isset($this->request_body['id'])){
                throw new \Exception('item_id_not_available');
            }
            if(!isset($this->request_body['completed'])){
                throw new \Exception('item_compleation_status_not_available');
            }
            if(!is_bool($this->request_body['completed'])){
                throw new \Exception('item_completed_not_bool');
            }

            $item = new Item();
            $item->update_completed($this->request_body['id'], $this->request_body['completed']);

            $res['message_code'] = 'item_updated';
        } catch (\Exception $error) {
            $res['message_code'] = $error->getMessage();
            $res['success'] = false;
            $this->response_code = 400;
        }
        
        $this->response = $res;
    }

    function delete(){
        $res = $this->response_schema;

        try {
            if(empty($this->request_body)){
                throw new \Exception('empty_json_response');
            }
            if(!isset($this->request_body['id'])){
                throw new \Exception('item_id_not_available');
            }

            $item = new Item();
            $item->delete($this->request_body['id']);

            $res['message_code'] = 'item_deleted';
        } catch (\Exception $error) {
            $res['message_code'] = $error->getMessage();
            $res['success'] = false;
            $this->response_code = 400;
        }
        
        $this->response = $res;
    }
}