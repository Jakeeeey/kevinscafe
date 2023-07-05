<?php 
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\PurchasesModel;

    class Purchases extends Controller{
    
        public $purchasesModel;
        public $client;
        public function __construct(){
            helper('form');
            //helper('date');
            $this->purchasesModel = new PurchasesModel();
            $this->client = new \GuzzleHttp\Client();
        }


        public function index(){           
            $data['page_title'] = 'My Purchases';

            if(!session()->has('logged_user')){
                return redirect()->to(base_url().'/login');
            }
            if(session()->has('no_profile')){
                return redirect()->to(base_url().'/profile1');
            }

            $data['orders'] = $this->purchasesModel->getAllOrdersExceptCancelled(session()->get('logged_user_id'));

            return view('pages/purchases/purchases_view', $data);
        }

        public function cancelled(){
            $data['page_title'] = "Cancelled";
            $data['cancelled_orders'] = $this->purchasesModel->getAllCancelledOrder(session()->get('logged_user_id'));
            return view('pages/purchases/cancelled_view', $data);
        }

        public function completed(){
            $data['page_title'] = "Completed";
            $data['completed_orders'] = $this->purchasesModel->getAllCompletedOrder(session()->get('logged_user_id'));
            return view('pages/purchases/completed_view', $data);
        }

        public function cancel_order(){
            $cancelled_order_details = json_decode($_GET['cancelled_order'], true);
            // echo "<pre>";
            // print_r($cancelled_order_details);
            // echo "</pre>";die;
            if($cancelled_order_details['payment_type'] == 'gcash'){
                $refund_id = $this->refund(
                    $cancelled_order_details['total_amount'],
                    $cancelled_order_details['payment_id'],
                    $cancelled_order_details['reason']
                );
                //echo $refund_id;die;

                $status = $this->retrieve_refund($refund_id);
                //echo $status;die;
                if($status == "succeeded"){
                    $order_update = [
                        'order_status' => 'cancelled',
                        'payment_status' => 'refunded'
                    ];

                    // echo $cancelled_order_details["placed_order_id"];
                    // print_r($order_update);die;
    
                    if($this->purchasesModel->cancelOrder($cancelled_order_details["placed_order_id"], $order_update)){
                        
                        return redirect()->to(base_url().'/purchases/cancelled');
                    }
                }

            }else{
                $order_update = [
                    'order_status' => 'cancelled',
                    //'payment_status' => 'cancelled'
                ]; 

                if($this->purchasesModel->cancelOrder($cancelled_order_details["placed_order_id"], $order_update)){
                    return redirect()->to(base_url().'/purchases/cancelled');
                }
            }
            // if($this->purchasesModel->cancelOrder($placed_order_id)){
            //     return redirect()->to(base_url().'/purchases/cancelled');
            // }
        }

        public function refund($amount, $payment_id, $reason){
            require_once('vendor/autoload.php');
            $amount = $amount.'00';
            $payment_id = $payment_id;
            $reason = $reason;

            $response = $this->client->request('POST', 'https://api.paymongo.com/refunds', [
                'body' => '{"data":{"attributes":{"amount":'.$amount.',"payment_id":"'.$payment_id.'","reason":"'.$reason.'"}}}',
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                    'content-type' => 'application/json',
                ],
            ]);
            
            $paymongo = json_decode($response->getBody(), true);
            $refund_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            // $status = $paymongo['data']['attributes']['status'];
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
            // echo "<pre>";
            // print_r($paymongo);
            // echo "</pre>";
            return $refund_id;
            //$status = $this->retrieve_refund($refund_id);
            
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;

        }

        public function retrieve_refund($refund_id){
            require_once('vendor/autoload.php');
            //$refund_id = "ref_cVLxMphCRSZ1WAWRSbWkVoHB";

            $response = $this->client->request('GET', 'https://api.paymongo.com/refunds/'.$refund_id.'', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);
              
            $paymongo = json_decode($response->getBody(), true);
            // $source_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            $status = $paymongo['data']['attributes']['status'];
            return $status;
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
            // echo "<pre>";
            // print_r($paymongo);
            // echo "</pre>";
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;

        } 

        public function get_order_details(){
            $placed_order_id = $_POST['placed_order_id'];
            //$placed_order_id = 'tfmewx1rb6suvn8ocaiyhj3zkl94gdp5175q';
            $order_details_in_cart = $this->purchasesModel->getOrderDetailsInCart($placed_order_id);
            $info = $this->purchasesModel->getOrderDetailsInOrders($placed_order_id);
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
            echo    '</p>
                    <p><b>Payment Status: </b>'.$info['payment_status'].'</p></div>';
            echo    '<table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Menu Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="order-table">';
                        foreach($order_details_in_cart as $order_detail){
            echo            '<tr>
                                <td><img src="'.base_url().'/public/uploads/'.$order_detail['menu_image'].'" alt="" width="70"></td>
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