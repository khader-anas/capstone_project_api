<?php

namespace Core\Controllers;

use Core\Base\Controller;
use Core\Models\Transaction;


class Items extends Controller
{

    public $response_schema = [
        "success" => true,
        "message_code" => "",
        "body" => []
    ];


    public $request_body;


    function __construct()
    {
        $this->request_body = json_decode(file_get_contents("php://input"), true);
    }


    function render()
    {
    }

    function index()
    {
        $res = $this->response_schema;
        $res["message_code"] = "successful_response";
        http_response_code(200);
        echo json_encode($res);
    }

    function all()
    {
        $res = $this->response_schema;
        try {
            $item = new Transaction;
            $items = $item->get_all();
            if (empty($items)) {
                throw new \Exception('no_items_was_found');
            }
            //message code  
            $res['message_code'] = "Items_were_collected_successfully";
            //body
            $res['body']['items'] = $items;
            $res['body']['transactions_count'] = count($items);
            http_response_code(200);
        } catch (\Exception $error) {
            $res['message_code'] = "No items were found";
            $res['body']['error'] = $error->getMessage();
            http_response_code(200);
        }

        echo json_encode($res);
    }

    function create()
    {
        $res = $this->response_schema;
        try {
            if (empty($this->request_body)) {
                throw new \Exception("Empty_json_response");
            }

            if (!isset($this->request_body['item_id']) && !isset($this->request_body['quantity'])) {
                throw new \Exception("item_name_not_available");
            }
            $item = new Transaction();
            $item->add_item_quantity($this->request_body['item_id'], $this->request_body['quantity']);
            $res['message_code'] = 'new_transaction_added_successfully';
            http_response_code(200);
        } catch (\Exception $error) {
            $res['message_code'] = $error->getMessage();
            $res['success'] = false;
            http_response_code(400);
        }
        echo json_encode($res);
    }

    function update()
    {
        $res = $this->response_schema;
        try {
            if (empty($this->request_body)) {
                throw new \Exception("Empty_json_response");
            }
            if (!isset($this->request_body['id'])) {
                throw new \Exception("Transaction_id_not_available");
            }

            if (!isset($this->request_body['item_id']) && !isset($this->request_body['quantity'])) {
                throw new \Exception("item_name_not_available");
            }

            $item = new Transaction();
            $item->update_transaction($this->request_body['id'], $this->request_body['item_id'], $this->request_body['quantity']);
            $res['message_code'] = 'transaction_updated_successfully';
        } catch (\Exception $error) {
            $res['message_code'] = $error->getMessage();
            $res['success'] = false;
            http_response_code(400);
        }
        echo json_encode($res);
    }

    function delete()
    {
        $res = $this->response_schema;
        try {
            if (empty($this->request_body)) {
                throw new \Exception("Empty_json_response");
            }
            if (!isset($this->request_body['id'])) {
                throw new \Exception("Item_id_not_available");
            }
            $item = new Transaction;
            $item->delete($this->request_body['id']);
            $res['message_code'] = 'Transaction_deleted_successfully';

        } catch (\Exception $error) {
            $res['message_code'] = $error->getMessage();
            $res['success'] = false;
            http_response_code(400);
        }
        echo json_encode($res);
    }
}
