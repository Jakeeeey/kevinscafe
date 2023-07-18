<?php

namespace App\Controllers;

use CodeIgniter\Controller;
//use Twilio\Rest\Client;

class SMS extends Controller
{

	public function __construct()
	{
		helper('form');
	}

	public function index()
	{
		$data['page_title'] = 'SMS';

		// Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

    //use Twilio\Rest\Client;

    $sid    = "AC7648dfb32a2dac197bda27149652d476";
    $token  = "0e568564c1447fd684aca98de15737fa";
    $twilio = new Twilio\Rest\Client($sid, $token);

    $message = $twilio->messages
      ->create("+639510505308", // to
        array(
          "from" => "+15312345197",
          "body" => "Your order is now preparing."
        )
      );

			//print($message->sid);
			echo "<pre>";
			print_r($message);
			echo "</pre>";

	}
}
