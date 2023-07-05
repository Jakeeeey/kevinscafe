<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OrdersModel;

class Orders extends Controller
{

    public $ordersModel;
    public function __construct()
    {
        helper('form');
        helper('date');
        //helper('date');
        $this->ordersModel = new OrdersModel();
    }


    public function index()
    {
        $data['page_title'] = 'Orders';

        if (!session()->has('logged_admin')) {
            return redirect()->to(base_url() . '/login');
        }

        $data['orders'] = $this->ordersModel->getAllPlacedOrders();

        return view('pages/orders/orders_view', $data);
    }

    public function preparing()
    {
        $data['page_title'] = 'Preparing';

        $data['orders'] = $this->ordersModel->getAllPreparingOrders();

        return view('pages/orders/preparing_view', $data);
    }

    public function to_pickup()
    {
        $data['page_title'] = 'To Deliver';

        $data['orders'] = $this->ordersModel->getAllToPickupOrders();

        return view('pages/orders/to_pickup_view', $data);
    }

    public function to_deliver()
    {
        $data['page_title'] = 'To Deliver';

        $data['orders'] = $this->ordersModel->getAllToDeliverOrders();

        return view('pages/orders/to_deliver_view', $data);
    }

    public function get_order_details()
    {
        $placed_order_id = $_POST['placed_order_id'];
        $order_details = $this->ordersModel->getOrderDetails($placed_order_id);
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
        foreach ($order_details as $order_detail) {
            echo            '<tr>
                                <td><img src="' . base_url() . '/public/uploads/' . $order_detail['menu_image'] . '" alt="Menu Image" width="70"></td>
                                <td>' . $order_detail['category'] . '</td>
                                <td>' . $order_detail['menu_name'] . '</td>
                                <td>' . $order_detail['quantity'] . '</td>
                            </tr>';
        }
        echo        '</tbody>
                    </table>';
    }

    public function update_order_status()
    {
        $order_id = $_GET['order_id'];
        $order_status = $_GET['order_status'];
        $mobile_number = $_GET['mobile_number'];
        $order_details = [
            'order_status' => $order_status,
            'updated_at' => date('Y-m-d h:i:s', now()),
        ];
        $status = $this->ordersModel->updateOrderStatus($order_id, $order_details);
        if ($status) {
            if ($order_status == "preparing") {
                if($this->sms_preparing($mobile_number)){
                    return redirect()->to(base_url() . '/orders/preparing');
                }
            } elseif ($order_status == "to_pickup") {
                if($this->sms_pickup($mobile_number)){
                    return redirect()->to(base_url() . '/orders/to_pickup');
                }
            } elseif ($order_status == "to_deliver") {
                if($this->sms_delivery($mobile_number)){
                    return redirect()->to(base_url() . '/orders/to_deliver');
                }
            } elseif ($order_status == "completed") {
                if($this->sms_completed($mobile_number)){
                    return redirect()->to(base_url() . '/sales1');
                }
            }
        }
    }

    public function sms_preparing($mobile_number)
    {
        //echo $mobile_number;die;
        require_once 'vendor/autoload.php';
        //use Twilio\Rest\Client;

        $sid    = "ACd5dfeb75d394fa077ee7c4dab51eb0a4";
        $token  = "b0a101049e646c333a5951b4e56f6423";
        $twilio = new \Twilio\Rest\Client($sid, $token);

        $message = $twilio->messages
            ->create(
                //"+639510505308", // to
                "+".$mobile_number,
                array(
                    "from" => "+15074739573",
                    "body" => "Your order from Kevin's Cafe is now preparing"
                )
            );

        //print($message->sid);
        return true;
    }

    public function sms_pickup($mobile_number)
    {
        require_once 'vendor/autoload.php';
        //use Twilio\Rest\Client;

        $sid    = "ACd5dfeb75d394fa077ee7c4dab51eb0a4";
        $token  = "b0a101049e646c333a5951b4e56f6423";
        $twilio = new \Twilio\Rest\Client($sid, $token);

        $message = $twilio->messages
            ->create(
                //"+639510505308", // to
                "+".$mobile_number,
                array(
                    "from" => "+15074739573",
                    "body" => "Your order from Kevin's Cafe is now ready for pick up"
                )
            );

        //print($message->sid);
        return true;
    }

    public function sms_delivery($mobile_number)
    {
        require_once 'vendor/autoload.php';
        //use Twilio\Rest\Client;

        $sid    = "ACd5dfeb75d394fa077ee7c4dab51eb0a4";
        $token  = "b0a101049e646c333a5951b4e56f6423";
        $twilio = new \Twilio\Rest\Client($sid, $token);

        $message = $twilio->messages
            ->create(
                //"+639510505308", // to
                "+".$mobile_number,
                array(
                    "from" => "+15074739573",
                    "body" => "Your order from Kevin's Cafe is now ready for delivery"
                )
            );

        //print($message->sid);
        return true;
    }

    public function sms_completed($mobile_number)
    {
        require_once 'vendor/autoload.php';
        //use Twilio\Rest\Client;

        $sid    = "ACd5dfeb75d394fa077ee7c4dab51eb0a4";
        $token  = "b0a101049e646c333a5951b4e56f6423";
        $twilio = new \Twilio\Rest\Client($sid, $token);

        $message = $twilio->messages
            ->create(
                //"+639510505308", // to
                "+".$mobile_number,
                array(
                    "from" => "+15074739573",
                    "body" => "Your order from Kevin's Cafe is now completed"
                )
            );

        //print($message->sid);
        return true;
    }
}
