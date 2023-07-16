<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;
    #use App\Models\MenuModel;

    class Messagebird extends Controller{

        #public $menuModel;
        public function __construct(){
            helper('form');
            #$this->menuModel = new MenuModel();
        }

        public function index(){
            $data['page_title'] = 'MessageBird';

// Replace YOUR_ACCESS_KEY with your actual access key
$accessKey = 'HQWg0KniZKzySKKyBvra4nKwv';

// Replace YOUR_PHONE_NUMBER with your actual phone number in international format (e.g., +1234567890)
$phoneNumber = '+639510505308';

// Replace YOUR_MESSAGE with the message you want to send
$message = 'This is a test message';

// Set up the API endpoint
$url = 'https://rest.messagebird.com/messages';

// Set up the request headers
$headers = array(
    'Authorization: AccessKey ' . $accessKey,
    'Content-Type: application/json'
);

// Set up the request body
$data = array(
    'originator' => 'MessageBird',
    'recipients' => array($phoneNumber),
    'body' => $message
);

// Convert the data to JSON format
$jsonData = json_encode($data);

// Create a stream context with the necessary headers
$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => $headers,
        'content' => $jsonData
    )
));

// Send the request
$response = file_get_contents($url, false, $context);

// Check for errors
if ($response === false) {
    echo 'Error: Failed to send request.';
} else {
    // Parse the response
    $responseData = json_decode($response);

    // Check the response status
    if ($responseData->recipients->totalSentCount > 0) {
        echo 'SMS sent successfully.';
    } else {
        echo 'Failed to send SMS. Error: ' . $responseData->errors[0]->description;
    }
}


             //return view('pages/paypal_view', $data);
        }
    }
?>