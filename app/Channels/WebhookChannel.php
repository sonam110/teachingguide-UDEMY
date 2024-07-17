<?php

namespace App\Channels;

use App\Exceptions\WebHookFailedException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Log\Logger;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use App\User;
use App\Course;
use Log;

class WebhookChannel
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Client $client, Logger $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * @param Notifiable $notifiable
     * @param Notification $notification
     * @throws WebHookFailedException
     */
    public function send($notifiable, Notification $notification)
    {
        if (method_exists($notification, 'toWebhook')) {
            $body = (array) $notification->toWebhook($notifiable);
        } else {
            $body = $notification->toArray($notifiable);
        }
        $timestamp = now()->timestamp;
        $token = str_random(16);

        $headers = [
            'timestamp' => $timestamp,
            'token' => $token,
            'signature' => hash_hmac(
                'sha256',
                $token . $timestamp,
                $notifiable->getSigningKey()
            ),
        ];
        
        $resultsUrl = $body['resultsUrl'];
        $request = new Request('GET', $resultsUrl, $headers, json_encode($body));

        try {
            $response = $this->client->send($request);

            if ($response->getStatusCode() !== 200) {
                throw new WebHookFailedException('Webhook received a non 200 response');
            } 
            $body = json_decode($response->getBody(), true);
            print_r($body);
            Log::info($body); 
            $this->logger->debug('Webhook successfully posted to '. $resultsUrl);
            return;

        } catch (ClientException $exception) {
            if ($exception->getResponse()->getStatusCode() !== 410) {
                throw new WebHookFailedException($exception->getMessage(), $exception->getCode(), $exception);
            }
        } catch (GuzzleException $exception) {
            throw new WebHookFailedException($exception->getMessage(), $exception->getCode(), $exception);
        }

        $this->logger->error('Webhook failed in posting to '. $resultsUrl);
    }
}