<?php

namespace App\ThirdParties\Firebase;

class FirebasePushNotification
{
    protected $recipientToken;
    protected $title;
    protected $body;
    protected $data;

    /**
     * @param string $recipientToken .Recipient's firebase token.
     * @param string $title .Message title.
     * @param string $body .Message body.
     * @param array $data .Data to be attached in message.
     */
    public function __construct($recipientToken = NULL, $title = NULL, $body = NULL, $data = [])
    {
        $this->recipientToken = $recipientToken;
        $this->title = $title;
        $this->body = $body;
        $this->data = $data;
    }

    public function setRecipientToken($recipientToken = '')
    {
        $this->recipientToken = $recipientToken;
        return $this;
    }

    public function getRecipientToken()
    {
        return $this->recipientToken;
    }

    public function setTitle($title = '')
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBody($body = '')
    {
        $this->body = $body;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setData($data = [])
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function toArray()
    {
        $payload = [
            'to' => $this->recipientToken,
            'notification' => [
                'title' => $this->title,
                'body' => $this->body
            ],
        ];
        if (is_array($this->data) && sizeof($this->data) > 0) {
            $payload['data'] = $this->data;
        }
        return $payload;
    }
}