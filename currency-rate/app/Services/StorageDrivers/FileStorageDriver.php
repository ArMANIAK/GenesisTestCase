<?php

namespace App\Services\StorageDrivers;

class FileStorageDriver extends StorageDriver
{
    public function __construct($repository)
    {
        $this->repo = $repository;
    }
    public function read($record = '')
    {
        if (empty(filesize($this->repo))) return false;
        $stream = fopen($this->repo, 'r');
        return fread($stream, filesize($this->repo));
    }

    public function update($record)
    {
    }

    public function create($record)
    {
        $stream = fopen($this->repo, 'a');
        return fwrite($stream, $record . PHP_EOL);
    }

    public function delete($record)
    {
        // TODO: Implement delete() method.
    }
}
