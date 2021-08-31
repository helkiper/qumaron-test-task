<?php

namespace App\Util;

use App\Main\Configuration;
use RuntimeException;

class JsonFile
{
    /**
     * @param string $fileName
     * @return array
     */
    public static function read(string $fileName): array
    {
        $fileFullName = $_SERVER['DOCUMENT_ROOT'] . $fileName;

        if (!is_file($fileFullName)) {
            throw new RuntimeException(sprintf('File %s not found', $fileFullName));
        }

        $content = file_get_contents($fileFullName);
        return json_decode($content, true);
    }

    /**
     * @param string $fileName
     * @param array $data
     */
    public static function write(string $fileName, array $data): void
    {
        $dir = $_SERVER['DOCUMENT_ROOT'] . Configuration::DB_DIR;
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        file_put_contents(
            $dir . '/' . $fileName,
            json_encode($data)
        );
    }
}
