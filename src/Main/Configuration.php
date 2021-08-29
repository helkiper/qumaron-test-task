<?php

namespace App\Main;

use App\DataPersister\FileSystemDataPersister;
use App\DataProvider\FileSystemDataProvider;

class Configuration
{
    public const ACTION_NAMESPACE = 'App\\Action\\';

    public const DATA_PROVIDER = FileSystemDataProvider::class;
    public const DATA_PERSISTER = FileSystemDataPersister::class;

    public const SUPPORTED_CAR_TYPES = ['легковая', 'грузовая'];

    public const UPLOAD_DIR = '/upload';
    public const DB_DIR = '/data';
}
