<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomersModel;

class Customers extends Controller
{

    public $customersModel;
    public function __construct()
    {
        helper('form');
        $this->customersModel = new CustomersModel();
    }

    public function index()
    {
        if (!session()->has('logged_admin')) {
            return redirect()->to(base_url() . '/login');
        } else {

            $data['page_title'] = 'Customers';

            $idCount = $this->customersModel->countAllOrders();
            if ($idCount) {
                $data['invoice_order_id'] = $idCount['order_id'] + 1;
            } else {
                $data['invoice_order_id'] = $idCount['order_id'] + 1;
            }

            if (isset($_POST['saveItems'])) {
                $invoiceOrder = [
                    "order_id" => $this->request->getVar("invoice_order_id"),
                    "order_receiver_name" => $this->request->getVar("customer_name"),
                    "order_receiver_address" => $this->request->getVar("customer_address"),
                    "order_total_amount" => $this->request->getVar("total"),
                ];
                $this->customersModel->saveInvoice($invoiceOrder);
                return redirect()->to(base_url() . '/sales');
            }

            return view('pages/customers_view', $data);
        }
    }

    public function getCategoryPnames($category)
    {
        $items = $this->customersModel->getProduct($category);
        return $this->response->setJSON($items);
    }


    public function getPnamePrice($id)
    {
        $pname_price = $this->customersModel->getPnamePrice($id);
        return $this->response->setJSON($pname_price);
    }


    public function getOrderedItems($orderedItems)
    {
        //$orderedItems = '[{"order_id":"1","order_item_quantity":"1","order_item_price":"96"},{"order_id":"1","order_item_quantity":"2","order_item_price":"192"}]';
        $orderedItemsArray = json_decode($orderedItems, true);

        for ($i = 0; $i < count($orderedItemsArray); $i++) {
            $invoice_id = $orderedItemsArray[$i]["invoice_order_id"];
            $product_id = $orderedItemsArray[$i]["product_id"];
            $order_item_quantity = $orderedItemsArray[$i]["order_item_quantity"];
            $order_item_price = $orderedItemsArray[$i]["order_item_price"];
            $orderedItem = [
                "order_id" => $invoice_id,
                "product_id" => $product_id,
                "order_item_quantity" => $order_item_quantity,
                "order_item_price" => $order_item_price
            ];
            $this->customersModel->saveOrderedItem($orderedItem);
        }
    }
}
