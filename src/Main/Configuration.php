<?php

namespace App\Main;

use App\DataPersister\FileSystemDataPersister;
use App\DataProvider\FileSystemDataProvider;
use App\Logger\FileLogger;

class Configuration
{
    public const ACTION_NAMESPACE = 'App\\Action\\';

    public const DATA_PROVIDER = FileSystemDataProvider::class;
    public const DATA_PERSISTER = FileSystemDataPersister::class;
    public const LOGGER = FileLogger::class;

    public const ADMIN_EMAIL = 'admin@car.com';

    public const UPLOAD_DIR = '/upload';
    public const DB_DIR = '/data';
}
