<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomersModel;

class Customers1 extends Controller
{

    public $customersModel;
    public function __construct()
    {
        helper('form');
        //helper('date');
        $this->customersModel = new CustomersModel();
    }

    public function index()
    {
        if (!session()->has('logged_admin')) {
            return redirect()->to(base_url() . '/login');
        } else {

            $data['page_title'] = 'Customers1';
            //echo date('Y-m-d h:i:s');die;

            /*$idCount = $this->customersModel->countAllOrders();
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
            }*/
            $data['orders'] = $this->customersModel->getAllPendingOrders();
            //print_r($this->customersModel->getAllPendingOrders());die;

            return view('pages/customers_view1', $data);
        }
    }

    public function displayModalOrders(){
        //$check_out_id = $_GET['check_out_id'];
        $check_out_id = $_POST['checkOutId'];
        //return $this->response->setJSON($check_out_id);
        //return $check_out_id;
        $orders = $this->customersModel->getCustomerOrders($check_out_id);
        if($orders){
            foreach($orders as $order){
            echo '<tr>';
            echo '<td>'.$order['category'].'</td>';
            echo '<td>'.$order['menu_name'].'</td>';
            echo '<td>'.$order['quantity'].'</td>';
            echo '</tr>';
            }
            //return $this->response->setJSON($orders);
        }
        //return $this->response->setJSON($orders);
        //echo '<pre>';
        //print_r($orders);
    }

    public function updateOrderStatus(){
        //$check_out_id = $_GET['check_out_id'];
        $check_out_id = $_POST['checkOutId'];
        $order_status = $_POST['orderStatus'];
        //return $this->response->setJSON($check_out_id);
        //return $check_out_id;
        $order_details = [
            'order_status' => $order_status,
            'updated_at' => date('Y-m-d h:i:s')
        ];
        $status = $this->customersModel->updateOrderStatus($check_out_id, $order_details);
        if($status){
            return ($status);
        }
        //return $this->response->setJSON($orders);
        //echo '<pre>';
        //print_r($orders);
    }
}
