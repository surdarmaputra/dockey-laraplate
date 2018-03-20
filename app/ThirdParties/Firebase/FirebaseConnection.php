<?php

namespace App\ThirdParties\Firebase;

class FirebaseConnection
{
	protected $serverKey = '';
	protected $fcmTargetUrl = 'https://fcm.googleapis.com/fcm/send';
	protected $requestHeaders = array();
	protected $requestBody = array();

	public function __construct() 
	{
		$this->serverKey = env('FIREBASE_SERVER_KEY', '');
		$this->setDefaultRequestHeaders();
		return $this;
	}

	public function setBody($body = array()) 
	{
		if(is_array($body)) {
			$this->requestBody = $body;
		}
		return $this;
	}

	public function send() 
	{
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $this->fcmTargetUrl);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_HTTPHEADER, $this->requestHeaders);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($this->requestBody));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	protected function setDefaultRequestHeaders() 
	{
		array_push($this->requestHeaders, 'Authorization: key=' . $this->serverKey);
		array_push($this->requestHeaders, 'Content-Type: application/json');
		return $this;
	}
}