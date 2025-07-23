<?php

use App\Utilities\FileHelper;
use PHPUnit\Framework\TestCase; 

class FileHelperTest extends TestCase {
        
    public function test_returns_valid_JSON_string() {
        $file = __DIR__ . '/../../Fixtures/test_input.txt';

        $result = FileHelper::getFileContent($file);

        $this->assertNotEmpty($result);
        $this->assertIsString($result);
    }
}