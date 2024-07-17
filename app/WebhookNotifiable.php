<?php

namespace App;

trait WebhookNotifiable
{
    /**
     * @return string
     */
    public function getSigningKey()
    {
        return $this->api_token;
    }
}