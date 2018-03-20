<?php

namespace App\ThirdParties\Sms;

class ZenzivaConnection
{
    protected $userKey = '';
    protected $passKey = '';
	protected $url = '';
    protected $targetPhone = '';
    protected $message = '';

	public function __construct() 
	{
		$this->url = env('ZENZIVA_URL', '');
		$this->userKey = env('ZENZIVA_USERKEY', '');
        $this->passKey = env('ZENZIVA_PASSKEY', '');
		return $this;
	}

	public function setMessage($targetPhone = '', $message = '') 
	{
        $this->targetPhone = $targetPhone;
        $this->message = $message;
		return $this;
	}

	public function send() 
	{
        $url = $this->url.'?userkey='.$this->userKey.'&passkey='.$this->passKey.'&nohp='.$this->targetPhone.'&pesan='.urlencode($this->message);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
		return $result;
	}
}