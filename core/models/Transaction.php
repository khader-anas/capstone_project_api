<?php

namespace Core\Models;

use Core\Base\Model;

class Transaction extends Model
{

    public function add_item_quantity($item_name, $item_quantity)
    {

        // $this->item_name =(int) $item_name;
        // $this->item_quantity =(int) $item_quantity;
        $this->insert([
            "item_id" => $item_name,
            "quantity" => $item_quantity
        ]);
    }


    public function update_transaction($id, $item_name, $quantity)
    {

        $this->update($id, [
            'item_id' => $item_name,
            'quantity' => $quantity,
        ]);
    }
}
