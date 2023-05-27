<?php

namespace App\Services\StorageDrivers;

abstract class StorageDriver
{
    public abstract function __construct($repository);

    public abstract function read($record);

    public abstract function update($record);

    public abstract function create($record);

    public abstract function delete($record);
}
