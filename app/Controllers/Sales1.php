<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\SalesModel;

    class Sales1 extends Controller{

        public $salesModel;
        public function __construct(){
            helper('form');
            $this->salesModel = new SalesModel();
        }

        public function index(){
            //$data['validation'] = null;
            if (!session()->has('logged_admin')) {
                return redirect()->to(base_url() . '/login');
            } else {
    
                $data['page_title'] = 'Sales1';
    
                $data['completed_orders'] = $this->salesModel->getAllCompletedOrders(); 
            /*$data['invoice_orders'] = $this->salesModel->getAllInvoiceOrders();

            if($this->request->getMethod() == "post"){
                $date = date("Y-m-d", strtotime($this->request->getVar("filter")));
                $data['invoice_orders'] = $this->salesModel->loadFilter($date);
            }*/

                return view('pages/sales_view1', $data);
            }
        }

        public function get_sales_details(){
            $placed_order_id = $_POST['placed_order_id'];
            //$placed_order_id = 're5imyf1p11xj6kta1zobs2unhd87qc0wlgv';
            $order_details_in_cart = $this->salesModel->getSalesDetailsInCart($placed_order_id);
            $info = $this->salesModel->getSalesDetailsInOrders($placed_order_id);
            //print_r($info);die;
            echo    '<div class="mb-3 mt-3">
                    <p><b>Name: </b>'.$info['first_name'].' '.$info['last_name'].'</p>
                    <p><b>Address: </b>'.$info['line_1'].' '.$info['line_2'].', '.$info['city'].', '.$info['state'].'</p>
                    <p><b>Type of Order: </b>';
                    if($info['order_type'] == 'pickup'){
                        echo "Pickup";
                    }else{
                        echo "Delivery";
                    }
            echo    '</p><p><b>Payment Method: </b>';
                    if($info['payment_type'] == "otc"){
                        echo "Over the Counter";
                    }else{
                        echo "GCash";
                    }
                    '</p></div>';
            echo    '<table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Category</th>
                                <th>Menu Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="order-table">';
                        foreach($order_details_in_cart as $order_detail){
            echo            '<tr>
                                <td><img src="'.base_url().'/public/uploads/'.$order_detail['menu_image'].'" alt="Menu Image" width="70"></td>
                                <td>'.$order_detail['category'].'</td>
                                <td>'.$order_detail['menu_name'].'</td>
                                <td>'.$order_detail['quantity'].'</td>
                            </tr>';
                        }
            echo        '</tbody>
                    </table>';

        }
    }
?>