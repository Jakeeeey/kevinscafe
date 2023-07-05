<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\SalesModel;

    class Sales extends Controller{

        public $salesModel;
        public function __construct(){
            helper('form');
            $this->salesModel = new SalesModel();
        }

        public function index(){
            //$data['validation'] = null;
            $data['page_title'] = 'Sales';
            
            $data['invoice_orders'] = $this->salesModel->getAllInvoiceOrders();

            if($this->request->getMethod() == "post"){
                $date = date("Y-m-d", strtotime($this->request->getVar("filter")));
                $data['invoice_orders'] = $this->salesModel->loadFilter($date);
            }

            return view('pages/sales_view', $data);
        }

        public function view_invoice_order(){
            $order_id = $_GET['id'];
            $data['page_title'] = 'Invoice';

            $data['invoice_order_items'] = $this->salesModel->viewInvoiceOrder($order_id);

            return view('pages/view_order_view', $data);
        }

        public function delete_invoice_order(){
            $order_id = $_GET['id'];
            $this->salesModel->deleteInvoiceOrder($order_id);
            $this->salesModel->deleteInvoiceOrderItem($order_id);
            return redirect()->to(base_url().'/sales');
        }
    }
?>