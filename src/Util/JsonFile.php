<?php

namespace App\Util;

use App\Main\Configuration;
use RuntimeException;

class JsonFile
{
    public static function read(string $fileName): array
    {
        $fileFullName = sprintf(
            '%s/%s',
            $_SERVER['DOCUMENT_ROOT'] . Configuration::UPLOAD_DIR,
//            self::clearNamespace($fileName)
            $fileName
    );
        if (!is_file($fileFullName)) {
            throw new RuntimeException(sprintf('File %s not found', $fileFullName));
        }

        $content = file_get_contents($fileFullName);
        return json_decode($content, true);
    }

    public static function write(string $fileName, array $data): void
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . Configuration::DB_DIR;
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        file_put_contents(
//            $dir . '/' . self::clearNamespace($fileName),
            $dir . '/' . $fileName,
            json_encode($data)
        );
    }

    private static function clearNamespace(string $originalName): string
    {
        $parts = explode('\\', $originalName);

        return end($parts);
    }
}
