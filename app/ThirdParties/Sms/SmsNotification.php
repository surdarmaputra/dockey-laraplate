<?php

namespace App\ThirdParties\Sms;

class SmsNotification
{
    protected $targetPhone;
    protected $message;

    public function __construct($targetPhone = '', $message = '')
    {
        $this->targetPhone = $targetPhone;
        $this->message = $message;
    }

    public function setTargetPhone($targetPhone = '')
    {
        $this->targetPhone = $targetPhone;
        return $this;
    }

    public function getTargetPhone()
    {
        return $this->targetPhone;
    }

    public function setMessage($message = '')
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }
}