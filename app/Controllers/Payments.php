<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\DashboardModel;
    class Payments extends Controller{

        #public $dashboardModel;
        public function __construct(){
            helper('form');
            #$this->dashboardModel = new DashboardModel();
        }

        public function index(){
            $data['page_title'] = 'Payments';
            require_once('vendor/autoload.php');

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
                'body' => '{"data":{"attributes":{"amount":100000,"redirect":{"success":"http://localhost/kevincafe/payments/success","failed":"http://localhost/kevincafe/payments/failed"},"type":"gcash","currency":"PHP"}}}',
                'headers' => [
                  'Accept' => 'application/json',
                  'Authorization' => 'Basic cGtfdGVzdF9paDkyNjVTVTdwS01iY0M1VW9Mc0w3WmE6',
                  'Content-Type' => 'application/json',
                ],
              ]);
              echo $response->getBody();die;
              $paymongo = json_decode($response->getBody(), true);
              $data['url'] = ($paymongo['data']['attributes']['redirect']['checkout_url']);
              

            return view('pages/payments_view', $data);
        }

        public function success(){
            $data['page_title'] = 'Success';
            echo 'Payment success...';
            return header('Refresh: 4;URL='.base_url().'/home');
            return view('pages/success_view', $data);
        }

        public function failed(){
            
        }
        
        public function paymaya(){
            $data['page_title'] = 'Payments';

            require_once('vendor/autoload.php');

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
                'body' => '{"data":{"attributes":{"type":"paymaya"}}}',
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic cGtfdGVzdF9paDkyNjVTVTdwS01iY0M1VW9Mc0w3WmE6',
                    'Content-Type' => 'application/json',
                ],
            ]);

            echo $response->getBody();


            return view('pages/payments_view', $data);
        }

        public function webhook(){
            require_once('vendor/autoload.php');

            $client = new \GuzzleHttp\Client();
            
            $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
              'body' => '{"data":{"attributes":{"amount":10000,"description":"To pay"}}}',
              'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6',
                'Content-Type' => 'application/json',
              ],
            ]);
            
            echo $response->getBody();
            
        }

    }
?>