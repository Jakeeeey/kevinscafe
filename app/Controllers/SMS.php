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

		require_once 'vendor/autoload.php';
		//use Twilio\Rest\Client;

		$sid    = "ACd5dfeb75d394fa077ee7c4dab51eb0a4";
		$token  = "b0a101049e646c333a5951b4e56f6423";
		$twilio = new \Twilio\Rest\Client($sid, $token);

		$message = $twilio->messages
			->create(
				"+639510505308", // to
				array(
					"from" => "+15074739573",
					"body" => "Your order from Kevin's Cafe is now preparing"
				)
			);

			//print($message->sid);
			echo "<pre>";
			print_r($message);
			echo "</pre>";

	}
}
