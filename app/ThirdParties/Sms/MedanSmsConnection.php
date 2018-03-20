<?php

namespace App\ThirdParties\Sms;

class MedanSmsConnection
{
    protected $userKey = '';
    protected $passKey = '';
	protected $url = '';
    protected $targetPhone = '';
    protected $message = '';

	public function __construct() 
	{
		$this->url = env('MEDANSMS_URL', '');
		$this->userKey = env('MEDANSMS_USERKEY', '');
        $this->passKey = env('MEDANSMS_PASSKEY', '');
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
        $url = $this->url.'?action=kirim_sms&email='.$this->userKey.'&passkey='.$this->passKey.'&no_tujuan='.$this->targetPhone.'&pesan='.urlencode($this->message);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		echo $url;
		return $result;
	}
}