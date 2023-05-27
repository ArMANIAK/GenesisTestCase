<?php

namespace App\Services;

use App\Services\StorageDrivers\FileStorageDriver;
use http\Client\Response;

class EmailSubscriptionService
{
    public function __construct()
    {
        $this->storageDriver = new FileStorageDriver('../storage/subscription.txt');
    }

    public function isExist(string $email): bool
    {
        $result = $this->storageDriver->read($email);
        if (empty($result)) return false;
        $subscriptions = explode(PHP_EOL, $result);
        return in_array($email, $subscriptions);
    }

    public function subscribe(string $email): int|bool
    {
        return $this->storageDriver->create($email);
    }

    public function sendEmails($text)
    {
        $data = $this->storageDriver->read();
        if (empty($data)) return ['error' => 'No email is subscribed'];
        $emails = explode(PHP_EOL, $data);
        $client = new SendEmailClient();
        $result = [];
        foreach ($emails as $email) {
            if (!empty($email))
            $result[] = $client->sendEmailRequest(['email' => $email, 'text' => $text]);
        }
        return $result;
    }
}
