<?php

namespace App\Services;

use App\Services\StorageDrivers\FileStorageDriver;
class EmailSubscriptionService
{
    public function isExist(string $email): bool
    {
        $storageDriver = new FileStorageDriver('../storage/subscription.txt');
        $result = $storageDriver->read($email);
        if (empty($result)) return false;
        $subscriptions = explode(PHP_EOL, $result);
        return in_array($email, $subscriptions);
    }

    public function subscribe(string $email): int|bool
    {
        $storageDriver = new FileStorageDriver('../storage/subscription.txt');
        return $storageDriver->create($email);
    }
}
