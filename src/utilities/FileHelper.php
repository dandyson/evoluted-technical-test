<?php

namespace App\Utilities;

use RuntimeException;
class FileHelper {
    public static function getFileContent(string $file): string|RuntimeException
    {
        $content = file_get_contents($file);
        
        if ($content === false) {
            throw new RuntimeException("Cannot read file: $file");
        }

        if (trim($content) === '') {
            throw new RuntimeException("File is empty: $file");
        }

        return $content;
    }
}

?>