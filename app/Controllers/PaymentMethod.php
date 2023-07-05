<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    use App\Models\PaymentMethodModel;

    class PaymentMethod extends Controller{

        public $paymentmethodModel;
        public $client;
        public function __construct(){
            helper('form');
            $this->paymentmethodModel = new PaymentMethodModel();
            $this->client = new \GuzzleHttp\Client();
        }

        public function index(){
            $data['page_title'] = 'Payment Method';
            $id = 1;
            $amount = "10000";

            require_once('vendor/autoload.php');

            //$client = new \GuzzleHttp\Client();

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/sources', [
                'body' => '{"data":{"attributes":{"amount":10000,"redirect":{"success":"http://localhost/kevincafe/paymentmethod/success","failed":"http://localhost/kevinscafe/paymentmethod/failed"},"billing":{"address":{"line1":"162 David","line2":"162 Amansabina","state":"Pangasinan","postal_code":"2432","city":"Mangaldan","country":"PH"},"name":"jake dave","phone":"09510505308","email":"jakedavedeguzman123@gmail.com"},"type":"gcash","currency":"PHP"}}}',
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic cGtfdGVzdF9paDkyNjVTVTdwS01iY0M1VW9Mc0w3WmE6',
                    'Content-Type' => 'application/json',
                ],
            ]);
          
          $response->getBody();
          $paymongo = json_decode($response->getBody(), true);
          #print_r($paymongo['data']['attributes']['status']);die;
          if($this->request->getMethod() == 'post'){
              $data_transac = [
                  'user_id' => $id,
                  'link' => $paymongo['data']['id'],
                  'amount' => $paymongo['data']['attributes']['amount'],
                  'status' => $paymongo['data']['attributes']['status'],
              ];
              $this->paymentmethodModel->insert_data_transac($data_transac);
              session()->set('id', $paymongo['data']['id']);
              return redirect()->to($paymongo['data']['attributes']['redirect']['checkout_url']);
          }
          return view('pages/payment_method_view', $data);

        }

        public function paymentIntent(){
            
            require_once('vendor/autoload.php');

            //$client = new \GuzzleHttp\Client();

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/payment_intents', [
                'body' => '{"data":{"attributes":{"amount":10000,"payment_method_allowed":["paymaya","gcash","grab_pay"],"payment_method_options":{"card":{"request_three_d_secure":"any"}},"currency":"PHP","capture_type":"automatic"}}}',
                'headers' => [
                  'accept' => 'application/json',
                  'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                  'content-type' => 'application/json',
                ],
              ]);
              
              $paymongo = json_decode($response->getBody(), true);
             echo "<pre>";
             print_r($paymongo);
             echo "</pre>";

            $payment_intent_id = $paymongo['data']['id'];
            $client_key = $paymongo['data']['attributes']['client_key'];
            $created_at = $paymongo['data']['attributes']['created_at'];
            $updated_at = $paymongo['data']['attributes']['updated_at'];
            //echo $payment_intent_id;
            //echo $client_key;

        }

        public function  retrievePaymentIntent(){
            require_once('vendor/autoload.php');

            $payment_intent_id = "pi_7RvvDcUSw88oW1fVCk1Kwz5p";
            $client_key = "pi_7RvvDcUSw88oW1fVCk1Kwz5p_client_7JXcc2nJHMcuS5jAZfkfYvgs";

            $response = $client->request('GET', 'https://api.paymongo.com/v1/payment_intents/'.$payment_intent_id.'?client_key='.$client_key.'', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            // echo "<pre>";
            // print_r($paymongo);
            // echo "</pre>";

            $payment_intent_id = $paymongo['data']['id'];
            $client_key = $paymongo['data']['attributes']['client_key'];
            //echo $payment_intent_id;
            //echo $client_key;

        }

        public function paymentMethod(){
            require_once('vendor/autoload.php');

            //$client = new \GuzzleHttp\Client();

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
                'body' => '{"data":{"attributes":{"type":"gcash"}}}',
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
             echo "<pre>";
             print_r($paymongo);
             echo "</pre>";
        }

        public function retrievePaymentMethod(){
            require_once('vendor/autoload.php');

            $id = "pm_rxpCU5h2Dco6i8N88yfLdEvj";

            $response = $this->client->request('GET', 'https://api.paymongo.com/v1/payment_methods/'.$id, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            // echo "<pre>";
            // print_r($paymongo);
            // echo "</pre>";
        }

        public function linkResource(){
            require_once('vendor/autoload.php');

            $amount = 10000;
            $description = "order payment";

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/links', [
            'body' => '{"data":{"attributes":{"amount":'.$amount.',"description":"'.$description.'"}}}',
            'headers' => [
               'accept' => 'application/json',
               'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
               'content-type' => 'application/json',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            //  echo "<pre>";
            //  print_r($paymongo);
            //  echo "</pre>";

            $link_resource_id = $paymongo['data']['attributes']['checkout_url'];
            $status = $paymongo['data']['attributes']['status'];
            $reference_number = $paymongo['data']['attributes']['reference_number'];
            $created_at = $paymongo['data']['attributes']['created_at'];
            $updated_at = $paymongo['data']['attributes']['updated_at'];
            //echo $link_resource_id;
            //echo $reference_number;
        }

        public function retrieveLinkResource(){
            require_once('vendor/autoload.php');
            $link_resource_id = "link_Raa55AxZ7vNFSVm3qfzbeou8";

            $response = $this->client->request('GET', 'https://api.paymongo.com/v1/links/'.$link_resource_id, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            //  echo "<pre>";
            //  print_r($paymongo);
            //  echo "</pre>";
             
            $status = $paymongo['data']['attributes']['status'];
            $reference_number = $paymongo['data']['attributes']['reference_number'];
            $created_at = $paymongo['data']['attributes']['created_at'];
            $updated_at = $paymongo['data']['attributes']['updated_at'];
            //echo $link_resource_id;
            //echo $reference_number;

        }

        public function getLinkByRefferenceNumber(){
            require_once('vendor/autoload.php');
            $reference_number = "JfAi65Z";

            $response = $this->client->request('GET', 'https://api.paymongo.com/v1/links?reference_number='.$reference_number, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            echo "<pre>";
            print_r($paymongo);
            echo "</pre>";
        }

        public function webhook(){
            require_once('vendor/autoload.php');

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/webhooks', [
                'body' => '{"data":{"attributes":{"events":["payment.paid"],"url":"http://localhost/kevinscafe/paymentmethod/failed"}}}',
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                    'content-type' => 'application/json',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            // echo "<pre>";
            // print_r($paymongo);
            // echo "</pre>";
        }

        public function listWebhook(){
            require_once('vendor/autoload.php');

            $response = $this->client->request('GET', 'https://api.paymongo.com/v1/webhooks', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            // echo "<pre>";
            // print_r($paymongo);
            // echo "</pre>";
        }

        public function source(){
            require_once('vendor/autoload.php');
            $amount = 10000;
            $line_1 = "162 David";
            $state = "Pangasinan";
            $postal_code = "2432";
            $city = "Mangaldan";
            $name = "Jake Dave De Guzman";
            $phone = "09510505308";
            $email = "jakedavedeguzman123@gmail.com";
            $payment_type = "gcash";

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/sources', [
                'body' => '{"data":{"attributes":{"amount":'.$amount.',"redirect":{"success":"http://localhost/kevinscafe/paymentmethod/success","failed":"http://localhost/kevinscafe/paymentmethod/failed"},"billing":{"address":{"line1":"'.$line_1.'","state":"'.$state.'","postal_code":"'.$postal_code.'","city":"'.$city.'","country":"PH"},"name":"'.$name.'","phone":"'.$phone.'","email":"'.$email.'"},"type":"'.$payment_type.'","currency":"PHP"}}}',
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                    'content-type' => 'application/json',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            $source_id = $paymongo['data']['id'];
            $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            $status = $paymongo['data']['attributes']['status'];
            $type = $paymongo['data']['attributes']['type'];
            $created_at = $paymongo['data']['attributes']['created_at'];
            $updated_at = $paymongo['data']['attributes']['updated_at'];
             echo "<pre>";
             print_r($paymongo);
             echo "</pre>";
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;
        }

        public function success(){
            // $id = session()->get('id');
            // require_once('vendor/autoload.php');

            // $response = $this->client->request('GET', 'https://api.paymongo.com/v1/sources/'.$id, [
            //     'headers' => [
            //         'Accept' => 'application/json',
            //         'Authorization' => 'Basic cGtfdGVzdF9paDkyNjVTVTdwS01iY0M1VW9Mc0w3WmE6',
            //     ],
            // ]);

            // $response->getBody();
            // $paymongo = json_decode($response->getBody(), true);

            // print_r($paymongo['data']['attributes']['status']);die;
            // $status = $paymongo['data']['attributes']['status'];
            // if($status == 'chargeable'){
            //     if($this->paymentmethodModel->updateStatus($status, session()->get('id'))){
            //         echo 'success';
            //     }else{
            //         echo 'failed';
            //     }
            // }
            echo "<h1>Payment successfully paid</h1>";
        } 


        public function failed(){
            echo "<h1>Payment failed</h1>";
        }

        public function retrieveSource(){
            require_once('vendor/autoload.php');
            $source_id = "src_zf3GXvb2Ag8nTPxWHRtKr9C7";

            $response = $this->client->request('GET', 'https://api.paymongo.com/v1/sources/'.$source_id, [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            // $source_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            // $status = $paymongo['data']['attributes']['status'];
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
             echo "<pre>";
             print_r($paymongo);
             echo "</pre>";
            //return redirect()->to(base_url().'/paymentmethod/retrievesource/success?id='.$id);
        }


        //gagana lamang to pag chargeable na yung status ng source id
        public function payment(){
            require_once('vendor/autoload.php');
            $amount = 34600;
            $source_id = "src_UCzAb8h1ju2zygiNgqsF9t67";

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/payments', [
                'body' => '{"data":{"attributes":{"amount":'.$amount.',"source":{"id":"'.$source_id.'","type":"source"},"currency":"PHP"}}}',
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                    'content-type' => 'application/json',
                ],
            ]);
              

            $paymongo = json_decode($response->getBody(), true);
            // $source_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            // $status = $paymongo['data']['attributes']['status'];
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
            echo "<pre>";
            print_r($paymongo);
            echo "</pre>";
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;
        }

        public function listAllPayments(){
            require_once('vendor/autoload.php');
            //pili ng isa before or after; before current 
            $source_id_before = "pay_jg2NfSTqNusE2popSvGpGPyZ";    
            $source_id_after = "pay_jg2NfSTqNusE2popSvGpGPyZ";
            $limit = 10;    //limit kung ilan irereturn na payments; min = 10

            $response = $this->client->request('GET', 'https://api.paymongo.com/v1/payments?before='.$source_id_before.'&after='.$source_id_after.'&limit='.$limit.'', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);

            $paymongo = json_decode($response->getBody(), true);
            // $source_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            // $status = $paymongo['data']['attributes']['status'];
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
            echo "<pre>";
            print_r($paymongo);
            echo "</pre>";
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;
        }

        public function retrievePayment(){
            require_once('vendor/autoload.php');
            $payment_id = "pay_jg2NfSTqNusE2popSvGpGPyZ";

            $response = $client->request('GET', 'https://api.paymongo.com/v1/payments/'.$payment_id.'', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);
            
            $paymongo = json_decode($response->getBody(), true);
            // $source_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            // $status = $paymongo['data']['attributes']['status'];
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
            echo "<pre>";
            print_r($paymongo);
            echo "</pre>";
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;

        }

        public function refund(){
            require_once('vendor/autoload.php');
            $amount = 10000;
            $payment_id = "pay_sVneFK3eefMF2nYnFdw9LHGA";
            $reason = "requested_by_customer";

            $response = $this->client->request('POST', 'https://api.paymongo.com/refunds', [
                'body' => '{"data":{"attributes":{"amount":'.$amount.',"payment_id":"'.$payment_id.'","reason":"'.$reason.'"}}}',
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                    'content-type' => 'application/json',
                ],
            ]);
            
            $paymongo = json_decode($response->getBody(), true);
            // $source_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            // $status = $paymongo['data']['attributes']['status'];
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
            echo "<pre>";
            print_r($paymongo);
            echo "</pre>";
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;

        }

        public function retrieve_refund(){
            require_once('vendor/autoload.php');
            $refund_id = "ref_cVLxMphCRSZ1WAWRSbWkVoHB";

            $response = $this->client->request('GET', 'https://api.paymongo.com/refunds/'.$refund_id.'', [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF9KMnBaTUpIcFdCQ3lSV1FkemdCUHBBWFU6QEJyeWxlamF6eTEz',
                ],
            ]);
              
            $paymongo = json_decode($response->getBody(), true);
            // $source_id = $paymongo['data']['id'];
            // $checkout_url = $paymongo['data']['attributes']['redirect']['checkout_url'];
            // $status = $paymongo['data']['attributes']['status'];
            // $type = $paymongo['data']['attributes']['type'];
            // $created_at = $paymongo['data']['attributes']['created_at'];
            // $updated_at = $paymongo['data']['attributes']['updated_at'];
            echo "<pre>";
            print_r($paymongo);
            echo "</pre>";
            // echo $source_id;
            // echo $checkout_url;
            // echo $status;
            // echo $type;
            // echo $created_at;
            // echo $updated_at;

        } 

        public function listAllRefund(){

        }

    }
?>