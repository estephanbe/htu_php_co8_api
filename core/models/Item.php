<?php 
/**
 * Item model class: manage information and data in the items table. 
 */

 namespace Core\Models;

use Core\Base\Model;

 class Item extends Model{
    public function add_item($item_name){
        $this->insert([
            "name" => $item_name
        ]);
    }

    public function update_completed($id, $status){
        $this->update($id, ['completed' => $status]);
    }
 }