<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\DashboardModel;

    class PaidCustomers extends Controller{

        #public $dashboardModel;
        public function __construct(){
            helper('form');
            #$this->dashboardModel = new DashboardModel();
        }

        public function index(){
            $data['page_title'] = 'Paid Customers';
            require_once('vendor/autoload.php');

            $client = new \GuzzleHttp\Client();

            $response = $client->request('GET', 'https://api.paymongo.com/v1/links/id', [
                'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6',
                ],
            ]);

            echo $response->getBody();

            
            return view('pages/paid_customers_view', $data);
        }
    }
?>